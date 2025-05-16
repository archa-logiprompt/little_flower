<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ProfitAndLoss_Model extends CI_Model
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

    public function getExpenses($centre_id){
        $result=$this->db->select('*')->from('ledgers')
        ->join('account_groups','account_groups.id = ledgers.type')
        ->join('accounts','accounts.id = account_groups.account_type')
        ->where('accounts.id',5)
        // ->where('centre_id',$centre_id)
        // ->where_not_in('ledgers.type',25)
        ->get()->result_array();
        // echo $this->db->last_query();exit;
        // var_dump($result);exit;
        return $result;
    }
    public function getIncome($centre_id){
        $result=$this->db->select('*')->from('ledgers')
        ->join('account_groups','account_groups.id = ledgers.type')
        ->join('accounts','accounts.id = account_groups.account_type')
        ->where('accounts.id',3)
        // ->where('centre_id',$centre_id)
        ->get()->result_array();
        // echo $this->db->last_query();exit;
        // var_dump($result);exit;
        return $result;
    }

    public function getOpeningStock($centre_id,$year){

        $result=$this->db->select('closing_stock')->from('financial_year')
        ->where('value',$year)->where('centre_id',$centre_id)->get()->row();
        // echo $this->db->last_query();exit;
        return $result;
    }
    public function getStockLeft($centre_id,$year){
        $result=$this->db->select('sum(item_issue.quantity) as total')->select('item.price')->from('item_issue')->join('item','item.id = item_issue.item_id')->where('item_issue.centre_id',$centre_id)->where('item_issue.financial_year',$year)->group_by('item_issue.item_id')->get()->result_array();
        // echo $this->db->last_query();exit;
        // var_dump($result);exit;
        return $result;
    }

    public function getPurchase($centre_id){
        $result=$this->db->select('*')->from('ledgers')->join('account_groups','account_groups.id=ledgers.type')->where('account_groups.id',25)->get()->row();
        // var_dump($result);exit;
        return $result;
    }
    
   

    
}