<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Review_model extends CI_Model {

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
    public function save_review_score($data)
    {
        // var_dump("hi");exit;
         $this->db->insert('staff_reviews', $data);
    }
	public function student_save_review_score($data)
    {
        // var_dump("hi");exit;
         $this->db->insert('student_staff_reviews', $data);
    }
	

}
