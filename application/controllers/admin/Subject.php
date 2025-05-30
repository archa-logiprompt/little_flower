<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Subject extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        require_once APPPATH.'third_party/excel/PHPExcel.php';
        $this->excel = new PHPExcel(); 
        $this->load->model("file_reader_model");
        //   $this->lang->load('message', 'english');
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('subject', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/index');
        $data['title'] = 'Add Subject';
        $subject_result = $this->subject_model->get();
        $data['subjectlist'] = $subject_result;
        $topicget = $this->subject_model->topicget();
        $data['topiclist'] = $topicget;
        // var_dump($data['subjectlist']);exit;

        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        // var_dump( $centre_id);exit;
        $data['centre_id']=$centre_id;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/subjectList', $data);
        $this->load->view('layout/footer', $data);
    }
    public function subjecthours()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/subjecthours');
        $data['title'] = 'Assign Teacher with Class and Subject wise';
        //$teacher = $this->teacher_model->get();
        $teacher = $this->staff_model->getStaffbyrole(2);
        $data['teacherlist'] = $teacher;
        $subject = $this->subject_model->get();
        $data['subjectlist'] = $subject;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();

        $data['is_search'] = false;

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $class_id = $this->input->post('class_id');
            $sections = $this->section_model->getClassBySection($class_id);

            $data['is_search'] = true;



            foreach ($sections as $key => $section) {


                $where_array = [
                    'section_id' => $section['section_id'],
                    'class_id' => $class_id,
                ];

                $subject_hours = $this->db->where($where_array)->get('subject_hours')->result_array();

                $sections[$key]['subject_hours'] = $subject_hours;


            }


            $data['sections'] = $sections;





            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjecthours', $data);
            $this->load->view('layout/footer', $data);

        } else {

            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjecthours', $data);
            $this->load->view('layout/footer', $data);
        }
    }

 public function academic_date_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('academic_date');

        redirect('admin/subject/academicDate');
    }



    public function combinedSubject()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/combinedsubject');
        $data['title'] = 'Academic Date';
        $data['title_list'] = 'Academic Date';


        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

        } else {

            $class = $this->input->post("class");
            $section = $this->input->post("section");
            $subject1 = $this->input->post("sub1");
            $subject2 = $this->input->post("sub2");

            $insert_array = [
                'class_id' => $class,
                'section_id' => $section,
                'subject1' => $subject1,
                'subject2' => $subject2,
            ];

            $this->db->insert('combined_subject', $insert_array);



            redirect('admin/subject/combinedSubject');
        }
        $classlist = $this->class_model->get();
        $data['classlist'] = $classlist;

        $sectionlist = $this->section_model->get();
        $data['sectionlist'] = $sectionlist;



        $data['date_items'] = $this->db->get('combined_subject')->result_array();

        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/combinedsubject', $data);
        $this->load->view('layout/footer', $data);
    }


    public function combinedSubjectdelete($id)
    {
        $this->db->where('id', $id)->delete('combined_subject');
        redirect('admin/subject/combinedSubject');
    }
    public function combinedSubjectedit($id)
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/combinedsubject');
        $data['title'] = 'Academic Date';
        $data['title_list'] = 'Academic Date';


        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            // $this->load->view('layout/header', $data);
            // $this->load->view('admin/subject/combinedsubjectedit', $data);
            // $this->load->view('layout/footer', $data);
        } else {

            $class = $this->input->post("class");
            $section = $this->input->post("section");
            $subject1 = $this->input->post("sub1");
            $subject2 = $this->input->post("sub2");

            $insert_array = [
                'class_id' => $class,
                'section_id' => $section,
                'subject1' => $subject1,
                'subject2' => $subject2,
            ];

            $this->db->where('id', $id)->update('combined_subject', $insert_array);

            redirect('admin/subject/combinedSubjectedit/' . $id);
        }
        $classlist = $this->class_model->get();
        $data['classlist'] = $classlist;

        $sectionlist = $this->section_model->get();
        $data['sectionlist'] = $sectionlist;
        $data['itemid'] = $id;

        $res = $this->db->where('id', $id)->get('combined_subject')->row_array();

        $data['item'] = $res;
        $data['items'] = $this->db->get('combined_subject')->result_array();
        $data['class_id'] = $res['class_id'];
        $data['section_id'] = $res['section_id'];

        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/combinedsubjectedit', $data);
        $this->load->view('layout/footer', $data);
    }
    public function assignsubjecthours()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/subjecthours');
        $data['title'] = 'Assign Teacher with Class and Subject wise';
        //$teacher = $this->teacher_model->get();
        $teacher = $this->staff_model->getStaffbyrole(2);
        $data['teacherlist'] = $teacher;
        // var_dump($teacher);exit;
        $subject = $this->subject_model->get();
        $data['subjectlist'] = $subject;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();

        $data['is_search'] = false;
        //   if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //  $data["classlist"] =   $this->customlib->getclassteacher($userdata["id"]);
        // }

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $data['is_search'] = true;
            $data['is_update'] = 0;

            // var_dump($this->input->post());exit;
            $data['class_id'] = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');

            $data['subjects'] = $this->teachersubject_model->getSubjectByClsandSectionNew($data['class_id'], $data['section_id']);


            // foreach($data['subjects'] as $subject){

            $where_array = [
                'class_id' => $data['class_id'],
                'section_id' => $data['section_id'],

            ];



            $subject_hour[] = $this->db
                ->where($where_array)
                ->get('subject_hours')
                ->result_array();

            // }

            $data['subject_hour'] = $subject_hour[0];


            // var_dump($data['subject_hour']);exit;

            if (count($subject_hour[0]) > 0) {
                $data['is_update'] = 1;
            }


            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjecthoursassign', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjecthoursassign', $data);
            $this->load->view('layout/footer', $data);

        }
    }


    public function academicDate()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/academicDate');
        $data['title'] = 'Academic Date';
        $data['title_list'] = 'Academic Date';


        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dateto', 'Date To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Date From', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

        } else {

            $class = $this->input->post("class");
            $section = $this->input->post("section");
            $datefrom = $this->input->post("datefrom");
            $dateto = $this->input->post("dateto");


            $insert_array = [
                'class_id' => $class,
                'section_id' => $section,
                'from' => $datefrom,
                'to' => $dateto,
            ];

            $this->db->insert('academic_date', $insert_array);



            redirect('admin/subject/academicDate');
        }
        $classlist = $this->class_model->get();
        $data['classlist'] = $classlist;

        $sectionlist = $this->section_model->get();
        $data['sectionlist'] = $sectionlist;



        $data['date_items'] = $this->db->get('academic_date')->result_array();

        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/academicdate', $data);
        $this->load->view('layout/footer', $data);
    }
    public function academicDateEdit($id)
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/academicDate');
        $data['title'] = 'Academic Date';
        $data['title_list'] = 'Academic Date';


        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dateto', 'Date To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Date From', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

        } else {

            $class = $this->input->post("class");
            $section = $this->input->post("section");
            $datefrom = $this->input->post("datefrom");
            $dateto = $this->input->post("dateto");


            $insert_array = [
                'class_id' => $class,
                'section_id' => $section,
                'from' => $datefrom,
                'to' => $dateto,
            ];

            $this->db->where('id', $id)->update('academic_date', $insert_array);

            redirect('admin/subject/academicDate');
        }
        $classlist = $this->class_model->get();
        $data['classlist'] = $classlist;

        $sectionlist = $this->section_model->get();
        $data['sectionlist'] = $sectionlist;



        $data['item'] = $this->db->where('id', $id)->get('academic_date')->row_array();
        $data['date_items'] = $this->db->get('academic_date')->result_array();

        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/academicdateedit', $data);
        $this->load->view('layout/footer', $data);
    }

    public function savesubjecthour()
    {

        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');

        $subjects = $this->input->post('subject_id');
        $theory_credits = $this->input->post('theory_credits');
        $theory_hours = $this->input->post('theory_hours');
        $lab_credits = $this->input->post('lab_credits');
        $lab_hours = $this->input->post('lab_hours');
        $clinical_credits = $this->input->post('clinical_credits');
        $clinical_hours = $this->input->post('clinical_hours');
        $is_update = $this->input->post('is_update');



        

        foreach ($subjects as $key => $subject) {

            $insert_array = [
                'class_id' => $class_id,
                'section_id' => $section_id,
                'subject_id' => $subject,
                'theory_credits' => $theory_credits[$key],
                'theory_hours' => $theory_hours[$key],
                'lab_credits' => $lab_credits[$key],
                'lab_hours' => $lab_hours[$key],
                'clinical_credits' => $clinical_credits[$key],
                'clinical_hours' => $clinical_hours[$key],

            ]; 

            $where_array = array(
                'class_id' => $class_id,
                'section_id' => $section_id,
                'subject_id' => $subject,
            );

            // Check if the row exists
            $this->db->where($where_array);
            $query = $this->db->get('subject_hours');

            // var_dump($insert_array);exit;
            if ($query->num_rows() > 0) {
                // Row exists, perform an update
                $this->db->where($where_array)->update('subject_hours', $insert_array);
            } else { 
                
                $this->db->insert('subject_hours', $insert_array);
            }
 

        }



        redirect('admin/subject/assignsubjecthours');

    }

    public function view($id)
    {
        if (!$this->rbac->hasPrivilege('subject', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Subject List';
        $subject = $this->subject_model->get($id);
        $data['subject'] = $subject;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/subjectShow', $data);
        $this->load->view('layout/footer', $data);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('subject', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Subject List';
        $this->subject_model->remove($id);
        redirect('admin/subject/index');
    }

    // public function create()
    // {
    //     if (!$this->rbac->hasPrivilege('subject', 'can_add')) {
    //         access_denied();
    //     }
    //     $data['title'] = 'Add subject';
    //     $subject_result = $this->subject_model->get();
    //     $data['subjectlist'] = $subject_result;
    //     // var_dump($data['subjectlist']);exit;
    //     //$this->form_validation->set_rules('name', 'Subject Name', 'trim|required|xss_clean|callback__check_name_exists');
    //     $this->form_validation->set_rules('name', 'Subject Name', 'trim|required|xss_clean');
    //     if ($this->input->post('code')) {
    //         $this->form_validation->set_rules('code', 'Code', 'trim|required|callback__check_code_exists');
    //     }

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('layout/header', $data);
    //         $this->load->view('admin/subject/subjectList', $data);
    //         $this->load->view('layout/footer', $data);
    //     } else {

    //         $admin = $this->session->userdata('admin');
    //         $centre_id = $admin['centre_id'];
    //         $topics = $this->input->post('topics');
    //         $data = array(
    //             'centre_id' => $centre_id,
    //             'name' => $this->input->post('name'),
    //             'code' => $this->input->post('code'),
    //             'theory' => $this->input->post('theory'),
    //             'viva' => $this->input->post('viva'),
    //             'practical' => $this->input->post('practical'),
    //             'lab' => $this->input->post('lab'),
    //             'clinical'=>$this->input->post('clinical'),
    //             'cocurricular' => $this->input->post('cocurricular'),
                


    //         );
    //         // var_dump($data);exit;
    //         $this->subject_model->add($data);

    //         if (!empty($topics) && is_array($topics)) {
    //             $this->subject_model->addTopics($subject_id, $topics); // Save topics
    //         }
    //         $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Subject added successfully</div>');
    //         redirect('admin/subject/index');
    //     }
    // }


    public function create()
    {
        if (!$this->rbac->hasPrivilege('subject', 'can_add')) {
            access_denied();
        }
        $data['title'] = 'Add subject';
        $subject_result = $this->subject_model->get();
        $data['subjectlist'] = $subject_result;
     
    
        $this->form_validation->set_rules('name', 'Subject Name', 'trim|required|xss_clean');
    
        if ($this->input->post('code')) {
            $this->form_validation->set_rules('code', 'Code', 'trim|required|callback__check_code_exists');
        }
    
        if ($this->form_validation->run() == false) {
            // Reload the form with errors
            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjectList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $admin = $this->session->userdata('admin');
            $centre_id = $admin['centre_id'];
    
            // Collect form inputs
            $topics = $this->input->post('topics'); // Multiple topics array
            $data = array(
                'centre_id' => $centre_id,
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'theory' => $this->input->post('theory'),
                'viva' => $this->input->post('viva'),
                'practical' => $this->input->post('practical'),
                'lab' => $this->input->post('lab'),
                'clinical' => $this->input->post('clinical'),
                'cocurricular' => $this->input->post('cocurricular'),
            );
    
            // Insert the subject
            $subject_id = $this->subject_model->add($data);
            // Add topics only if not empty
            if (!empty($topics) && is_array($topics)) {
                foreach ($topics as $topic) {
                    if (!empty($topic)) { // Ensure no empty topic is added
                        $topic_data = array(
                            'subject_id' => $subject_id,
                            'topic' =>$topic // Trim to remove unnecessary spaces
                        );
                        $this->subject_model->addTopics($topic_data); // Save each topic
                    }
                }
            }
    
            // Success message and redirect
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Subject and topics added successfully</div>');
            redirect('admin/subject/index');
        }
    }
    

    public function _check_name_exists()
    {
        $data['name'] = $this->security->xss_clean($this->input->post('name'));
        if ($this->subject_model->check_data_exists($data)) {
            $this->form_validation->set_message('_check_name_exists', 'Name already exists');
            return false;
        } else {
            return true;
        }
    }

    public function _check_code_exists()
    {
        $data['code'] = $this->security->xss_clean($this->input->post('code'));
        if ($this->subject_model->check_code_exists($data)) {
            $this->form_validation->set_message('_check_code_exists', 'Code already exists');
            return false;
        } else {
            return true;
        }
    }

    public function _check_code1_exists()
    {
        $data['code1'] = $this->security->xss_clean($this->input->post('code1'));
        if ($this->subject_model->check_code_exists($data)) {
            $this->form_validation->set_message('_check_code1_exists', 'Code already exists');
            return false;
        } else {
            return true;
        }
    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('subject', 'can_edit')) {
            access_denied();
        }
    
        $data['title'] = 'Edit Subject';
        $data['id'] = $id;
        $subject_result = $this->subject_model->get();
        $data['subjectlist'] = $subject_result;
     
        // Fetch existing subject data
        $subject = $this->subject_model->get($id);
        $data['subject'] = $subject;
    
        // Fetch existing topics for this subject
        $data['topics'] = $this->subject_model->getTopicsBySubject($id);
    
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $data['centre_id'] = $centre_id;
    
        // Set form validation rules
        $this->form_validation->set_rules('name', 'Subject', 'trim|required|xss_clean');
    
        if ($this->form_validation->run() == false) {
            // If validation fails, load the edit form with existing data
            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjectEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            // Collect form input
            $subject_data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'theory' => $this->input->post('theory'),
                'viva' => $this->input->post('viva'),
                'practical' => $this->input->post('practical'),
                'lab' => $this->input->post('lab'),
                'clinical' => $this->input->post('clinical'),
                'cocurricular' => $this->input->post('cocurricular'),
            );
    
            // Update subject details
            $this->subject_model->update($subject_data);
    
            // Handle topics
            $topics = $this->input->post('topics'); // Get the new topics from the form
    
            // Delete old topics for the subject
            $this->subject_model->deleteTopicsBySubject($id);
    
            // If new topics are provided, insert them
            if (!empty($topics) && is_array($topics)) {
                foreach ($topics as $topic) {
                    $topic_data = array(
                        'subject_id' => $id,
                        'topic' => $topic
                    );
                    $this->subject_model->addTopics($topic_data); // Insert new topics
                }
            }
    
            // Set success message and redirect
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Subject updated successfully</div>');
            redirect('admin/subject/index');
        }
    }
    

    public function getSubjctByClassandSection()
    {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $date = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
        echo json_encode($date);
    }


    public function read_csv()
    {
       
        $file_info = pathinfo($_FILES["documents"]["name"]);
        $file_directory = 'uploads/subject/';
        $new_file_name =rand(000000, 999999) .".". $file_info["extension"];

    if(move_uploaded_file($_FILES["documents"]["tmp_name"], $file_directory.$new_file_name))
       {    
           $file_type	= PHPExcel_IOFactory::identify($file_directory .$new_file_name);
           
           $objReader	= PHPExcel_IOFactory::createReader($file_type);
           $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load($file_directory . $new_file_name);
    $sheet_data	= $objPHPExcel->getActiveSheet();
     $header=true;

      if ($header) {
        $highestRow = $sheet_data->getHighestRow();
        $highestColumn = $sheet_data->getHighestColumn();
        $headingsArray = $sheet_data->rangeToArray('A1:' . $highestColumn . '1', null, true, true, true);
        $headingsArray = $headingsArray[1];
        $r = -1;
        $namedDataArray = array();
        for ($row = 2; $row <= $highestRow; ++$row) {
            $dataRow = $sheet_data->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
            if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                ++$r;
                foreach ($headingsArray as $columnKey => $columnHeading) {
                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                }
            }
        }
    }
    else {

        //excel sheet with no header
        $namedDataArray = $sheet_data->toArray(null, true, true, true);
    }
     
   

    foreach ($namedDataArray as $data) {
                  

                    $this->subject_model->insert_subject($data);
                }
         
                redirect('admin/subject/import_subject');
        
          }
    }


