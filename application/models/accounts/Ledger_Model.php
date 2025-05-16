<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ledger_Model extends CI_Model
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

    public function get($centre_id)
    {
        $query = $this->db->select('*,ledgers.id as lid')->from('ledgers')
            ->join('account_groups', 'account_groups.id = ledgers.type')->order_by('order')
            ->where('centre_id',$centre_id)->get()->result_array();
        return $query;
    }
    public function getType()
    {
        $query = $this->db->select('*')->from('account_groups')->get()->result_array();
        // var_dump($query);
        // exit;
        return $query;
    }
    public function getById($id)
    {
        $query = $this->db->select('*')->from('ledgers')
            ->join('account_groups', 'account_groups.id = ledgers.type')
            ->where('ledgers.id', $id)->get()->row_array();

        // var_dump($query);
        // exit;
        return $query;
    }

    public function add($data)
    {
        // var_dump($data);exit;
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('ledgers', $data);
        } else {
            $result=$this->db->select('ledger')->from('ledgers')
            ->where('ledger',$data['ledger'])
            ->where('centre_id',$data['centre_id'])->get()->row();
            // var_dump($result);exit;
            if ($result==null)
            {
                $this->db->insert('ledgers', $data);
            }

        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('ledgers');
    }

    public function class_exists($str)
    {

        $class = $this->security->xss_clean($str);
        $res = $this->check_data_exists($class);

        if ($res) {
            $name = $this->input->post('name');
            if (isset($name)) {
                if ($res->id == $name) {
                    return TRUE;
                }
            }
            $this->form_validation->set_message('name', 'Record already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_data_exists($data)
    {
        $this->db->where('ledger', $data);
        $query = $this->db->get('ledgers');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    function viewLedger($data)
    {

        // $result=$this->db->select('*')->from('account_logs')->join('account_groups', 'account_groups.id = ledgers.type')->like('debit','"'.$data.'"')
        // ->get()->result_array();
        // print_r($this->db->last_query($result)) ;

        // var_dump($result);exit;

        $query = $this->db->select('*')->from('account_logs')->where('is_changed',0)->order_by('date')->get();
        $result = $query->result_array();
        
        // Initialize an array to store filtered results
        $filteredResults = array();
        $filteredCreditResults=[];
        $filteredDebitResults=[];
        // Loop through the result set and filter rows where 'debit' contains 1
        foreach ($result as $row) {
            $debitData = json_decode($row['debit'], true); // Decode the JSON array
            if (in_array($data, $debitData)) {
                $filteredDebitResults[] = $row;
            }
            $debitData = json_decode($row['credit'], true); // Decode the JSON array
            if (in_array($data, $debitData)) {
                $filteredCreditResults[] = $row;
            }
        } 

        $rdata['creditdata'] = $filteredCreditResults;
        $rdata['debitdata'] = $filteredDebitResults;
        return $rdata;
    }

    function ledgerName($id)
    {
        $query=$this->db->select('ledger')->from('ledgers')->where('id',$id)->get()->row();
        // var_dump($query);exit;
        return $query;
    }




}