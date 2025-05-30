<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_installation();
        if ($this->config->item('installed') == true) {
            $this->db->reconnect();
        }

        $this->load->model("staff_model");
        $this->load->library('Auth');
        $this->load->library('Enc_lib');
        $this->load->library('mailer');
        $this->load->config('ci-blog');
        $this->mailer;
		
    }

    private function check_installation() {
        if ($this->uri->segment(1) !== 'install') {
            $this->load->config('migration');
            if ($this->config->item('installed') == false && $this->config->item('migration_enabled') == false) {
                redirect(base_url() . 'install/start');
            } else {
                if (is_dir(APPPATH . 'controllers/install')) {
                    echo '<h3>Delete the install folder from application/controllers/install</h3>';
                    die;
                }
            }
        }
    }

    function login() {
      
        if ($this->auth->logged_in()) {
            $this->auth->is_logged_in(true);
        }

        $data = array();
        $data['title'] = 'Login';
        $school = $this->setting_model->get();
        $notice_content = $this->config->item('ci_front_notice_content');
        $notices = $this->cms_program_model->getByCategory($notice_content, array('start' => 0, 'limit' => 5));
        $data['notice'] = $notices;
        $data['school'] = $school[0];
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/login', $data);
        } else {
            $login_post = array(
                'email' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );
            $setting_result = $this->setting_model->get();
            $result = $this->staff_model->checkLogin($login_post);
           $f_year=$this->setting_model->get_financial_year($result->centre_id);
              
            if ($result) {
                if($result->is_active){
                     $setting_result = $this->setting_model->loginget($result->centre_id);
					
                $session_data = array(
                    'id' => $result->id,
                    'username' => $result->name,
                    'centre_id'=>$result->centre_id,
                    'email' => $result->email,
                    'roles' => $result->roles,
					'financial_year'=>$f_year['value'],
                    'date_format' => $setting_result['date_format'],
                    'currency_symbol' => $setting_result['currency_symbol'],
                    'start_month' => $setting_result['start_month'],
                    'school_name' => $setting_result['name'],
                    'timezone' => $setting_result['timezone'],
                    'sch_name' => $setting_result['name'],
                    'language' => array('lang_id' => $setting_result['lang_id'], 'language' => $setting_result['language']),
                    'is_rtl' => $setting_result['is_rtl'],
                    'theme' => $setting_result['theme'],
                );
               $this->session->set_userdata('admin', $session_data);
                $role = $this->customlib->getStaffRole();
                $role_name = json_decode($role)->name;
                $this->customlib->setUserLog($this->input->post('username'), $role_name);
            
                if ($session_data['roles']['Teacher'] == '2'||$session_data['roles']['Teacher'] == '53'||$session_data['roles']['Teacher'] == '48') {
                    redirect('admin/weeklycalendarteacher/index'); 

                } elseif (isset($_SESSION['redirect_to'])) {
                    redirect($_SESSION['redirect_to']);

                } else {
                    redirect('admin/admin/dashboard');
                }
                
            }
            else{
                 $data['error_message'] = 'Your account is disabled please contact to administrator';
                    
                  $this->load->view('admin/login', $data);
            }
               
            } else {
                $data['error_message'] = 'Invalid Username or Password';
                $this->load->view('admin/login', $data);
            }
        }
    }

    function logout() {
        $admin_session = $this->session->userdata('admin');
        $student_session = $this->session->userdata('student');
        $this->auth->logout();
        if ($admin_session) {
            redirect('site/login');
        } else if ($student_session) {
            redirect('site/userlogin');
        } else {
            redirect('site/userlogin');
        }
    }

    function forgotpassword() {


        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/forgotpassword');
        } else {
            $email = $this->input->post('email');

            $result = $this->staff_model->getByEmail($email);

            if ($result && $result->email != "") {

                $verification_code = $this->enc_lib->encrypt(uniqid(mt_rand()));
                $update_record = array('id' => $result->id, 'verification_code' => $verification_code);
                $this->staff_model->add($update_record);
                $name = $result->name;

                $resetPassLink = site_url('admin/resetpassword') . "/" . $verification_code;

                $body = $this->forgotPasswordBody($name, $resetPassLink);
                $body_array = json_decode($body);

                if (!empty($this->mail_config)) {
                    $result = $this->mailer->send_mail($result->email, $body_array->subject, $body_array->body);
                }

                $this->session->set_flashdata('message', "Please check your email to recover your password");

                redirect('site/login', 'refresh');
            } else {
                $data = array(
                    'error_message' => 'Invalid Email'
                );
            }
            $this->load->view('admin/forgotpassword', $data);
        }
    }

    //reset password - final step for forgotten password
    public function admin_resetpassword($verification_code = null) {
        if (!$verification_code) {
            show_404();
        }

        $user = $this->staff_model->getByVerificationCode($verification_code);

        if ($user) {
            //if the code is valid then display the password reset form
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            if ($this->form_validation->run() == false) {


                $data['verification_code'] = $verification_code;
                //render
                $this->load->view('admin/admin_resetpassword', $data);
            } else {

                // finally change the password
                $password = $this->input->post('password');
                $update_record = array(
                    'id' => $user->id,
                    'password' => $this->enc_lib->passHashEnc($password),
                    'verification_code' => ""
                );

                $change = $this->staff_model->update($update_record);
                if ($change) {
                    //if the password was successfully changed
                    $this->session->set_flashdata('message', "Password Reset successfully");
                    redirect('site/login', 'refresh');
                } else {
                    $this->session->set_flashdata('message', "Something went wrong");
                    redirect('admin_resetpassword/' . $verification_code, 'refresh');
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', 'Invalid Link');
            redirect("site/forgotpassword", 'refresh');
        }
    }

    //reset password - final step for forgotten password
    public function resetpassword($role = null, $verification_code = null) {
        if (!$role || !$verification_code) {
            show_404();
        }

        $user = $this->user_model->getUserByCodeUsertype($role, $verification_code);

        if ($user) {
            //if the code is valid then display the password reset form
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            if ($this->form_validation->run() == false) {

                $data['role'] = $role;
                $data['verification_code'] = $verification_code;
                //render
                $this->load->view('resetpassword', $data);
            } else {

                // finally change the password

                $update_record = array(
                    'id' => $user->user_tbl_id,
                    'password' => $this->input->post('password'),
                    'verification_code' => ""
                );

                $change = $this->user_model->saveNewPass($update_record);
                if ($change) {
                    //if the password was successfully changed
                    $this->session->set_flashdata('message', "Password Reset successfully");
                    redirect('site/userlogin', 'refresh');
                } else {
                    $this->session->set_flashdata('message', "Something went wrong");
                    redirect('user/resetpassword/' . $role . '/' . $verification_code, 'refresh');
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', 'Invalid Link');
            redirect("site/ufpassword", 'refresh');
        }
    }

    function ufpassword() {
        $this->form_validation->set_rules('username', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user[]', 'User Type', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('ufpassword');
        } else {
            $email = $this->input->post('username');
            $usertype = $this->input->post('user[]');

            $result = $this->user_model->forgotPassword($usertype[0], $email);

            if ($result && $result->email != "") {

                $verification_code = $this->enc_lib->encrypt(uniqid(mt_rand()));
                $update_record = array('id' => $result->user_tbl_id, 'verification_code' => $verification_code);
                $this->user_model->updateVerCode($update_record);
                if ($usertype[0] == "student") {
                    $name = $result->firstname . " " . $result->lastname;
                } else {
                    $name = $result->name;
                }
                $resetPassLink = site_url('user/resetpassword') . '/' . $usertype[0] . "/" . $verification_code;

                $body = $this->forgotPasswordBody($name, $resetPassLink);
                $body_array = json_decode($body);

                if (!empty($this->mail_config)) {
                    $result = $this->mailer->send_mail($result->email, $body_array->subject, $body_array->body);
                }

                $this->session->set_flashdata('message', "Please check your email to recover your password");
                redirect('site/userlogin', 'refresh');
            } else {
                $data = array(
                    'error_message' => 'Invalid Email or User Type'
                );
            }
            $this->load->view('ufpassword', $data);
        }
    }

    function forgotPasswordBody($name, $resetPassLink) {
        //===============
        $subject = "Password Update Request";
        $body = 'Dear ' . $name . ', 
                <br/>Recently a request was submitted to reset password for your account. If you didn\'t make the request, just ignore this email. Otherwise you can reset your password using this link <a href="' . $resetPassLink . '"><button>Click here to reset your password</button></a>';
        $body .= '<br/><hr/>if you\'re having trouble clicking the password reset button, copy and paste the URL below into your web browser';
        $body .= '<br/>' . $resetPassLink;
        $body .= '<br/><br/>Regards,
                <br/>' . $this->customlib->getSchoolName();

        //======================
        return json_encode(array('subject' => $subject, 'body' => $body));
    }

    function landingpage() {
        //redirect('site/userlogin');
        
        $this->load->view('landingpage');
    }
    function userlogin() {
		//redirect('site/userlogin');
        if ($this->auth->user_logged_in()) {
            $this->auth->user_redirect();
        }
        $data = array();
        $data['title'] = 'Login';
        $school = $this->setting_model->get();
        $notice_content = $this->config->item('ci_front_notice_content');
        $notices = $this->cms_program_model->getByCategory($notice_content, array('start' => 0, 'limit' => 5));
        $data['notice'] = $notices;
        $data['school'] = $school[0];
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('userlogin', $data);
        } else {
            $login_post = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );
            $login_details = $this->user_model->checkLogin($login_post);

            if (isset($login_details) && !empty($login_details)) {
                $user = $login_details[0];

                if ($user->is_active == "yes") {

                    if ($user->role == "student") {

                        $result = $this->user_model->read_user_information($user->id);
                    } else if ($user->role == "parent") {
                        $result = $this->user_model->checkLoginParent($login_post);
                    }
                     
                      
                    if ($result != false) {
                        $setting_result = $this->setting_model->loginget(1);
						//var_dump($setting_result);
						
                        if ($result[0]->role == "student") {
                            $session_data = array(
                                'id' => $result[0]->id,
                                'student_id' => $result[0]->user_id,
								'centre_id'=>$result[0]->centre_id, 
                                'role' => $result[0]->role,
                                'username' => $result[0]->firstname . " " . $result[0]->lastname,
                                'date_format' => $setting_result['date_format'],
                                'currency_symbol' => $setting_result['currency_symbol'],
                                'timezone' => $setting_result['timezone'],
                                'sch_name' => $setting_result['name'],
                                'language' => array('lang_id' => $setting_result['lang_id'], 'language' => $setting_result['language']),
                                'is_rtl' => $setting_result['is_rtl'],
                                'theme' => $setting_result['theme'],
                                'image' => $result[0]->image,
                            );
                            $this->session->set_userdata('student', $session_data);
                            $this->customlib->setUserLog($result[0]->username, $result[0]->role);
                            redirect('user/user/dashboard');
                        } else if ($result[0]->role == "parent") {
                           
                            if ($result[0]->guardian_relation == "Father") {
                                $image = $result[0]->father_pic;
                            } else if ($result[0]->guardian_relation == "Mother") {
                                $image = $result[0]->mother_pic;
                            } else if ($result[0]->guardian_relation == "Other") {
                                $image = $result[0]->guardian_pic;
                            }

                            $session_data = array(
                                'id' => $result[0]->id,
                                'student_id' => $result[0]->user_id,
                                'role' => $result[0]->role,
                                'username' => $result[0]->guardian_name,
                                'date_format' => $setting_result['date_format'],
                                'timezone' => $setting_result['timezone'],
                                'sch_name' => $setting_result['name'],
                                'currency_symbol' => $setting_result['currency_symbol'],
                                'language' => array('lang_id' => $setting_result['lang_id'], 
                                'language' => $setting_result['language']),
                                'is_rtl' => $setting_result['is_rtl'],
                                'theme' => $setting_result['theme'],
                                'image' => $image,
                            );
                            
                            $this->session->set_userdata('student', $session_data);
                            $s = array();
                            $user_id = ($result[0]->id);
                            $students_array = $this->student_model->read_siblings_students($user_id);
                        
                            $child_student = array();
                            foreach ($students_array as $std_key => $std_val) {
                                $child = array(
                                    'student_id' => $std_val->id,
                                    'name' => $std_val->firstname . " " . $std_val->lastname
                                );
                                $child_student[] = $child;
                            }
                            $this->session->set_userdata('parent_childs', $child_student);
                            $this->customlib->setUserLog($result[0]->username, $result[0]->role);
                            redirect('parent/parents/dashboard');
                        }
                    } else {
                        $data['error_message'] = 'Account Suspended';
                        $this->load->view('userlogin', $data);
                    }
                } else {
                    $data['error_message'] =  'Your account is disabled please contact to administrator';
                    $this->load->view('userlogin', $data);
                }
            } else {
                $data['error_message'] = 'Invalid Username or Password';
                $this->load->view('userlogin', $data);
            }
        }
    }

}

?>