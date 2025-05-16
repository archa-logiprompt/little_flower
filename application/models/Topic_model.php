<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Topic_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
     public function insert_topics($data)
    {
        return $this->db->insert_batch('subject_topics', $data);
    }
}