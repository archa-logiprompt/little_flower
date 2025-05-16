<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trial_Model extends CI_Model
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

    // public function getCurrent($centre_id)
    public function getCurrent()
    {
        $query = $this->db->select('*,ledgers.id as lid')->from('ledgers')
            ->join('account_groups', 'account_groups.id = ledgers.type')
            ->join('accounts', 'account_groups.account_type = accounts.id')
            // ->where('centre_id', $centre_id)
            // ->where_not_in('ledgers.type', 5)
            // ->where_not_in('ledgers.type', 6)
            // ->where_not_in('ledgers.type', 25)
            ->order_by('account_groups.order')
            ->get()->result_array();
        // var_dump($query);exit;
        return $query;
    }

    public function getAllCurrentLedger($centre_id)
    {
        $query = $this->db->select('*,ledgers.id as lid')->from('ledgers')
            ->join('account_groups', 'account_groups.id = ledgers.type')
            ->join('accounts', 'account_groups.account_type = accounts.id')
            ->where('centre_id', $centre_id)
            ->order_by('account_groups.order')
            ->get()->result_array();
        // var_dump($query);exit;
        return $query;
    }



    public function getFinancialYear($value = null)
    {
        $this->db->select('*');

        if ($value) {
            $this->db->where('value', $value)->from('financial_year');
            $query = $this->db->get()->row();
        } else {
            $this->db->from('financial_year')->order_by('value');
            $query = $this->db->get()->result_array();
        }



        //    var_dump($query);exit;
        // echo $this->db->last_query();exit;
        // var_dump($query);exit;
        return $query;
    }

    public function getCapital($year)
    {
        $query = $this->db->select('*,ledgers.id as lid', 'accounts.id as aid')->from('ledgers')
            ->join('account_groups', 'account_groups.id = ledgers.type')
            ->join('accounts', 'account_groups.account_type = accounts.id')
            ->where('accounts.id', 4)
            ->get()->result_array();
        // exit;
        foreach ($query as $key => $ledger) {
            $query[$key]['previousBalance'] = $this->db->select('sum(balance) as previousBalance')->where('ledger', $ledger['ledger'])->where('financial_year <', $year)->get('ledger_balance')->row()->previousBalance;
        }


        return $query;
    }

    public function getCurrentCash($centre_id)
    {
        $query = $this->db->select('*,ledgers.id as lid', 'accounts.id as aid')->from('ledgers')
            ->join('account_groups', 'account_groups.id = ledgers.type')
            ->join('accounts', 'account_groups.account_type = accounts.id')
            ->where('centre_id', $centre_id)
            ->where('ledgers.type', 6)
            ->get()->row();
        // echo $this->db->last_query();
        // exit;
        return $query;
    }



    public function getPreviousCash($centre_id, $year)
    {
        $query = $this->db->select('balance')->from('ledger_balance')
            ->join('account_groups', 'account_groups.id = ledger_balance.type')
            ->join('accounts', 'account_groups.account_type = accounts.id')
            ->where('centre_id', $centre_id)
            ->where('financial_year', $year)
            ->where('ledger_balance.type', 6)
            ->get()->row();
        // echo $this->db->last_query();
        // exit;
        return $query;
    }

    public function getProfitAndLoss($value)
    {
        $query = $this->db->select('profit_loss')
            ->where('value', $value)
            ->get('financial_year')->row();

        if ($query) {
            $profit_loss = $query->profit_loss;
        }
        return $profit_loss;
    }
    public function getAllProfitAndLoss($value)
    {
        $profitAndLoss = $this->db->select('sum(profit_loss) as total')
            ->where('value <=', $value)
            ->get('financial_year')->row();

        if ($profitAndLoss) {
            $profit_loss = $profitAndLoss->total;
        }

        return $profit_loss;
    }

    public function getOpeningStock($value)
    {
        $query = $this->db->select('closing_stock')->from('financial_year')
            ->where('value', $value)
            ->get()->row();
        // echo $this->db->last_query();
        // exit;
        // var_dump($query);exit;
        return $query;
    }



    public function get($centre_id)
    {
        $query = $this->db->select('*')->from('ledger_balance')
            ->join('account_groups', 'account_groups.id = ledger_balance.type')
            ->join('accounts', 'account_groups.account_type = accounts.id')
            ->where('centre_id', $centre_id)
            ->where_not_in('ledger_balance.type', 5)
            ->order_by('account_groups.order')
            ->get()->result_array();
        // var_dump($query);exit;
        return $query;
    }


    public function getPurchase($centre_id)
    {
        $query = $this->db->select('debit,credit')->from('ledgers')->where('centre_id', $centre_id)
            ->where('centre_id', $centre_id)->where('type', 25)->get()->row();
        // var_dump($query);exit;
        return $query;
    }

    public function getAssetAndLiability($year)
    {
        $query = $this->db->select()->join('account_groups', 'account_groups.id=ledgers.type')->join('accounts', 'accounts.id=account_groups.account_type')->where_in('accounts.id', [1, 2, 4])->order_by('account_groups.order')->get('ledgers')->result_array();
        foreach ($query as $key => $ledger) {
            $query[$key]['previousBalance'] = $this->db->select('sum(balance) as previousBalance')->where('ledger', $ledger['ledger'])->where('financial_year <', $year)->get('ledger_balance')->row()->previousBalance;
        }

        return ($query);

    }
    public function getLiabilityWithoutCapital($year)
    {
        $query = $this->db->select()->join('account_groups', 'account_groups.id=ledgers.type')->join('accounts', 'accounts.id=account_groups.account_type')->where('accounts.id', 2)->order_by('account_groups.order')->get('ledgers')->result_array();
        foreach ($query as $key => $ledger) {
            $query[$key]['previousBalance'] = $this->db->select('sum(balance) as previousBalance')->where('ledger', $ledger['ledger'])->where('financial_year <', $year)->get('ledger_balance')->row()->previousBalance;
        }

        return ($query);

    }

    public function getPreviousLiabilityWithoutCapital($year)
    {
        $query = $this->db->select('*,sum(balance) as previousBalance')->join('account_groups', 'account_groups.id=ledger_balance.type')->join('accounts', 'accounts.id=account_groups.account_type')->where('accounts.id', 2)->where('financial_year <=', $year)->group_by('ledger')->order_by('account_groups.order')->get('ledger_balance')->result_array();
        return $query;
    }



    public function getPreviousAssets($year)
    {
        $query = $this->db->select('*,sum(balance) as previousBalance')->join('account_groups', 'account_groups.id=ledger_balance.type')->join('accounts', 'accounts.id=account_groups.account_type')->where('accounts.id', 1)->where('financial_year <=', $year)->group_by('ledger')->order_by('account_groups.order')->get('ledger_balance')->result_array();
        return $query;
    }
    public function getPreviousCapital($year)
    {
        $query = $this->db->select('*,sum(balance) as previousBalance')->join('account_groups', 'account_groups.id=ledger_balance.type')->join('accounts', 'accounts.id=account_groups.account_type')->where('accounts.id', 4)->where('financial_year <=', $year)->group_by('ledger')->order_by('account_groups.order')->get('ledger_balance')->result_array();
        return $query;
    }


    public function getAssets($year)
    {
        $query = $this->db->select()->join('account_groups', 'account_groups.id=ledgers.type')->join('accounts', 'accounts.id=account_groups.account_type')->where('accounts.id', 1)->order_by('account_groups.order')->get('ledgers')->result_array();
        foreach ($query as $key => $ledger) {
            $query[$key]['previousBalance'] = $this->db->select('sum(balance) as previousBalance')->where('ledger', $ledger['ledger'])->where('financial_year <', $year)->get('ledger_balance')->row()->previousBalance;
        }

        return ($query);

    }



    public function getIncomeAndExpense()
    {
        $query = $this->db->select('*')->join('account_groups', 'account_groups.id=ledgers.type')->join('accounts', 'accounts.id=account_groups.account_type')->where_in('accounts.id', [3, 5])->order_by('account_groups.order')->get('ledgers')->result_array();

        return $query;


    }

    public function getPreviousAssetAndLiability($year)
    {
        $query = $this->db->select('*,sum(balance) as previousBalance')->join('account_groups', 'account_groups.id=ledger_balance.type')->join('accounts', 'accounts.id=account_groups.account_type')->where_in('accounts.id', [1, 2, 4])->where('financial_year <=', $year)->group_by('ledger')->order_by('account_groups.order')->get('ledger_balance')->result_array();

        return $query;

    }

    public function getPreviousIncomeAndExpense($year)
    {
        $query = $this->db->select()->join('account_groups', 'account_groups.id=ledger_balance.type')->join('accounts', 'accounts.id=account_groups.account_type')->where_in('accounts.id', [3, 5])->where('financial_year <=', $year)->order_by('account_groups.order')->get('ledger_balance')->result_array();
        return $query;
    }

    public function setProfitAndLoss($pl, $year)
    {
        $this->db->set('profit_loss', $pl)->where('value', $year)->update('financial_year');
        return $pl;
        // echo $this->db->last_query();exit;


    }
}
