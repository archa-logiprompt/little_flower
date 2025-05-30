<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Weeklycalendarteacher extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("classteacher_model");
        $this->load->model('Timetablenew_model');
        $this->load->helper('lang');
    }

    function index()
    {
        if (!$this->rbac->hasPrivilege('weekly_calendar', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'admin/weeklycalendarteacher/index');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Marks';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get();
        $data['examlist'] = $exam;
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();

        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/weeklycalendar_teacher/createcalendar', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;


            $data['class_name'] = $this->db->select('class')->where('id', $class_id)->get('classes')->row()->class;
            $data['section_name'] = $this->db->select('section')->where('id', $section_id)->get('sections')->row()->section;




            $wherearray = [
                'course_id' => $class_id,
                'batch_id' => $section_id,
            ];
            $data['weekcalendar'] = $this->db->where($wherearray)->get('week_calendar')->result_array();

            // var_dump($this->db->last_query());exit;




            $this->load->view('layout/header', $data);
            $this->load->view('admin/weeklycalendar_teacher/weeklycalendar', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function view($id)
    {
        if (!$this->rbac->hasPrivilege('weekly_calendar', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Mark List';
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/weeklycalendar_teacher/timetableShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id)
    {

        $this->db->where('id', $id)->delete('week_calendar');
        redirect('admin/weeklycalendar_teacher/index');
    }

    function create()
    {
        if (!$this->rbac->hasPrivilege('weekly_calendar', 'can_view')) {

            access_denied();
        }

        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Schedule';
        $data['subject_id'] = "";
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['department_id'] = "";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $data['isupdate'] = false;
        $data['issearch'] = false;


        $event_colors = array("#03a9f4", "#c53da9", "#757575", "#8e24aa", "#d81b60", "#7cb342", "#fb8c00", "#fb3b3b");
        $data["event_colors"] = $event_colors;
        if ($this->input->server('REQUEST_METHOD') == "POST") {

            if ($this->input->post('search') == 'Search') {

                $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('layout/header', $data);
                    $this->load->view('admin/weeklycalendar_teacher/createcalendar', $data);
                    $this->load->view('layout/footer', $data);
                } else {

                    $data['class_id'] = $this->input->post('class_id');
                    $data['section_id'] = $this->input->post('section_id');
                    $data['issearch'] = true;
                    $data['userid'] = $this->customlib->getUserData()['id'];


                    $wherearray = [
                        'course_id' => $data['class_id'],
                        'batch_id' =>  $data['section_id'],

                    ];

                    $data['students'] =
                        $this->db->from('student_session')
                        ->join('students', 'student_session.student_id = students.id')
                        ->where(['class_id' => $data['class_id'], 'section_id' => $data['section_id']])
                        ->order_by('students.firstname', 'ASC')
                        ->get()
                        ->result_array();

                    $data['weekcalendar'] = $this->db->where($wherearray)->get('week_calendar')->result_array();
                    $data['period_list'] = $this->db->where([
                        'class_id' => $data['class_id'],
                        'section_id' => $data['section_id'],
                    ])->get('period_timing')->row();

                    $data['isupdate'] = !empty($data['weekcalendar']);
                    $data['topiclist'] = $this->db->select('*')->from('subject_topics')->get()->result_array();




                    $this->load->view('layout/header', $data);
                    $this->load->view('admin/weeklycalendar_teacher/createcalendar', $data);
                    $this->load->view('layout/footer', $data);
                }
            }
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/weeklycalendar_teacher/createcalendar', $data);
            $this->load->view('layout/footer', $data);
        }
    }


    function saveattendance()
    {

        $student_id = $this->input->post('hdnstudentid');
        $attendencetype = $this->input->post('attendencetype');
        $remark = $this->input->post('remark');
        $period = str_replace('_div', '', $this->input->post('period'));
        $class = $this->input->post('hidden_class');
        $section = $this->input->post('hidden_section');
        $subject = $this->input->post('subject');
        $date = $this->input->post('date');
        $type = $this->input->post('pt');
        $teacher_id = $this->customlib->getUserData()['id'];

        $isupdate = $this->input->post('isupdate');

        foreach ($student_id as $key => $value) {

            $insert_array = [

                'class_id' => $class,
                'section_id' => $section,
                'subject_id' => $subject,
                'teacher_id' => $teacher_id,
                'student_id' => $value,
                'period' => $period,
                'attendencetype' => $attendencetype[$key],
                'remark' => $remark[$key],
                'date' => $date,
                'type' => $type
            ];

            if ($isupdate == 0) {

                $this->db->insert('student_period_attendance', $insert_array);
            } else {
                $wherearray = [
                    'class_id' => $class,
                    'section_id' => $section,
                    'period' => $period,
                    'date' => $date,
                    'student_id' => $value,
                ];

                $this->db->where($wherearray)->update('student_period_attendance', $insert_array);
            }
        }
        echo json_encode('success');
    }

    function getattendance()
    {

        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $date = $this->input->post('date');
        $period = str_replace('_div', '', $this->input->post('period'));


        $wherearray = [
            'class_id' => $class_id,
            'section_id' => $section_id,
            'period' => $period,
            'date' => $date,
        ];


        $result = $this->db->where($wherearray)->get('student_period_attendance')->result();
        // echo $this->db->last_query();exit;
        echo json_encode($result);
        // echo json_encode($this->input->post());

    }


    function savecalendar()
    {
        $subjects = $this->input->post('subject_id');
        $teachers = $this->input->post('teacher_id');
        $date = $this->input->post('event_dates');
        $class = $this->input->post('hidden_class');
        $section = $this->input->post('hidden_section');

        $insert_array = [
            'class_id' => $class,
            'section_id' => $section,
            'date' => $date,
            'eight_to_nine_subject' => $subjects[0],
            'eight_to_nine_teacher' => $teachers[0],
            'nine_to_ten_subject' => $subjects[1],
            'nine_to_ten_teacher' => $teachers[1],
            'ten_to_eleven_subject' => $subjects[2],
            'ten_to_eleven_teacher' => $teachers[2],
            'eleven_to_twelve_subject' => $subjects[3],
            'eleven_to_twelve_teacher' => $teachers[3],
            'twelve_to_one_subject' => $subjects[4],
            'twelve_to_one_teacher' => $teachers[4],
            'two_to_three_subject' => $subjects[5],
            'two_to_three_teacher' => $teachers[5],
            'three_to_four_subject' => $subjects[6],
            'three_to_four_teacher' => $teachers[6],
            'four_to_five_subject' => $subjects[7],
            'four_to_five_teacher' => $teachers[7],
        ];


        $this->db->insert('weekly_calendar', $insert_array);

        echo json_encode('success');
    }

    function edit($id)
    {
        if (!$this->rbac->hasPrivilege('weekly_calendar', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Edit Mark';
        $data['id'] = $id;
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->form_validation->set_rules('name', 'Mark', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/weeklycalendar_teacher/timetableEditnew', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'note' => $this->input->post('note'),
            );
            $this->mark_model->add($data);
            $this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">Employee added successfully</div>');
            redirect('admin/weeklycalendar_teacher/index');
        }
    }


    function check_exists()
    {

        $this->Timetablenew_model->valid_check_exists();
    }
    function getcalendar()
    {

        $section = $this->input->post('section_id');
        $class = $this->input->post('class_id');
        $userid = $this->input->post('user_id');




        $calendar =
            $this->db
            ->where([
                'section_id' => $section,
                'class_id' => $class
            ])
            ->get('weekly_calendar')->result_array();


        $period_list = $this->db->where([
            'class_id' => $class,
            'section_id' => $section,
        ])->get('period_timing')->row();




        $eventdata = [];

        $name = '';
        foreach ($calendar as $key => $value) {

            $period_list = $this->db->where([
                'id' => $value['period_id']
            ])->get('period_timing')->row();






            if ($value['eight_to_nine_teacher'] != 0) {

                $attendance = $this->checkAttendance($value['date'], "eight_to_nine");
                // echo $this->db->last_query();
                // var_dump($attendance);
                // exit;
                $checked1 = "";
                if ($attendance) {
                    $checked1 = "✓";
                }
                $name .= $checked1 . "$period_list->period_one_from - $period_list->period_one_to : " . $this->getStaffName($value['eight_to_nine_teacher']) . "(" . $this->getSubjectName($value['eight_to_nine_subject']) . ")\n";
            } else if ($value['eight_to_nine_activity'] != '') {
                $name .= "$period_list->period_one_from - $period_list->period_one_to : $value[eight_to_nine_activity]\n";
            }

            if ($value['nine_to_ten_teacher'] != 0) {
                $attendance = $this->checkAttendance($value['date'], "nine_to_ten");
                $checked2 = "";
                if ($attendance) {
                    $checked2 = "✓";
                }
                $name .= $checked2 . "$period_list->period_two_from - $period_list->period_two_to : " . $this->getStaffName($value['nine_to_ten_teacher']) . "(" . $this->getSubjectName($value['nine_to_ten_subject']) . ")\n";
            } else if ($value['nine_to_ten_activity'] != '') {
                $name .= "$period_list->period_two_from - $period_list->period_two_to : $value[nine_to_ten_activity]\n";
            }

            if ($value['ten_to_eleven_teacher'] != 0) {
                $attendance = $this->checkAttendance($value['date'], "ten_to_eleven");
                $checked3 = "";
                if ($attendance) {
                    $checked3 = "✓";
                }
                $name .= $checked3 . "$period_list->period_three_from - $period_list->period_three_to : " . $this->getStaffName($value['ten_to_eleven_teacher']) . "(" . $this->getSubjectName($value['ten_to_eleven_subject']) . ")\n";
            } else if ($value['ten_to_eleven_activity'] != '') {
                $name .= "$period_list->period_three_from - $period_list->period_three_to : $value[ten_to_eleven_activity]\n";
            }

            if ($value['eleven_to_twelve_teacher'] != 0) {
                $attendance = $this->checkAttendance($value['date'], "eleven_to_twelve");
                $checked4 = "";
                if ($attendance) {
                    $checked4 = "✓";
                }
                $name .= $checked4 . "$period_list->period_four_from - $period_list->period_four_to : " . $this->getStaffName($value['eleven_to_twelve_teacher']) . "(" . $this->getSubjectName($value['eleven_to_twelve_subject']) . ")\n";
            } else if ($value['eleven_to_twelve_activity'] != '') {
                $name .= "$period_list->period_four_from - $period_list->period_four_to : $value[eleven_to_twelve_activity]\n";
            }

            if ($value['twelve_to_one_teacher'] != 0) {
                $attendance = $this->checkAttendance($value['date'], "twelve_to_one");
                $checked5 = "";
                if ($attendance) {
                    $checked5 = "✓";
                }
                $name .= $checked5 . "$period_list->period_five_from - $period_list->period_five_to : " . $this->getStaffName($value['twelve_to_one_teacher']) . "(" . $this->getSubjectName($value['twelve_to_one_subject']) . ")\n";
            } else if ($value['twelve_to_one_activity'] != '') {
                $name .= "$period_list->period_five_from - $period_list->period_five_to : $value[twelve_to_one_activity]\n";
            }

            if ($value['two_to_three_teacher'] != 0) {
                $attendance = $this->checkAttendance($value['date'], "two_to_three");
                $checked6 = "";
                if ($attendance) {
                    $checked6 = "✓";
                }
                $name .= $checked6 . "$period_list->period_six_from - $period_list->period_six_to : " . $this->getStaffName($value['two_to_three_teacher']) . "(" . $this->getSubjectName($value['two_to_three_subject']) . ")\n";
            } else if ($value['two_to_three_activity'] != '') {
                $name .= "$period_list->period_six_from - $period_list->period_six_to : $value[two_to_three_activity]\n";
            }

            if ($value['three_to_four_teacher'] != 0) {
                $attendance = $this->checkAttendance($value['date'], "three_to_four");
                $checked7 = "";
                if ($attendance) {
                    $checked7 = "✓";
                }
                $name .= $checked7 . "$period_list->period_seven_from - $period_list->period_seven_to : " . $this->getStaffName($value['three_to_four_teacher']) . "(" . $this->getSubjectName($value['three_to_four_subject']) . ")\n";
            } else if ($value['three_to_four_activity'] != '') {
                $name .= "$period_list->period_seven_from - $period_list->period_seven_to : $value[three_to_four_activity]\n";
            }

            if ($value['four_to_five_teacher'] != 0) {
                $attendance = $this->checkAttendance($value['date'], "four_to_five");
                $checked8 = "";
                if ($attendance) {
                    $checked8 = "✓";
                }
                $name .= $checked8 . "$period_list->period_eight_from - $period_list->period_eight_to : " . $this->getStaffName($value['four_to_five_teacher']) . "(" . $this->getSubjectName($value['four_to_five_subject']) . ")\n";
            } else if ($value['four_to_five_activity'] != '') {
                $name .= "$period_list->period_eight_from - $period_list->period_eight_to : $value[four_to_five_activity]\n";
            }

            // echo $this->getDayFormatYDM($value['date']);
            // echo '<br/>';

            $eventdata[] = array(
                'id' => $value['id'],
                'title' => $name,
                'start' => (date("Y-m-d", strtotime($this->getDayFormatYDM($value['date'])))),
                'end' => (date("Y-m-d", strtotime($this->getDayFormatYDM($value['date'])))),

            );
            $name = '';
        }
        // foreach ($calendar as $key => $value) { 

        //     // if($value['eight_to_nine_teacher'] == $userid ){
        //     $name .= "$period_list->period_one_from - $period_list->period_one_to : " . $this->getSubjectName($value['eight_to_nine_subject']) . "\n";

        //     // }
        //     // if($value['nine_to_ten_teacher'] == $userid ){
        //     $name .= "$period_list->period_two_from - $period_list->period_two_to : " . $this->getSubjectName($value['nine_to_ten_subject']) . "\n";
        //     // }
        //     // if($value['ten_to_eleven_teacher'] == $userid ){
        //     $name .= "$period_list->period_three_from - $period_list->period_three_to : " . $this->getSubjectName($value['ten_to_eleven_subject']) . "\n";
        //     // }
        //     // if($value['eleven_to_twelve_teacher'] == $userid ){
        //     $name .= "$period_list->period_four_from - $period_list->period_four_to : " . $this->getSubjectName($value['eleven_to_twelve_subject']) . "\n";
        //     // }
        //     // if($value['twelve_to_one_teacher'] == $userid ){
        //     $name .= "$period_list->period_five_from - $period_list->period_five_to : " . $this->getSubjectName($value['twelve_to_one_subject']) . "\n";
        //     // }
        //     // if($value['two_to_three_teacher'] == $userid ){
        //     $name .= "$period_list->period_six_from - $period_list->period_six_to : " . $this->getSubjectName($value['two_to_three_subject']) . "\n";
        //     // }
        //     // if($value['three_to_four_teacher'] == $userid ){
        //     $name .= "$period_list->period_seven_from - $period_list->period_seven_to : " . $this->getSubjectName($value['three_to_four_subject']) . "\n";
        //     // }
        //     // if($value['four_to_five_teacher'] == $userid ){
        //     $name .= "$period_list->period_eight_from - $period_list->period_eight_to : " . $this->getSubjectName($value['four_to_five_subject']) . "\n";
        //     // }

        //     if ($name != '') {

        //         $eventdata[] = array(
        //             'id' => $value['id'],
        //             'title' => $name,
        //             'start' => (date("Y-m-d", strtotime($this->getDayFormatYDM($value['date'])))),
        //             'end' => (date("Y-m-d", strtotime($this->getDayFormatYDM($value['date'])))),
        //         );
        //     }



        //     $name = '';
        // }
        // exit;


        echo json_encode($eventdata);
    }


    function addActivity()
    {

        $calendarid = $this->input->post('calendarid');
        $period = $this->input->post('period');
        $activity = $this->input->post('activity');

        $teacher_id = $this->customlib->getUserData()['id'];

        $insert_array = [
            'teacher_id' => $teacher_id,
            'subject_id' => '',
            'calendar_id' => $calendarid,
            'topic' => '',
            'works' => '',
            'assigned_teacher' => '',
            'period' => str_replace("_div", "", $period),
            'other_teacher' => 0,
            'activity' => $activity,
            'is_class' => 0
        ];



        $this->db->insert('period_report', $insert_array);


        echo json_encode('Success');
    }
    function updateActivity()
    {

        $calendarid = $this->input->post('calendarid');
        $period = $this->input->post('period');
        $activity = $this->input->post('activity');

        $teacher_id = $this->customlib->getUserData()['id'];

        $insert_array = [
            'teacher_id' => $teacher_id,
            'subject_id' => '',
            'calendar_id' => $calendarid,
            'topic' => '',
            'works' => '',
            'assigned_teacher' => '',
            'period' => str_replace("_div", "", $period),
            'other_teacher' => 0,
            'activity' => $activity,
            'is_class' => 0
        ];

        $this->db->where('id', $this->input->post('id'))->update('period_report', $insert_array);


        echo json_encode('Success');
    }

    function saveperiod()
    {

        $img_name = '';
        if ($_FILES) {

            $files = $_FILES;
            $filename = ($_FILES["assigned_work"]["name"]);
            $img_name = "uploads/assigned_works/" . $filename;
            $path = move_uploaded_file($_FILES["assigned_work"]["tmp_name"], $img_name);
        }

        $userdata = $this->customlib->getUserData()['id'];

        $insert_array = [

            'teacher_id' => $userdata,
            'subject_id' => $this->input->post('subject_id'),
            'calendar_id' => $this->input->post('calendarid'),
            'topic' => $this->input->post('topic_id'),
            'works' => $img_name,
            'assigned_teacher' => $this->input->post('teacher_id'),
            'period' => $this->input->post('period'),
            'other_teacher' => $this->input->post('teacher_id') == $userdata ? 0 : 1,
            'is_class' => 1

        ];
        // var_dump($insert_array);exit;

        if ($this->input->post('teacher_id') == $userdata) {

            $this->db->insert('period_report', $insert_array);
        }

        $week_calendar_update = [
            '' . $this->input->post('period') . '_teacher' => $this->input->post('teacher_id'),
        ];

        $this->db->where('id', $this->input->post('calendarid'))->update('weekly_calendar', $week_calendar_update);


        echo json_encode('Success');
    }
    function updateperiod()
    {

        $img_name = '';
        if ($_FILES) {

            $files = $_FILES;
            $filename = ($_FILES["assigned_work"]["name"]);
            $img_name = "uploads/assigned_works/" . $filename;
            $path = move_uploaded_file($_FILES["assigned_work"]["tmp_name"], $img_name);
        }

        $id = $this->input->post('id');
        $userdata = $this->customlib->getUserData()['id'];
        if ($img_name != '') {

            $update_array = [
                'teacher_id' => $userdata,
                'subject_id' => $this->input->post('subject_id'),
                'calendar_id' => $this->input->post('calendarid'),
                'topic' => $this->input->post('topic_id'),
                'works' => $img_name,
                'assigned_teacher' => $this->input->post('teacher_id'),
                'period' => $this->input->post('period'),
                'other_teacher' => $this->input->post('teacher_id') == $userdata ? 0 : 1,
            ];
        } else {
            $update_array = [
                'teacher_id' => $userdata,
                'subject_id' => $this->input->post('subject_id'),
                'calendar_id' => $this->input->post('calendarid'),
                'topic' => $this->input->post('topic_id'),
                'assigned_teacher' => $this->input->post('teacher_id'),
                'period' => $this->input->post('period'),
                'other_teacher' => $this->input->post('teacher_id') == $userdata ? 0 : 1,
            ];
        }
        $this->db->where('id', $id)->update('period_report', $update_array);


        $week_calendar_update = [
            '' . $this->input->post('period') . '_teacher' => $this->input->post('teacher_id'),
            '' . $this->input->post('period') . '_topic' => $this->input->post('topic_id')
        ];

        $this->db->where('id', $this->input->post('calendarid'))->update('weekly_calendar', $week_calendar_update);




        echo json_encode('Success');
    }


    function getPeriod()
    {


        $calendar = $this->input->post('calendarid');
        $period = $this->input->post('period');
        $subject = $this->input->post('subject');
        $userid = $this->input->post('userid');


        $wherearray = [
            // 'teacher_id'=>$userid,
            'period' => $period,
            'subject_id' => $subject,
            'calendar_id' => $calendar,
        ];


        $period = $this->db->select('*,period_report.id as period_id')->join('weekly_calendar', 'weekly_calendar.id=period_report.calendar_id')->where($wherearray)->get('period_report')->row();
        

        echo json_encode($period);
    }

    function updatecalendar()
    {

        $subjects = $this->input->post('subject_id');
        $teachers = $this->input->post('teacher_id');
        $id = $this->input->post('hidden_id');

        $insert_array = [

            'eight_to_nine_subject' => $subjects[0],
            'eight_to_nine_teacher' => $teachers[0],
            'nine_to_ten_subject' => $subjects[1],
            'nine_to_ten_teacher' => $teachers[1],
            'ten_to_eleven_subject' => $subjects[2],
            'ten_to_eleven_teacher' => $teachers[2],
            'eleven_to_twelve_subject' => $subjects[3],
            'eleven_to_twelve_teacher' => $teachers[3],
            'twelve_to_one_subject' => $subjects[4],
            'twelve_to_one_teacher' => $teachers[4],
            'two_to_three_subject' => $subjects[5],
            'two_to_three_teacher' => $teachers[5],
            'three_to_four_subject' => $subjects[6],
            'three_to_four_teacher' => $teachers[6],
            'four_to_five_subject' => $subjects[7],
            'four_to_five_teacher' => $teachers[7],
        ];


        $this->db->where('id', $id)->update('weekly_calendar', $insert_array);

        echo json_encode('success');
    }


    function view_event($id)
    {


        $timetable = $this->db->where('id', $id)->get('weekly_calendar')->row();
        echo json_encode($timetable);
    }


    function getStaffName($id)
    {



        $name = $this->db->select('staff.name')->where('staff.id', $id)->get('staff')->row();

        return $name->name;
    }

    function checkAttendance($date, $period)
    {

        $attendance = $this->db->where('date', $date)->where('period', $period)->group_by('date')->get('student_period_attendance')->result();
        return $attendance;
    }
    function getSubjectName($id)
    {



        $name = $this->db->select('subjects.name')->from('subjects')->join('teacher_subjects', 'teacher_subjects.subject_id=subjects.id')->where('teacher_subjects.id', $id)->get()->row();

        return $name->name;
    }
    public function getDayFormatYDM($date)
    {
        $date_string = $date;
        $date_format = 'd/m/Y';
        $dateformat = DateTime::createFromFormat($date_format, $date_string);
        return $dateformat->format('Y-m-d');
    }

    public function getalltopics()
    {
        $result = $this->db->select('*,subject_topics.id as topic_id')->join('subjects', 'subjects.id=teacher_subjects.subject_id')->join('subject_topics', 'subject_topics.subject_id=subjects.id')->where('teacher_subjects.id', $this->input->post('subject'))->get('teacher_subjects')->result_array();
        echo json_encode($result);
    }
}