public function import_subject()
	{
	if (!$this->rbac->hasPrivilege('books', 'can_add')) {
            access_denied();
        }	
		$this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'book/file_import');
		
		 $this->load->view('layout/header');
         $this->load->view('admin/subject/import_subject');
         $this->load->view('layout/footer');
		 }
public function topicexcel()
{
    $this->load->model('Subject_model');
    $this->load->model('Topic_model');

    $data['subjects'] = $this->Subject_model->get_all_subjects();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->load->library('upload');

        $config['upload_path'] = './uploads/excel/';
        $config['allowed_types'] = 'csv'; 
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('documents')) {
            $data['error'] = $this->upload->display_errors();
        } else {
            $upload_data = $this->upload->data();
            $file_path = $config['upload_path'] . $upload_data['file_name'];

            if (($handle = fopen($file_path, "r")) !== FALSE) {
                $insertData = [];
                $rowNumber = 0;
                while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $rowNumber++;
                    if ($rowNumber == 1) continue; 
                    if (!empty($row[0])) {
                        $insertData[] = [
                            'subject_id' => $this->input->post('subject'),
                            'topic' => $row[0],
                        ];
                    }
                }
                fclose($handle);

              if (!empty($insertData)) {
    $this->Topic_model->insert_topics($insertData);
    $this->session->set_flashdata('msg', '<div class="alert alert-success">Topics imported successfully!</div>');
    redirect('admin/subject/topicexcel');
} else {
    $this->session->set_flashdata('msg', '<div class="alert alert-danger">CSV file is empty or missing topics.</div>');
    redirect('admin/subject/topicexcel');
} 
            } else {
                $data['error'] = "Could not open the uploaded CSV file.";
            }
        }
    }
    $this->load->view('layout/header');
    $this->load->view('admin/subject/topicexcel', $data);
    $this->load->view('layout/footer');
}


}