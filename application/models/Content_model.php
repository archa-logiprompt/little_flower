<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null) {
        $this->db->select('contents.*,classes.class,sections.section,(select GROUP_CONCAT(role) FROM content_for WHERE content_id=contents.id) as role,class_sections.id as `aa`')->from('contents');
        $this->db->join('class_sections', 'contents.cls_sec_id = class_sections.id', 'left outer');
        $this->db->join('classes', 'class_sections.class_id = classes.id', 'left outer');
        $this->db->join('sections', 'class_sections.section_id = sections.id', 'left outer');
        if ($id != null) {
            $this->db->where('contents.id', $id);
        }
        $this->db->order_by('contents.id', "desc");
        $this->db->limit(10);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function getContentByRole($id = null, $role = null) {
        $query = "SELECT contents.*,(select GROUP_CONCAT(role) FROM content_for WHERE content_id=contents.id) as role,class_sections.id as `class_section_id`,classes.class,sections.section  FROM `content_for`  INNER JOIN contents on contents.id=content_for.content_id left JOIN class_sections on class_sections.id=contents.cls_sec_id left join classes on classes.id=class_sections.class_id LEFT JOIN sections on sections.id=class_sections.section_id WHERE (role='student' and created_by='" . $id . "' ) or (created_by=0 and role='" . $role . "')  GROUP by contents.id";
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getListByCategory($category) {
        $this->db->select('contents.*,classes.class')->from('contents');
        $this->db->join('classes', 'contents.class_id = classes.id', 'left outer');
        $this->db->where('contents.type', $category);
        $this->db->order_by('contents.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getListByCategoryforUser($class_id, $section_id, $category = '') {

        if (empty($class_id)) {

            $class_id = "0";
        }

        if (empty($section_id)) {

            $section_id = "0";
        }
        $query = "SELECT contents.*,class_sections.id as `class_section_id`,classes.class,sections.section FROM `content_for` INNER JOIN contents on content_for.content_id=contents.id left JOIN class_sections on class_sections.id=contents.cls_sec_id left join classes on classes.id=class_sections.class_id LEFT JOIN sections on sections.id=class_sections.section_id WHERE  (role='student' and contents.type='" . $category . "' and contents.is_public='yes') or (classes.id =" . $class_id . " and sections.id=" . $section_id . " and role='student' and contents.type='" . $category . "')";
        $query = $this->db->query($query);
        return $query->result_array();
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('contents');
    }
    // public function removes($id) {
    //     $this->db->where('id', $id);
    //     $this->db->delete('contents');
    // }

    public function search_by_content_type($text) {
        $this->db->select()->from('contents');
        $this->db->or_like('contents.content_type', $text);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data, $content_role = array()) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('contents', $data);
        } else {
            $this->db->insert('contents', $data);
            $insert_id = $this->db->insert_id();
            if (isset($content_role) && !empty($content_role)) {
                $total_rec = count($content_role);
                for ($i = 0; $i < $total_rec; $i++) {
                    $content_role[$i]['content_id'] = $insert_id;
                }
                $this->db->insert_batch('content_for', $content_role);
            }
            return $insert_id;
        }
    }

public function getListByCategorynew($category) {
        $this->db->select('contents.*,classes.class')->from('contents');
        $this->db->join('classes', 'contents.class_id = classes.id', 'left outer');
        $this->db->where('contents.type', $category);
        $this->db->order_by('contents.id');
        $query = $this->db->get();
        return $query->result_array();
    }
public function getListBybank($category) {
        $this->db->select('contents.*,classes.class')->from('contents');
        $this->db->join('classes', 'contents.class_id = classes.id', 'left outer');
        $this->db->where('contents.type', $category);
        $this->db->order_by('contents.id');
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function getinternalmarks($student_id)
    {
       $query=$this->db->select('internalmarks.*,internal_mark_group.id as gid,internal_mark_group.type,internal_mark_group.name,internal_mark_group.sub_type,internal_mark_group.class_id,internal_mark_group.section_id,internal_mark_group.subject_id,teacher_subjects.subject_id as tsubid,subjects.id as sid,teacher_subjects.id as tid,subjects.name as sname')->from('internalmarks')->join('internal_mark_group','internal_mark_group.id =internalmarks.type_id')
       ->join('teacher_subjects','internal_mark_group.subject_id=teacher_subjects.id')
        ->join('subjects','subjects.id=teacher_subjects.subject_id')
       ->where('student_id',$student_id)->get()->result_array();
    //    echo $this->db->last_query();exit;
       return $query;
    }



}
