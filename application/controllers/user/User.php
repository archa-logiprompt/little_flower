<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends Student_Controller
{

    public $school_name;
    public $school_setting;
    public $setting;
    public $payment_method;

    function __construct()
    {
        parent::__construct();
        $this->payment_method = $this->paymentsetting_model->getActiveMethod();
    }

    function unauthorized()
    {
        $data = array();
        $this->load->view('layout/student/header');
        $this->load->view('unauthorized', $data);
        $this->load->view('layout/student/footer');
    }

    public function internal_marks()
    {
        $this->session->set_userdata('top_menu', 'InternalItems');
        $this->session->set_userdata('sub_menu', 'user/internal_marks');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
        $data['student']=$student['id'];
       
        $class_id = $student['class_id'];
        $section_id = $student['section_id'];
        $data['student_id'] = $student_id;
        $data['title_list'] = 'Internal Marks';
        // $assignments =$this->content_model->getAssignments($class_id, $section_id); 
        // $data['list'] = $assignments;
        $internal_mark = $this->content_model->getinternalmarks( $data['student']);
        $data['list'] = $internal_mark;
        $this->load->view('layout/student/header');
        $this->load->view('user/internal/internal_marks', $data);
        $this->load->view('layout/student/footer');
    }

    function dashboard()
    {

        $this->session->set_userdata('top_menu', 'Dashboard');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);

        $data = array();
        if (!empty($student)) {
            $student_session_id = $student['student_session_id'];
            $gradeList = $this->grade_model->get();
            $student_due_fee = $this->studentfeemaster_model->getStudentFees($student_session_id);
            $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student_session_id);
            $data['student_discount_fee'] = $student_discount_fee;
            $data['student_due_fee'] = $student_due_fee;
            $timeline = $this->timeline_model->getStudentTimeline($student["id"], $status = 'yes');
            $data["timeline_list"] = $timeline;

            $examList = $this->examschedule_model->getExamByClassandSection($student['class_id'], $student['section_id']);
            $data['examSchedule'] = array();
            if (!empty($examList)) {
                $new_array = array();
                foreach ($examList as $ex_key => $ex_value) {
                    $array = array();
                    $x = array();
                    $exam_id = $ex_value['exam_id'];
                    $student['id'];
                    $exam_subjects = $this->examschedule_model->getresultByStudentandExam($exam_id, $student['id']);
                    foreach ($exam_subjects as $key => $value) {
                        $exam_array = array();
                        $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
                        $exam_array['exam_id'] = $value['exam_id'];
                        $exam_array['full_marks'] = $value['full_marks'];
                        $exam_array['passing_marks'] = $value['passing_marks'];
                        $exam_array['exam_name'] = $value['name'];
                        $exam_array['exam_type'] = $value['type'];
                        $exam_array['attendence'] = $value['attendence'];
                        $exam_array['get_marks'] = $value['get_marks'];
                        $x[] = $exam_array;
                    }
                    $array['exam_name'] = $ex_value['name'];
                    $array['exam_result'] = $x;
                    $new_array[] = $array;
                }
                $data['examSchedule'] = $new_array;
            }
            //$student_doc = $this->student_model->getstudentdoc($student_id);
            $data['student_doc'] = $student_doc;
            $data['student_doc_id'] = $student_id;
            $category_list = $this->category_model->get();
            $data['category_list'] = $category_list;
            $data['gradeList'] = $gradeList;
            $data['student'] = $student;
        }

        $student_due_fee = $this->studentfeemaster_model->getStudentFees($student['id']);
        $fee_excess = $this->studentfeemaster_model->getFeeexcess($student['id']);
        $data['fee_excess'] = $fee_excess;
        $fee_advance = $this->studentfeemaster_model->getFeeadvance($student['id']);
        $data['fee_advance'] = $fee_advance;

        $data['excess_balance'] = $this->db->select('amount')->where('student_id', $student['id'])->get('excess_balance')->row()->amount;
        $data['advance_balance'] = $this->db->select('amount')->where('student_id', $student['id'])->get('advance_balance')->row()->amount;

        $this->load->view('layout/student/header', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('layout/student/footer', $data);
    }

    function editprofile($id)
    {
        $student = $this->student_model->get($id);
        $data['id'] = $id;
        $genderList = $this->customlib->getGender();
        $data['student'] = $student;
        $data['genderList'] = $genderList;
        $session = $this->setting_model->getCurrentSession();
        $vehroute_result = $this->vehroute_model->get();
        $data['vehroutelist'] = $vehroute_result;
        $class = $this->class_model->get();
        $setting_result = $this->setting_model->get();
        // $student_categorize = $setting_result[0]["student_categorize"];
        // $data["student_categorize"] = $student_categorize ;
        $data["student_categorize"] = 'class';
        $data['classlist'] = $class;
        $feeyear = $this->feemaster_model->getfeeyear();
        $data['feeyearlist'] = $feeyear;
        $sch = $this->student_model->getscholarship();
        $data['sch'] = $sch;
        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        $hostelList = $this->hostel_model->get();
        $data['hostelList'] = $hostelList;
        $houses = $this->student_model->gethouselist();
        $data['houses'] = $houses;
        $data["bloodgroup"] = $this->blood_group;
        $siblings = $this->student_model->getMySiblings($student['parent_id'], $student['id']);
        $data['siblings'] = $siblings;
        $data['siblings_counts'] = count($siblings);
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('batchname', 'Batch Name', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('guardian_is', 'Guardian', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_name', 'Guardian Name', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('rte', 'RTE', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('annual_income', 'Annual income', 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_phone', 'Guardian Phone', 'trim|required|numeric|max_length[10]|min_length[10]');
        $this->form_validation->set_rules(
            'roll_no',
            'Roll No.',
            array(
                'trim',
                array('check_exists', array($this->student_model, 'valid_student_roll'))
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/student/header', $data);
            $this->load->view('student/profileEdit', $data);
            $this->load->view('layout/student/footer', $data);
        } else {

            $student_id = $this->input->post('student_id');
            $student = $this->student_model->get($student_id);
            $sibling_id = $this->input->post('sibling_id');
            $siblings_counts = $this->input->post('siblings_counts');
            $siblings = $this->student_model->getMySiblings($student['parent_id'], $student_id);
            $total_siblings = count($siblings);


            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $hostel_room_id = $this->input->post('hostel_room_id');
            $fees_discount = $this->input->post('fees_discount');
            $vehroute_id = $this->input->post('vehroute_id');
            if (empty($vehroute_id)) {
                $vehroute_id = 0;
            }
            if (empty($hostel_room_id)) {
                $hostel_room_id = 0;
            }
            $data = array(
                'id' => $id,
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'rte' => $this->input->post('rte'),
                'mobileno' => $this->input->post('mobileno'),
                'email' => $this->input->post('email'),
                'state' => $this->input->post('state'),
                'city' => $this->input->post('city'),
                'guardian_is' => $this->input->post('guardian_is'),
                'pincode' => $this->input->post('pincode'),
                'religion' => $this->input->post('religion'),
                'dob' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'current_address' => $this->input->post('current_address'),
                'permanent_address' => $this->input->post('permanent_address'),
                'category_id' => $this->input->post('category_id'),
                'adhar_no' => $this->input->post('adhar_no'),
                'samagra_id' => $this->input->post('samagra_id'),
                'kuhs_reg_no' => $this->input->post('kuhs_reg'),
                'bank_account_no' => $this->input->post('bank_account_no'),
                'bank_name' => $this->input->post('bank_name'),
                'ifsc_code' => $this->input->post('ifsc_code'),
                'nationality' => $this->input->post('nationality'),
                'cast' => $this->input->post('cast'),
                'father_name' => $this->input->post('father_name'),
                'father_phone' => $this->input->post('father_phone'),
                'father_occupation' => $this->input->post('father_occupation'),
                'mother_name' => $this->input->post('mother_name'),
                'mother_phone' => $this->input->post('mother_phone'),
                'mother_occupation' => $this->input->post('mother_occupation'),
                'guardian_occupation' => $this->input->post('guardian_occupation'),
                'guardian_email' => $this->input->post('guardian_email'),
                'gender' => $this->input->post('gender'),
                'annual_income' => $this->input->post('annual_income'),
                'guardian_name' => $this->input->post('guardian_name'),
                'guardian_relation' => $this->input->post('guardian_relation'),
                'guardian_phone' => $this->input->post('guardian_phone'),
                'guardian_address' => $this->input->post('guardian_address'),
                'school_house_id' => $this->input->post('house'),
                'blood_group' => $this->input->post('blood_group'),
                'height' => $this->input->post('height'),
                'weight' => $this->input->post('weight'),
                'note' => $this->input->post('note'),
                'scholarship' => $this->input->post('scholarship'),
                'measurement_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('measure_date')))
            );
            $this->student_model->add($data);

            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'image' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }

            if (isset($_FILES["father_pic"]) && !empty($_FILES['father_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["father_pic"]["name"]);
                $img_name = $id . "father" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["father_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'father_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }


            if (isset($_FILES["mother_pic"]) && !empty($_FILES['mother_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["mother_pic"]["name"]);
                $img_name = $id . "mother" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["mother_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'mother_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }


            if (isset($_FILES["guardian_pic"]) && !empty($_FILES['guardian_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["guardian_pic"]["name"]);
                $img_name = $id . "guardian" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["guardian_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'guardian_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }

            if (isset($siblings_counts) && ($total_siblings == $siblings_counts)) {
                //if there is no change in sibling
            } else if (!isset($siblings_counts) && $sibling_id == 0 && $total_siblings > 0) {
                // add for new parent
                $parent_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);

                $data_parent_login = array(
                    'username' => $this->parent_login_prefix . $student_id . "_1",
                    'password' => $parent_password,
                    'user_id' => "",
                    'role' => 'parent',
                );

                $update_student = array(
                    'id' => $student_id,
                    'parent_id' => 0,
                );
                $ins_id = $this->user_model->addNewParent($data_parent_login, $update_student);
            } else if ($sibling_id != 0) {
                //join to student with new parent
                $student_sibling = $this->student_model->get($sibling_id);
                $update_student = array(
                    'id' => $student_id,
                    'parent_id' => $student_sibling['parent_id'],
                );
                $student_sibling = $this->student_model->add($update_student);
            } else {
            }


            redirect('user/user/dashboard');
        }
    }

    function changepass()
    {
        $data['title'] = 'Change Password';
        $this->form_validation->set_rules('current_pass', 'Current password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_pass', 'New password', 'trim|required|xss_clean|matches[confirm_pass]');
        $this->form_validation->set_rules('confirm_pass', 'Confirm password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $sessionData = $this->session->userdata('loggedIn');
            $this->data['id'] = $sessionData['id'];
            $this->data['username'] = $sessionData['username'];
            $this->load->view('layout/student/header', $data);
            $this->load->view('user/change_password', $data);
            $this->load->view('layout/student/footer', $data);
        } else {
            $sessionData = $this->session->userdata('student');
            $data_array = array(
                'current_pass' => ($this->input->post('current_pass')),
                'new_pass' => ($this->input->post('new_pass')),
                'user_id' => $sessionData['id'],
                'user_name' => $sessionData['username']
            );
            $newdata = array(
                'id' => $sessionData['id'],
                'password' => $this->input->post('new_pass')
            );
            $query1 = $this->user_model->checkOldPass($data_array);
            if ($query1) {
                $query2 = $this->user_model->saveNewPass($newdata);
                if ($query2) {

                    $this->session->set_flashdata('success_msg', 'Password changed successfully');
                    $this->load->view('layout/student/header', $data);
                    $this->load->view('user/change_password', $data);
                    $this->load->view('layout/student/footer', $data);
                }
            } else {

                $this->session->set_flashdata('error_msg', 'Invalid current password');
                $this->load->view('layout/student/header', $data);
                $this->load->view('user/change_password', $data);
                $this->load->view('layout/student/footer', $data);
            }
        }
    }

    function changeusername()
    {
        $sessionData = $this->customlib->getLoggedInUserData();

        $data['title'] = 'Change Username';
        $this->form_validation->set_rules('current_username', 'Current username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_username', 'New username', 'trim|required|xss_clean|matches[confirm_username]');
        $this->form_validation->set_rules('confirm_username', 'Confirm username', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
        } else {

            $data_array = array(
                'username' => $this->input->post('current_username'),
                'new_username' => $this->input->post('new_username'),
                'role' => $sessionData['role'],
                'user_id' => $sessionData['id'],
            );
            $newdata = array(
                'id' => $sessionData['id'],
                'username' => $this->input->post('new_username')
            );
            $is_valid = $this->user_model->checkOldUsername($data_array);

            if ($is_valid) {
                $is_exists = $this->user_model->checkUserNameExist($data_array);
                if (!$is_exists) {
                    $is_updated = $this->user_model->saveNewUsername($newdata);
                    if ($is_updated) {
                        $this->session->set_flashdata('success_msg', 'Username changed successfully');
                        redirect('user/user/changeusername');
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Username Already Exists, Please choose other');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid current username');
            }
        }
        $this->data['id'] = $sessionData['id'];
        $this->data['username'] = $sessionData['username'];
        $this->load->view('layout/student/header', $data);
        $this->load->view('user/change_username', $data);
        $this->load->view('layout/student/footer', $data);
    }

    public function download($student_id, $doc)
    {
        $this->load->helper('download');
        $filepath = "./uploads/student_documents/$student_id/" . $this->uri->segment(5);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(6);
        force_download($name, $data);
    }

    public function timeline_download($timeline_id, $doc)
    {
        $this->load->helper('download');
        $filepath = "./uploads/student_timeline/" . $doc;
        $data = file_get_contents($filepath);
        $name = $doc;
        force_download($name, $data);
    }

    function view($id)
    {
        $data['title'] = 'Student Details';
        $student = $this->student_model->get($id);
        $student_due_fee = $this->studentfee_model->getDueFeeBystudent($student['class_id'], $student['section_id'], $id);
        $data['student_due_fee'] = $student_due_fee;
        $transport_fee = $this->studenttransportfee_model->getTransportFeeByStudent($student['student_session_id']);
        $data['transport_fee'] = $transport_fee;
        $examList = $this->examschedule_model->getExamByClassandSection($student['class_id'], $student['section_id']);
        $data['examSchedule'] = array();
        if (!empty($examList)) {
            $new_array = array();
            foreach ($examList as $ex_key => $ex_value) {
                $array = array();
                $x = array();
                $exam_id = $ex_value['exam_id'];
                $exam_subjects = $this->examschedule_model->getresultByStudentandExam($exam_id, $student['id']);
                foreach ($exam_subjects as $key => $value) {
                    $exam_array = array();
                    $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
                    $exam_array['exam_id'] = $value['exam_id'];
                    $exam_array['full_marks'] = $value['full_marks'];
                    $exam_array['passing_marks'] = $value['passing_marks'];
                    $exam_array['exam_name'] = $value['name'];
                    $exam_array['exam_type'] = $value['type'];
                    $exam_array['attendence'] = $value['attendence'];
                    $exam_array['get_marks'] = $value['get_marks'];
                    $x[] = $exam_array;
                }
                $array['exam_name'] = $ex_value['exam_name'];
                $array['exam_result'] = $x;
                $new_array[] = $array;
            }
            $data['examSchedule'] = $new_array;
        }
        return $data['student'] = $student;
    }

    function getfees()
    {
        $id = $this->session->userdata["student"]["student_id"];
        // $this->auth->validate_child($id);
        $this->session->set_userdata('top_menu', 'Fees');
        $this->session->set_userdata('sub_menu', 'student/getFees');
        $paymentoption = $this->customlib->checkPaypalDisplay();
        $data['paymentoption'] = $paymentoption;
        $data['payment_method'] = false;
        if (!empty($this->payment_method)) {
            $data['payment_method'] = true;
        }
        $student_id = $id;
        $student = $this->student_model->get($student_id);
        $class_id = $student['class_id'];
        $section_id = $student['section_id'];
        $data['title'] = 'Student Details';
        $student_due_fee = $this->studentfeemaster_model->getStudentFees($student['student_session_id']);
        $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
        $data['student_discount_fee'] = $student_discount_fee;
        $data['student_due_fee'] = $student_due_fee;
        $data['student'] = $student;
        $this->load->view('layout/student/header', $data);
        $this->load->view('student/getfees', $data);
        $this->load->view('layout/student/footer', $data);
    }
    public function question_bank()
    {
        $userdata = $this->session->userdata["student"];
        $class_section = $this->student_model->getClassAndSection($userdata['student_id']);
        $contents = $this->student_model->getQuestionBank($class_section);
        $data['contents'] = $contents;
        $this->load->view('layout/student/header', $data);
        $this->load->view('student/questionbank', $data);
        $this->load->view('layout/student/footer', $data);
    }
    public  function questiondownload($file)
    {
        $this->load->helper('download');
        $filepath = "./uploads/school_content/material/" . $file;
        $data = file_get_contents($filepath);
        $name = $file;
        force_download($name, $data);
    }

    public function applyleave()
    {
        $userdata = $this->session->userdata["student"];
        $student_id = $userdata['student_id'];
        $leavelist = $this->student_model->getleavedetails($student_id);
        $data['leavelist'] = $leavelist;

        $this->load->view('layout/student/header');
        $this->load->view('student/leaveapplication', $data);
        $this->load->view('layout/student/footer');
    }
    public function deleteleave($id)
    {
        $this->student_model->deleteleave($id);
        redirect('user/user/applyleave');
    }

    public function createLeave()
    {
        $userdata = $this->session->userdata["student"];
        $student_id = $userdata['student_id'];
        $class_section = $this->student_model->getClassAndSection($userdata['student_id']);
        $leave_from = date('d/m/Y', strtotime($this->input->post("leave_from")));
        $leave_to = date('d/m/Y', strtotime($this->input->post("leave_to")));
        $noOfDays = $leave_to - $leave_from + 1;

        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $fileInfo = pathinfo($_FILES["file"]["name"]);
            $img_name = "uploads/" . time() . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads" . $img_name);
        }

        $data = array(
            'leave_from' => $leave_from,
            'leave_to' => $leave_to,
            'leave_days' => $noOfDays,
            'student_id' => $student_id,
            'class_section_id' => $class_section,
            'leave_days' => $noOfDays,
            'reason' => $this->input->post('reason'),
            'file' => $img_name,

        );
        $this->db->insert('student_leaves', $data);
        redirect('user/user/applyleave');
    }
}
