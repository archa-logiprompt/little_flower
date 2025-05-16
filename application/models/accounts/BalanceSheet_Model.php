<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BalanceSheet_Model extends CI_Model
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

    //  public function getLiability($centre_id){
    //     $result=$this->db->select('*,ledgers.ledger as lname')->from('ledgers')
    //     ->join('account_groups','account_groups.id = ledgers.type')
    //     ->join('accounts','accounts.id = account_groups.account_type')
    //     ->join('ledger_balance','ledger_balance.type = ledgers.type','left')
    //     ->where('accounts.id',2)
    //     ->or_where('accounts.id',4)
    //     ->where('ledgers.centre_id',$centre_id)
    //     ->where_not_in('ledgers.type',5)
    //     ->get()->result_array();
    //     // echo $this->db->last_query();exit;
    //     // var_dump($result);exit;
    //     return $result;
    // }
    
    
    public function getLiability($centre_id){
        $result=$this->db->select('*,ledgers.ledger as lname')->from('ledgers')
       ->join("account_groups","account_groups.id =ledgers.type")
        ->join("accounts","accounts.id =account_groups.account_type")
        ->where('accounts.id',4)
        ->get()->result_array();
        // echo $this->db->last_query();exit;
        // var_dump($result);exit;
        return $result;
    }
    
    public function getAsset($centre_id){
         $result=$this->db->select('*,ledgers.ledger as lname')->from('ledgers')
       ->join("account_groups","account_groups.id =ledgers.type")
        ->join("accounts","accounts.id =account_groups.account_type")
        ->where('accounts.id',1)
        ->get()->result_array();
        // echo $this->db->last_query();exit;
        // var_dump($result);exit;
        return $result;
    }

    


    // public function getAsset($centre_id){
    //     $result=$this->db->select('*,ledgers.ledger as lname')->from('ledgers')
    //     ->join('account_groups','account_groups.id = ledgers.type')
    //     ->join('accounts','accounts.id = account_groups.account_type')
    //     ->join('ledger_balance','ledger_balance.type = ledgers.type','left')
    //     ->where('accounts.id',1)
    //     ->where('ledgers.centre_id',$centre_id)
    //     ->order_by("account_groups.order")->get()->result_array();
    //     // echo $this->db->last_query();exit;
    //     // var_dump($result);exit;
    //     return $result;
    // }

}
