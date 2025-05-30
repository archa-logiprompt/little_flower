<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teachersubject_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id = null)
    {
        $this->db->select()->from('teacher_subjects');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function teachersubject($id = null)
    {
        $this->db->select()->from('teacher_subjects');
        if ($id != null) {
            $this->db->where('teacher_id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function remove($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('teacher_subjects');
    }

    public function deleteBatch($ids, $class_section_id)
    {


        $this->db->where('class_section_id', $class_section_id);
        $this->db->where('session_id', $this->current_session);
        $this->db->where_not_in('id', $ids);
        $this->db->delete('teacher_subjects');
    }

    public function add($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('teacher_subjects', $data);
        } else {
            $this->db->insert('teacher_subjects', $data);
            return $this->db->insert_id();
        }

    }

    public function getDetailByclassAndSection($class_section_id)
    {
        $this->db->select()->from('teacher_subjects');
        $this->db->where('class_section_id', $class_section_id);
        //$this->db->where('teacher_subjects.session_id', $this->current_session);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDetailbyClsandSection($class_id, $section_id, $exam_id, $sub_type = null)
    {
        $query = $this->db->query("SELECT teacher_subjects.*,exam_schedules.date_of_exam,exam_schedules.start_to,exam_schedules.end_from,exam_schedules.room_no,exam_schedules.full_marks,exam_schedules.passing_marks,exam_schedules.topics,subjects.code,exam_schedules.teacher as scheduleteacher,subjects.name,subjects.type FROM `teacher_subjects` LEFT JOIN `exam_schedules` ON exam_schedules.teacher_subject_id=teacher_subjects.id AND exam_schedules.exam_id = " . $this->db->escape($exam_id) . "  INNER JOIN subjects
            ON teacher_subjects.subject_id = subjects.id INNER JOIN class_sections
            ON teacher_subjects.class_section_id = class_sections.id WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) . " and subjects.theory=" . $this->db->escape($sub_type));

        return $query->result_array();

    }

    public function getPracticalbyClsandSection($class_id, $section_id, $exam_id, $sub_type = null)
    {
        $query = $this->db->query("SELECT teacher_subjects.*,practical_schedules.date_of_exam,practical_schedules.start_to,practical_schedules.end_from,practical_schedules.room_no,practical_schedules.full_marks,practical_schedules.topics,practical_schedules.teacher as scheduleteacher,practical_schedules.passing_marks,subjects.name,subjects.type FROM `teacher_subjects` LEFT JOIN `practical_schedules` ON practical_schedules.teacher_subject_id=teacher_subjects.id AND practical_schedules.exam_id = " . $this->db->escape($exam_id) . "  INNER JOIN subjects ON teacher_subjects.subject_id = subjects.id INNER JOIN class_sections ON teacher_subjects.class_section_id = class_sections.id WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) . " and subjects.practical=" . $this->db->escape($sub_type));
        return $query->result_array();
    }

    public function getVivabyClsandSection($class_id, $section_id, $exam_id, $sub_type = null)
    {
        $query = $this->db->query("SELECT teacher_subjects.*,viva_schedules.date_of_exam,viva_schedules.start_to,viva_schedules.end_from,viva_schedules.room_no,viva_schedules.full_marks,viva_schedules.passing_marks,viva_schedules.topics,viva_schedules.teacher as scheduleteacher,subjects.name,subjects.type FROM `teacher_subjects` LEFT JOIN `viva_schedules` ON viva_schedules.teacher_subject_id=teacher_subjects.id AND viva_schedules.exam_id = " . $this->db->escape($exam_id) . "  INNER JOIN subjects ON teacher_subjects.subject_id = subjects.id INNER JOIN class_sections ON teacher_subjects.class_section_id = class_sections.id WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) . "and subjects.viva=" . $this->db->escape($sub_type));

        return $query->result_array();
    }


//     public function getSubjectByClsandSectionNew($class_id, $section_id)
//     {

//         $sql = "SELECT teacher_subjects.*, subjects.name, subjects.code, subjects.theory, subjects.practical 
//         FROM `teacher_subjects` 
//         INNER JOIN subjects ON teacher_subjects.subject_id = subjects.id 
//         INNER JOIN class_sections ON teacher_subjects.class_section_id = class_sections.id 
//         WHERE class_sections.class_id = " . $this->db->escape($class_id) . " 
//         AND class_sections.section_id = " . $this->db->escape($section_id) . " 
//         GROUP BY teacher_subjects.subject_id
//         ORDER BY subjects.name";  // Add this line for sorting by subject name

// $query = $this->db->query($sql);

//         // var_dump($this->db->last_query());exit;

//         return $query->result_array();
//     }

public function getSubjectByClsandSectionNew($class_id, $section_id)
{

    $sql = "SELECT teacher_subjects.*, subjects.name, subjects.code, subjects.theory, subjects.practical 
    FROM `teacher_subjects` 
    INNER JOIN subjects ON teacher_subjects.subject_id = subjects.id 
    INNER JOIN class_sections ON teacher_subjects.class_section_id = class_sections.id 
    WHERE class_sections.class_id = " . $this->db->escape($class_id) . " 
    AND class_sections.section_id = " . $this->db->escape($section_id) . " 
    GROUP BY teacher_subjects.subject_id
    ORDER BY subjects.name";  // Add this line for sorting by subject name

    $query = $this->db->query($sql);

    // var_dump($this->db->last_query());exit;

    return $query->result_array();
}

    public function getavailablesubjects($class_id, $section_id)
    {

        $sql = "SELECT teacher_subjects.*, subjects.name,subjects.type FROM `teacher_subjects` INNER JOIN subjects ON teacher_subjects.subject_id = subjects.id INNER JOIN class_sections ON teacher_subjects.class_section_id = class_sections.id WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id);

        $query = $this->db->query($sql);

        return $query->result_array();
    }


    public function getSubjectByClsandSection($class_id, $section_id, $types)
    {
        // var_dump("here");exit;
        if ($types == 'Theory') {
            $s = " and subjects.theory=" . $this->db->escape($types);
        } else {
            $s = " and subjects.practical=" . $this->db->escape($types);
        }
        // var_dump($types);
        $sql = "SELECT teacher_subjects.*,staff.name as `teacher_name`, staff.surname, subjects.name,subjects.theory,subjects.practical,subjects.code FROM `teacher_subjects` INNER JOIN subjects ON teacher_subjects.subject_id = subjects.id INNER JOIN class_sections ON teacher_subjects.class_section_id = class_sections.id INNER JOIN staff ON staff.id = teacher_subjects.teacher_id  WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) . $s;

        $query = $this->db->query($sql);

        // echo $this->db->last_query();exit;
        return $query->result_array();
    }
    public function getSubjectByClsandSectionnewval($class_id, $section_id, $type)
    {
        if ($type == 'Theory') {
            $s = " and subjects.theory=" . $this->db->escape($type);
        } else {
            $s = " and subjects.practical=" . $this->db->escape($type);
        }
        $sql = "SELECT teacher_subjects.*,staff.name as `teacher_name`, staff.surname, subjects.name,subjects.type,subjects.code FROM `teacher_subjects` INNER JOIN subjects ON teacher_subjects.subject_id = subjects.id INNER JOIN class_sections ON teacher_subjects.class_section_id = class_sections.id INNER JOIN staff ON staff.id = teacher_subjects.teacher_id  WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id);

        $query = $this->db->query($sql);

        return $query->result_array();
    }

    public function addfeedback($data)
    {

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('feedback', $data);
        } else {
            $this->db->insert('feedback', $data);
        }
        return 'success';
    }







    public function getSubjectByClsandSectionnewplan($class_id, $section_id, $type)
    {
        if ($type == 'Theory') {
            $s = " and subjects.theory=" . $this->db->escape($type);
        } else {
            $s = " and subjects.practical=" . $this->db->escape($type);
        }
        $sql = "SELECT teacher_subjects.*,staff.name as `teacher_name`, staff.surname, subjects.name,subjects.type,subjects.code FROM `teacher_subjects` INNER JOIN subjects ON teacher_subjects.subject_id = subjects.id INNER JOIN class_sections ON teacher_subjects.class_section_id = class_sections.id INNER JOIN staff ON staff.id = teacher_subjects.teacher_id  WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id);

        $query = $this->db->query($sql);

        return $query->result_array();
    }



    public function getSubjectByClsandSectionstaff($class_id, $section_id, $subject_id, $type, $dept)
    {
        if ($type == 'Theory') {
            $s = " and subjects.theory=" . $this->db->escape($type);
        } else {
            $s = " and subjects.practical=" . $this->db->escape($type);
        }
        $sql = "SELECT teacher_subjects.subject_id,teacher_subjects.class_section_id,teacher_subjects.teacher_id,teacher_subjects.session_id,staff.name as `teacher_name` ,staff.id,staff.surname, subjects.name as subject,subjects.type,subjects.code FROM `teacher_subjects` INNER JOIN subjects ON teacher_subjects.subject_id = subjects.id INNER JOIN class_sections ON teacher_subjects.class_section_id = class_sections.id INNER JOIN staff ON staff.id = teacher_subjects.teacher_id  WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) . " and staff.department=" . $this->db->escape($dept) . " and subjects.id =" . $this->db->escape($subject_id);

        $query = $this->db->query($sql);

        return $query->result_array();
    }

    public function getSubjectByClsandSectionstaffreport($class_id, $section_id, $subject_id, $staff_id, $from, $to)
    {

        // $sql = " SELECT staff.name,staff_evaluation.total_hour, staff.name as 'sname',subjects.name,subjects.type,subjects.code FROM student_attendences INNER JOIN staff ON student_attendences.staff_id=staff.id INNER JOIN subjects ON student_attendences.subject_id = subjects.id INNER JOIN staff_evaluation ON subjects.id=staff_evaluation.subject_id INNER JOIN student_session ON student_session.id=student_attendences.student_session_id WHERE student_session.class_id =" . $this->db->escape($class_id) . " AND student_session.section_id=".$this->db->escape($section_id)." and student_attendences.subject_id =" . $this->db->escape($subject_id) . " and student_attendences.session_id=" . $this->db->escape($this->current_session) . " and student_attendences.staff_id=". $this->db->escape($staff_id)." and  student_attendences.date >=".$this->db->escape($from)." and  student_ttendences.date <= ".$this->db->escape($to) ;

        $sql = " SELECT staff.name,staff_evaluation.total_hour, staff.name as 'sname',subjects.name,subjects.type,subjects.code FROM staff_evaluation INNER JOIN subjects ON subjects.id=staff_evaluation.subject_id INNER JOIN student_attendences ON student_attendences.subject_id = subjects.id INNER JOIN staff ON student_attendences.staff_id=staff.id INNER JOIN student_session ON student_session.id=student_attendences.student_session_id WHERE student_session.class_id =" . $this->db->escape($class_id) . " AND student_session.section_id=" . $this->db->escape($section_id) . " and student_attendences.subject_id =" . $this->db->escape($subject_id) . " and student_attendences.session_id=" . $this->db->escape($this->current_session) . " and student_attendences.staff_id=" . $this->db->escape($staff_id) . " and  student_attendences.date >=" . $this->db->escape($from) . " and  student_attendences.date <= " . $this->db->escape($to);


        $query = $this->db->query($sql);
        // echo $sql;
        return $query->result_array();
    }







    public function getSubjctBySection($class_id, $section_id)
    {
        $this->db->select('teacher_subjects.subject_id,subjects.name,subjects.id');
        $array = array(
            'teacher_subjects.class_section_id' => $section_id
        );
        $this->db->where($array);
        $this->db->from('teacher_subjects');
        $this->db->join('subjects', 'teacher_subjects.subject_id=subjects.id');
        return $query = $this->db->get()->result();
    }

    public function getSubjctBySectionNew($class_id, $section_id)
    {
        $this->db->select('teacher_subjects.subject_id,subjects.name,subjects.id');
        $array = array(
            'sections.id' => $section_id
        );
        $this->db->where($array);
        $this->db->from('teacher_subjects');
        $this->db->join('subjects', 'teacher_subjects.subject_id=subjects.id');
        $this->db->join('class_sections', 'teacher_subjects.class_section_id=class_sections.id');
        $this->db->join('sections', 'class_sections.section_id=sections.id');
        return $query = $this->db->get()->result();
    }
    public function getDepartmentByClsandSection($class_id, $section_id)
    {
        $this->db->select('department.department_name,subjects.name,timetables.*');
        //$this->db->select('*');
        $array = array(
            'timetables.class_id' => $class_id,
            'timetables.section_id' => $section_id
        );
        $this->db->where($array);
        $this->db->from('timetables');
        $this->db->join('subjects', 'timetables.subject_id = subjects.id');
        $this->db->join('department', 'timetables.department_id = department.id');
        return $query = $this->db->get()->result();
    }




    // public function get_subjectteachers($subject_id)
    // {

    //     $this->db->select('teacher_subjects.*')->from('teacher_subjects');
    //     /* $this->db->join('staff','teacher_subjects.teacher_id=staff.id');*/
    //     $this->db->where('teacher_subjects.id', $subject_id);
    //     $query = $this->db->get();
    //     $res = $query->row();

    //     if ($query->num_rows() > 0) {

    //         $teacher_id = $res->teacher_id;
    //         $t = explode(',', $teacher_id);
    //         $this->db->select('staff.name,staff.surname,staff.id');
    //         $this->db->from('staff');
    //         $this->db->where_in('staff.id', $t);
    //         $st = $this->db->get();
    //         return $st->result_array();

    //     }
    // }

    public function get_subjectteachers($subject_id = null)
    {
        $this->db->select('teacher_subjects.*')->from('teacher_subjects');
        /* $this->db->join('staff','teacher_subjects.teacher_id=staff.id');*/
        if ($subject_id) {
            $this->db->where('teacher_subjects.id', $subject_id);
        }
        $query = $this->db->get();
        $res = $query->row();

        if ($query->num_rows() > 0) {

            $teacher_id = $res->teacher_id;
            $t = explode(',', $teacher_id);
            $this->db->select('staff.name,staff.surname,staff.id');
            $this->db->from('staff');
            if ($subject_id) {
                $this->db->where_in('staff.id', $t);
            } else {
                $this->db->join('staff_roles', 'staff_roles.staff_id=staff.id')->where_in('role_id', '2');
            }
            $st = $this->db->get();
            return $st->result_array();
        }
    }

    public function get_subjectteachersnew($subject_id, $dep)
    {

        $this->db->select('teacher_subjects.*')->from('teacher_subjects');
        /* $this->db->join('staff','teacher_subjects.teacher_id=staff.id');*/
        $this->db->where('teacher_subjects.id', $subject_id);
        $query = $this->db->get();
        $res = $query->row();

        if ($query->num_rows() > 0 and $dep != null) {

            $teacher_id = $res->teacher_id;
            $t = explode(',', $teacher_id);
            $this->db->select('staff.name,staff.surname,staff.id');
            $this->db->from('staff');
            $this->db->where_in('staff.id', $t);
            $this->db->where('staff.department', $dep);
            $st = $this->db->get();
            return $st->result_array();

        } elseif ($query->num_rows() > 0) {
            $teacher_id = $res->teacher_id;
            $t = explode(',', $teacher_id);
            $this->db->select('staff.name,staff.surname,staff.id');
            $this->db->from('staff');
            $this->db->where_in('staff.id', $t);
            //$this->db->where('staff.department',$dep);
            $st = $this->db->get();
            return $st->result_array();

        }
    }




    public function get_subjectdepartment()
    {

        $this->db->select('department.department_name,id');
        return $query = $this->db->get('department')->result();
    }

    public function getminutes($sub_id)
    {
        $todaydate = date('l');

        $this->db->select('timetables.*');
        $this->db->where(array('teacher_subject_id' => $sub_id, 'day_name' => $todaydate));
        $query = $this->db->get('timetables')->result_array();

        //echo json_encode($query);
        return $query;


    }



    function getTeacherClassSubjects($teacher_id)
    {
        $this->db->select('teacher_subjects.*,subjects.name,classes.class,sections.section');
        $this->db->from('teacher_subjects');
        $this->db->join('subjects', 'subjects.id = teacher_subjects.subject_id');
        $this->db->join('class_sections', 'class_sections.id = teacher_subjects.class_section_id');
        $this->db->join('classes', 'classes.id = class_sections.class_id');
        $this->db->join('sections', 'sections.id = class_sections.section_id');
        $this->db->where('teacher_subjects.teacher_id', $teacher_id);
        $this->db->where('teacher_subjects.session_id', $this->current_session);
        $query = $this->db->get();
        return $query->result();
    }
    public function getSubjectBymine($class_id, $section_id, $staff)
    {

        $sql = "SELECT teacher_subjects.*, subjects.name,subjects.type FROM `teacher_subjects` INNER JOIN subjects ON teacher_subjects.subject_id = subjects.id INNER JOIN class_sections ON teacher_subjects.class_section_id = class_sections.id WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id);

        $query = $this->db->query($sql);

        return $query->result_array();
    }







}