<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teacher extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('mailsmsconf');
        $this->load->model("classteacher_model");
        $this->load->model("live_class_model");
        $this->role;
    }

    function index()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'teacher/index');
        $data['title'] = 'Add Teacher';
        $teacher_result = $this->teacher_model->get();
        $data['teacherlist'] = $teacher_result;
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teacher/teacherList', $data);
        $this->load->view('layout/footer', $data);
    }

    function getSubjctByClassandSection()
    {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $types = $this->input->post('types');
        $data = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id, $types);
        // print_r($this->db->last_query());exit;
        echo json_encode($data);
    }
    function getSubjctByClassandSectionNew()
    {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->teachersubject_model->getSubjectByClsandSectionNew($class_id, $section_id);
        echo json_encode($data);
    }


    function viewattendence()
    {
        $this->session->set_userdata('top_menu', 'Attendence');
        $this->session->set_userdata('sub_menu', 'admin/teacher/viewassignteacher');
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $fromDate = $this->input->post('fromdate');
            $toDate = $this->input->post('dateto');
            $data['student_attendance'] = $this->teacher_model->getAttendanceBetweenDates($fromDate, $toDate, $class_id, $section_id);
            $data['issearch'] = true;

            //  echo $this->db->last_query();
            // exit;

            $this->load->view('layout/header', $data);
            $this->load->view('admin/teacher/viewattendence', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teacher/viewattendence', $data);
            $this->load->view('layout/footer', $data);
        }
    }



    function getavailablesubjects()
    {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->teachersubject_model->getavailablesubjects($class_id, $section_id);
        echo json_encode($data);
    }








    function getSubjctBySection()
    {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->teachersubject_model->getSubjctBySectionNew($class_id, $section_id);
        // print_r($this->db->last_query());
        echo json_encode($data);
    }
    function get_subjectteachers()
    {
        $subject_id = $this->input->post('subject_id');

        $data = $this->teachersubject_model->get_subjectteachers($subject_id);
        echo json_encode($data);
    }
    function get_subjectteachersnew()
    {
        $subject_id = $this->input->post('subject_id');
        $userdata = $this->customlib->getUserData();
        $dept = $userdata['department'];
        $data = $this->teachersubject_model->get_subjectteachersnew($subject_id, $dept);
        echo json_encode($data);
    }
    function get_subjectdepartment()
    {
        //$subject_id = $this->input->post('subject_id');
        $data = $this->teachersubject_model->get_subjectdepartment();
        echo json_encode($data);
    }



    function totalhour()
    {
        $sub_id = $this->input->post('subject_id');
        $data = $this->teachersubject_model->getminutes($sub_id);
        echo json_encode($data);
    }


    function assignteacher()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'admin/teacher/viewassignteacher');
        $data['title'] = 'Assign Teacher with Class and Subject wise';
        //$teacher = $this->teacher_model->get();
        $teacher = $this->staff_model->getStaffbyrole(2,53,48);
        $data['teacherlist'] = $teacher;
        // var_dump( $data['teacherlist']);exit;
        $subject = $this->subject_model->get();
        $data['subjectlist'] = $subject;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        //   if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //  $data["classlist"] =   $this->customlib->getclassteacher($userdata["id"]);
        // }

        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $loop = $this->input->post('i');
            $array = array();

            foreach ($loop as $key => $value) {
                $s = array();
                $s['session_id'] = $this->setting_model->getCurrentSession();
                $class_id = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $dt = $this->classsection_model->getDetailbyClassSection($class_id, $section_id);
                // var_dump($dt);exit;
                $s['class_section_id'] = $dt['id'];

                $teacher_id = $this->input->post('teacher_id_' . $value);
                //var_dump($teacher_id);
                $cat = count($teacher_id);

                $teacher = array();
                for ($i = 0; $i < $cat; $i++) {
                    $ar = $teacher_id[$i];
                    array_push($teacher, $ar);
                }
                //var_dump($teacher);
                $s['teacher_id'] = implode(',', $teacher);
                $s['subject_id'] = $this->input->post('subject_id_' . $value);
                $row_id = $this->input->post('row_id_' . $value);
                if ($row_id == 0) {
                    $insert_id = $this->teachersubject_model->add($s);
                    $array[] = $insert_id;
                } else {
                    $s['id'] = $row_id;
                    $array[] = $row_id;
                    $this->teachersubject_model->add($s);
                }
            }
            // var_dump($s);
            $ids = $array;
            $class_section_id = $dt['id'];
            $this->teachersubject_model->deleteBatch($ids, $class_section_id);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Record updated successfully</div>');

            redirect('admin/teacher/viewassignteacher');
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teacher/assignTeacher', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function viewassignteacher()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'admin/teacher/viewassignteacher');
        $data['title'] = 'Assign Teacher with Class and Subject wise';
        //$teacher = $this->teacher_model->get();
        $teacher = $this->staff_model->getStaffbyrole(2,48,53,54,14,57);
        $data['teacherlist'] = $teacher;
        $subject = $this->subject_model->get();
        $data['subjectlist'] = $subject;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        //   if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //  $data["classlist"] =   $this->customlib->getClassbyteacher($userdata["id"]);
        // }
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teacher/viewassignTeacher', $data);
        $this->load->view('layout/footer', $data);

        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $loop = $this->input->post('i');
            $array = array();
            foreach ($loop as $key => $value) {
                $s = array();
                $s['session_id'] = $this->setting_model->getCurrentSession();
                $class_id = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $dt = $this->classsection_model->getDetailbyClassSection($class_id, $section_id);

                $s['class_section_id'] = $dt['id'];

                $teacher_id = $this->input->post('teacher_id_' . $value);
                $cat = count($teacher_id);

                $teacher = array();
                for ($i = 0; $i < $cat; $i++) {
                    $ar = $teacher_id[$i];
                    array_push($teacher, $ar);
                }
                //var_dump($teacher);
                $s['teacher_id'] = implode(',', $teacher);
                $s['subject_id'] = $this->input->post('subject_id_' . $value);
                $row_id = $this->input->post('row_id_' . $value);
                if ($row_id == 0) {
                    $insert_id = $this->teachersubject_model->add($s);
                    $array[] = $insert_id;
                } else {
                    $s['id'] = $row_id;
                    $array[] = $row_id;
                    $this->teachersubject_model->add($s);
                }
            }



            $ids = $array;
            $class_section_id = $dt['id'];
            $this->teachersubject_model->deleteBatch($ids, $class_section_id);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Record updated successfully</div>');
            redirect('admin/teacher/viewassignteacher');
        }
    }


    public function getSubjectTeachers()
    {
        if (!$this->rbac->hasPrivilege('assign_subject', 'can_view')) {
            access_denied();
        }
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $dt = $this->classsection_model->getDetailbyClassSection($class_id, $section_id);
            $data = $this->teachersubject_model->getDetailByclassAndSection($dt['id']);
            echo json_encode(array('st' => 0, 'msg' => $data));
        } else {
            $data = array(
                'class_id' => form_error('class_id'),
                'section_id' => form_error('section_id'),
            );
            echo json_encode(array('st' => 1, 'msg' => $data));
        }
    }

    function view($id)
    {
        if (!$this->rbac->hasPrivilege('assign_subject', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Teacher List';
        $teacher = $this->teacher_model->get($id);
        $teachersubject = $this->teachersubject_model->getTeacherClassSubjects($id);
        $data['teacher'] = $teacher;
        $data['teachersubject'] = $teachersubject;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teacher/teacherShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id)
    {
        if (!$this->rbac->hasPrivilege('assign_subject', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Teacher List';
        $this->teacher_model->remove($id);
        redirect('admin/teacher/index');
    }

    function create()
    {
        if (!$this->rbac->hasPrivilege('assign_subject', 'can_add')) {
            access_denied();
        }
        $data['title'] = 'Add teacher';
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $this->form_validation->set_rules('name', 'Teacher', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|required|numeric|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {
            $teacher_result = $this->teacher_model->get();
            $data['teacherlist'] = $teacher_result;
            $genderList = $this->customlib->getGender();
            $data['genderList'] = $genderList;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teacher/teacherCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'sex' => $this->input->post('gender'),
                'dob' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'image' => 'uploads/student_images/no_image.png',
            );
            $insert_id = $this->teacher_model->add($data);
            $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
            $data_student_login = array(
                'username' => $this->teacher_login_prefix . $insert_id,
                'password' => $user_password,
                'user_id' => $insert_id,
                'role' => 'teacher'
            );
            $this->user_model->add($data_student_login);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/teacher_images/" . $img_name);
                $data_img = array('id' => $insert_id, 'image' => 'uploads/teacher_images/' . $img_name);
                $this->teacher_model->add($data_img);
            }
            $teacher_login_detail = array('id' => $insert_id, 'credential_for' => 'teacher', 'username' => $this->teacher_login_prefix . $insert_id, 'password' => $user_password, 'contact_no' => $this->input->post('phone'));

            $this->mailsmsconf->mailsms('login_credential', $teacher_login_detail);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Teacher added successfully</div>');
            redirect('admin/teacher/index');
        }
    }

    function handle_upload()
    {
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png');
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if (
                $_FILES["file"]["type"] != 'image/gif' &&
                $_FILES["file"]["type"] != 'image/jpeg' &&
                $_FILES["file"]["type"] != 'image/png'
            ) {

                $this->form_validation->set_message('handle_upload', 'File type not allowed');
                return false;
            }
            if (!in_array($extension, $allowedExts)) {

                $this->form_validation->set_message('handle_upload', 'Extension not allowed');
                return false;
            }
            if ($_FILES["file"]["size"] > 10240000) {

                $this->form_validation->set_message('handle_upload', 'File size shoud be less than 100 kB');
                return false;
            }
            if ($error == "") {
                return true;
            }
        } else {
            return true;
        }
    }

    function edit($id)
    {
        if (!$this->rbac->hasPrivilege('assign_subject', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Edit Teacher';
        $data['id'] = $id;
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $teacher = $this->teacher_model->get($id);
        $data['teacher'] = $teacher;
        $this->form_validation->set_rules('name', 'Teacher', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|required|numeric|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {
            $teacher_result = $this->teacher_model->get();
            $data['teacherlist'] = $teacher_result;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teacher/teacherEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'sex' => $this->input->post('gender'),
                'dob' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone')
            );
            $insert_id = $this->teacher_model->add($data);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/teacher_images/" . $img_name);
                $data_img = array('id' => $id, 'image' => 'uploads/teacher_images/' . $img_name);
                $this->teacher_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Teacher updated successfully</div>');
            redirect('admin/teacher/index');
        }
    }

    function getlogindetail()
    {
        $teacher_id = $this->input->post('teacher_id');
        $examSchedule = $this->user_model->getTeacherLoginDetails($teacher_id);
        echo json_encode($examSchedule);
    }

    //     function assign_class_teacher(){
    // if(!$this->rbac->hasPrivilege('assign_class_teacher','can_view')){
    //        access_denied();
    //        }
    //         $this->session->set_userdata('top_menu', 'Academics');
    //        $this->session->set_userdata('sub_menu', 'classes/index');
    //        $data['title'] = 'Add Class Teacher';
    //        $data['title_list'] = 'Class List';
    //        $this->form_validation->set_rules(
    //                'class', 'Class', array(
    //            'required',
    //            array('class_exists', array($this->class_model, 'class_exists'))
    //                )
    //        );
    //        $this->form_validation->set_rules('sections[]', 'Section', 'trim|required|xss_clean');
    //        if ($this->form_validation->run() == FALSE) {
    //        } else {
    //            $class = $this->input->post("class");
    //            $sections = $this->input->post("sections");
    //            $teachers = $this->input->post("teachers");
    //            $i = 0;
    //            foreach ($teachers as $key => $value) {
    //                 $section = "";
    //                if(array_key_exists($i,$sections)){
    //                    $section = $sections[$i];
    //                }else{
    //                    $section = $sections[0];
    //                }
    //               $classteacherid = $this->input->post("classteacherid");
    //                if(isset($classteacherid)){
    //                 $data = array('id' => $classteacherid,
    //                                'class_id' => $class,
    //                              'section_id' => $section,
    //                              'staff_id' => $teachers[$i],
    //                             );   
    //                }else{
    //                    $data = array('class_id' => $class,
    //                              'section_id' => $section,
    //                              'staff_id' => $teachers[$i],
    //                             );
    //                }
    //                  $i++;
    //             $this->classteacher_model->addClassTeacher($data); 
    //            }
    //             redirect('classes/assign_class_teacher');
    //        }
    //        $classlist = $this->class_model->get();
    //        $data['classlist'] = $classlist;
    //        $sectionlist = $this->section_model->get();
    //        $data['sectionlist'] = $sectionlist;
    //        $assignteacherlist = $this->class_model->getClassTeacher();
    //        $data['assignteacherlist'] = $assignteacherlist;
    //        $teacherlist = $this->staff_model->getStaffbyrole($role=2);
    //        $data['teacherlist'] = $teacherlist;
    //        $this->load->view('layout/header', $data);
    //        $this->load->view('class/classTeacher', $data);
    //        $this->load->view('layout/footer', $data);
    //    }
    function assign_class_teacher()
    {

        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'admin/teacher/assign_class_teacher');
        $data['title'] = 'Add Class Teacher';
        $data['title_list'] = 'Class List';
        $admin=$this->session->userdata('admin');
            $centre_id=$admin['centre_id'];
        $this->form_validation->set_rules(
            'class',
            'Course',
            array(
                'required',
                array('class_exists', array($this->class_model, 'class_teacher_exists'))
            )
        );
        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('teachers[]', 'Class in charge', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
        } else {

            $class = $this->input->post("class");
            $section = $this->input->post("section");
            $teachers = $this->input->post("teachers");

            $i = 0;
            foreach ($teachers as $key => $value) {

                $classteacherid = $this->input->post("classteacherid");
                if (isset($classteacherid)) {

                    $data = array(
                        'id' => $classteacherid[$i],
                        'class_id' => $class,
                        'section_id' => $section,
                        'staff_id' => $teachers[$i],
                    );
                } else {
                    $data = array(
                        'class_id' => $class,
                        'section_id' => $section,
                        'staff_id' => $teachers[$i],
                    );
                }
                $i++;
                $this->classteacher_model->addClassTeacher($data);
            }


            redirect('admin/teacher/assign_class_teacher');
        }
        $classlist = $this->class_model->get();
        $data['classlist'] = $classlist;

        $sectionlist = $this->section_model->get();
        $data['sectionlist'] = $sectionlist;


        $assignteacherlist = $this->class_model->getClassTeacher($centre_id);
        $data['assignteacherlist'] = $assignteacherlist;
        
        // echo "<pre>";
        // print_r($assignteacherlist);
        // exit();
        foreach ($assignteacherlist as $key => $value) {
            $class_id = $value["class_id"];
            $section_id = $value["section_id"];

            $tlist[] = $this->classteacher_model->teacherByClassSection($class_id, $section_id);
        }
        if (!empty($tlist)) {
            $data["tlist"] = $tlist;
        }
        $roles = [2,48,53,54,14,57];
        $teacherlist = $this->staff_model->getStaffbyrole($roles);
        // $teacherlist = $this->staff_model->getStaffbyrole($role = 2);

        $data['teacherlist'] = $teacherlist;

        $this->load->view('layout/header', $data);
        $this->load->view('class/classTeacher', $data);
        $this->load->view('layout/footer', $data);
    }

    function classteacheredit($class_id, $section_id)
    {

        $result = $this->classteacher_model->teacherByClassSection($class_id, $section_id);

        $data["result"] = $result;

        $classlist = $this->class_model->get();
        $data['classlist'] = $classlist;

        $sectionlist = $this->section_model->get();
        $data['sectionlist'] = $sectionlist;

        $assignteacherlist = $this->class_model->getClassTeacher();
        $data['assignteacherlist'] = $assignteacherlist;
        foreach ($assignteacherlist as $key => $value) {
            $classid = $value["class_id"];
            $sectionid = $value["section_id"];

            $tlist[] = $this->classteacher_model->teacherByClassSection($classid, $sectionid);
        }

        $data["tlist"] = $tlist;

        $roles = [2,48,53,54,14,57];
        $teacherlist = $this->staff_model->getStaffbyrole($roles);

        $data['teacherlist'] = $teacherlist;

        $data['class_id'] = $class_id;
        $data['section_id'] = $section_id;

        $this->load->view('layout/header', $data);
        $this->load->view('class/classTeacherEdit', $data);
        $this->load->view('layout/footer', $data);
    }

    function update_class_teacher()
    {

        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'classes/index');
        $data['title'] = 'Add Class Teacher';
        $data['title_list'] = 'Class List';


        //   $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('teachers[]', 'Teacher', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
        } else {

            $section = $this->input->post('section');
            $prev_teacher = $this->input->post('classteacherid');
            $staff_id = $this->input->post('teachers');
            $class_id = $this->input->post('class');
            if (!isset($prev_teacher)) {
                $prev_teacher = array();
            }
            $add_result = array_diff($staff_id, $prev_teacher);
            $delete_result = array_diff($prev_teacher, $staff_id);

            if (!empty($add_result)) {
                $teacher_batch_array = array();
                foreach ($add_result as $teacher_add_key => $teacher_add_value) {

                    $teacher_batch_array[] = $teacher_add_value;
                }

                $insert_array = array();
                foreach ($teacher_batch_array as $vec_key => $vec_value) {

                    $vehicle_array = array(
                        'class_id' => $class_id,
                        'section_id' => $section,
                        'staff_id' => $vec_value,
                    );
                    $this->classteacher_model->addClassTeacher($vehicle_array);
                    $insert_array[] = $vehicle_array;
                }
            }


            if (!empty($delete_result)) {
                $classteacher_delete_array = array();
                foreach ($delete_result as $vec_delete_key => $vec_delete_value) {

                    $classteacher_delete_array[] = $vec_delete_value;
                }



                $this->classteacher_model->delete($class_id, $section, $classteacher_delete_array);
            }

            redirect('admin/teacher/assign_class_teacher');
        }
        $classlist = $this->class_model->get();
        $data['classlist'] = $classlist;

        $sectionlist = $this->section_model->get();
        $data['sectionlist'] = $sectionlist;


        $assignteacherlist = $this->class_model->getClassTeacher();
        $data['assignteacherlist'] = $assignteacherlist;

        foreach ($assignteacherlist as $key => $value) {
            $class_id = $value["class_id"];
            $section_id = $value["section_id"];

            $tlist[] = $this->classteacher_model->teacherByClassSection($class_id, $section_id);
        }
        $data["tlist"] = $tlist;

         $roles = [2,48,53,54,14,57];
        $teacherlist = $this->staff_model->getStaffbyrole($roles);

        $data['teacherlist'] = $teacherlist;

        $this->load->view('layout/header', $data);
        $this->load->view('class/classTeacher', $data);
        $this->load->view('layout/footer', $data);
    }

    function classteacherdelete($class_id, $section_id)
    {

        if ((!empty($class_id)) && (!empty($section_id))) {

            $this->classteacher_model->delete($class_id, $section_id, null);
            redirect("admin/teacher/assign_class_teacher");
        }
    }



    function get_subByteacher()
    {
        $admin = $this->session->userdata('admin');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->live_class_model->teacher($admin['id'], $class_id, $section_id);
        echo json_encode($data);
    }


    function get_sub()
    {
        $admin = $this->session->userdata('admin');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->live_class_model->getSubject($class_id, $section_id);
        // echo $this->db->last_query();exit;

        echo json_encode($data);
    }



    function getSubjectByStaffClassandSection()
    {
        $userdata = $this->customlib->getUserData();
        $dept = $userdata['department'];
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $subject_id = $this->input->post('subject_id');
        $staff_id = $this->input->post('staff_id');
        $type = $this->input->post('type');
        $data = $this->teachersubject_model->getSubjectByClsandSectionstaff($class_id, $section_id, $subject_id, $type, $dept);
        echo json_encode($data);
    }

    function getSubjctByme()
    {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $userdata = $this->customlib->getUserData();
        $staff = $userdata['id'];
        $data = $this->teachersubject_model->getSubjectBymine($class_id, $section_id, $staff);
        echo json_encode($data);
    }

    function deleteTimetable()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id)->delete('weekly_calendar');

        echo json_encode(array('message' => "Timetable deleted"));
    }
    function approveTimetable()
    {
        $id = $this->input->post('id');
        $this->db->set('status', "1")->where('id', $id)->update('weekly_calendar');

        echo json_encode(array('message' => "Timetable Approved"));
    }
}
