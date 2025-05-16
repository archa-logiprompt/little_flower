<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AccountLog_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */

    public function get($from, $to, $centre_id)
    {
        $query = $this->db->select('*')->from('account_logs')
            ->where('centre_id', $centre_id)
            ->where('date >=', $from)
            ->where('date <=', $to)
            ->order_by('date')
            ->get()->result_array();
        // echo $this->db->last_query();exit;
        // var_dump($query);exit;

        return $query;
    }

    public function getEntry($id)
    {
        $result = $this->db->select()->where('id', $id)->get('account_logs')->row();
        return $result;
    }
}
