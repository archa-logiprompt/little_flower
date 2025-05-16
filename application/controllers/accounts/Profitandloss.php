<?php

/**
 * 
 */
class Profitandloss extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('accounts/ProfitAndLoss_Model', 'pandl');
        $this->load->model('accounts/Trial_Model', 'trial');
    }

    public function index()
    {

        if (!$this->rbac->hasPrivilege('p&l_account', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/trial');
        $data['financial_year'] = $this->trial->getFinancialYear();

        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/p&l_account');
        $this->load->view('layout/header');
        $this->load->view('admin/accounts/profitandloss', $data);
        $this->load->view('layout/footer');
    }
    // function __construct()
    // {
    //     parent::__construct();
    //     $this->load->model('accounts/ledger_model', 'ledger');
    // }


    public function search()
    {

        if (!$this->rbac->hasPrivilege('p&l_account', 'can_view')) {
            access_denied();
        }


        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/p&l_account');
        $data['financial_year'] = $this->trial->getFinancialYear();

        $this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean');

        $admin = $this->session->userdata('admin');
        $data['type'] = false;
        $this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/accounts/profitandloss', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $centre_id = $admin['centre_id'];
            $finYear = $admin['financial_year'];
            $year = $this->input->post('year');
            $data['year'] = $this->trial->getFinancialYear($year);
            if ($finYear == $year) {

                $data['type'] = "current";


                

                $incomeAndExpense = $this->trial->getIncomeAndExpense();

                $data['netProfitLoss'] = $this->customlib->saveProfitAndLoss($incomeAndExpense, $year);
                $data['incomeAndExpense'] = $incomeAndExpense;



            } else {

                $data['type'] = "previous";
                $incomeAndExpense = $this->trial->getPreviousIncomeAndExpense($year);
                $data['incomeAndExpense'] = $incomeAndExpense;
                $netProfitLoss = $this->trial->getProfitAndLoss($year);
                $data['netProfitLoss'] = $netProfitLoss;

            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/accounts/profitandloss', $data);
            $this->load->view('layout/footer', $data);
        }

    }
}




?>