<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Journal_Model extends CI_Model
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

    public function get()
    {
        $query = $this->db->select('*,ledgers.id as lid')->from('ledgers')
            ->join('account_groups', 'account_groups.id = ledgers.type')->get()->result_array();
        // var_dump($query);exit;
        return $query;
    }
    public function getFiltered()
    {
        $query = $this->db->select('*,ledgers.id as lid')->from('ledgers')
            ->join('account_groups', 'account_groups.id = ledgers.type')
            ->where('ledgers.type',1)
            ->or_where('ledgers.type',6)
            ->get()->result_array();
            // echo $this->db->last_query();exit;
        // var_dump($query);exit;
        return $query;
    }

    public function add($data)
    {
        $this->db->insert('account_logs',$data);


        // $debit=($data['debit']);
        // $debitAmount=$data['debit_amount'];
        // var_dump($debitAmount);exit;
        
        
    }
    



}