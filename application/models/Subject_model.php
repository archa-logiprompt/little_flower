<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subject_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


    public function addTopics($topics)
{
   
    $this->db->insert('subject_topics',$topics);
}
public function deleteTopicsBySubject($subject_id)
{
    $this->db->where('subject_id', $subject_id);
    $this->db->delete('subject_topics');
}
public function update($data)
{
    $this->db->where('id', $data['id']);
    $this->db->update('subjects', $data);
}


public function getTopicsBySubject($subject_id) {
    $this->db->select('topic');
    $this->db->from('subject_topics');
    $this->db->where('subject_id', $subject_id);
    $query = $this->db->get();
    // echo $this->db->last_query();exit;
    return $query->result_array(); // Return topics as an array
}
public function getTopicsBySubjectforweekly($subject_id) {
    $this->db->select('subjects.id as sub_id, subject_topics.*, teacher_subjects.subject_id as tsubid');
$this->db->from('subject_topics');
$this->db->join('teacher_subjects', 'subject_topics.subject_id = teacher_subjects.subject_id'); // Join teacher_subjects first
$this->db->join('subjects', 'subjects.id = teacher_subjects.subject_id'); // Then join subjects
$this->db->where('teacher_subjects.id', $subject_id);

    $query = $this->db->get();
    // echo $this->db->last_query();exit;
    return $query->result_array(); 
}
public function get($id = null) {
    $admin = $this->session->userdata('admin');
    $centre_id = $admin['centre_id'];

    $this->db->select('subjects.*, GROUP_CONCAT(subject_topics.topic SEPARATOR ", ") as topics')
             ->from('subjects')
             ->join('subject_topics', 'subject_topics.subject_id = subjects.id', 'left')
             ->where('subjects.centre_id', $centre_id)
             ->group_by('subjects.id'); // Group by subject to combine topics

    if ($id != null) {
        $this->db->where('subjects.id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return a single subject
    } else {
        $this->db->order_by('subjects.name', 'ASC');
        $query = $this->db->get();
        return $query->result_array(); // Return all subjects with combined topics
    }
}



  public function topicget($id = null) {

     
        $this->db->select()->from('subject_topics');
       
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('topic');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }
	
	public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('subjects');
    }
	

    public function add($data) {

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('subjects', $data);
        } else {
            $this->db->insert('subjects', $data);
        //   echo $this->db->last_query();exit;
            return $this->db->insert_id();
        }
    }

    function check_data_exists($data) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->where('centre_id',$centre_id);
        $this->db->where('name', $data['name']);
        $query = $this->db->get('subjects');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function check_code_exists($data) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->where('centre_id',$centre_id);
        $this->db->where('code', $data['code']);
        $query = $this->db->get('subjects');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	
	function check_code1_exists($data) {
        $this->db->where('code2', $data['code1']);
        $query = $this->db->get('subjects');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	
	 public function add_minutes($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('minutes', $data);
        } else {
            $this->db->insert('minutes', $data);
            return $this->db->insert_id();
        }
    }

	
	public function get_minutes($id = null) {

        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->select()->from('minutes');
        $this->db->where('centre_id',$centre_id);
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
  public function removeminutes($id) {
        $this->db->where('id', $id);
        $this->db->delete('minutes');
    }
	
	public function insert_subject($data)
 {
	$admin=$this->session->userdata('admin');


  $subject= [
	'centre_id'=>$admin['centre_id'],

                        'name' => $data['subject_name'],
                        'practical'    => $data['practical'],
                        'theory'       => $data['theory'],
                        'lab'          => $data['lab'],
                        'cocurricular' => $data['cocurricular'],
                        'clinical'     => $data['clinical'],
                        'code' => $data['subject_code'],
                    ];

	$this->db->insert('subjects',$subject); 
	 
	 }
	
 public function get_all_subjects() {
        $query = $this->db->get('subjects');
        return $query->result();
    }
}
