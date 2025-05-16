<?php

/**
 * 
 */
class Balancesheet extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('accounts/BalanceSheet_Model', 'balancesheet');
        $this->load->model('accounts/ProfitAndLoss_Model', 'pandl');
        $this->load->model('accounts/Trial_Model', 'trial');
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('balance_sheet', 'can_view')) {
            access_denied();
        }
        $data['financial_year'] = $this->trial->getFinancialYear();
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $year = $admin['financial_year'];
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];

        $data['type'] = 3;



        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/balance_sheet');
        $this->load->view('layout/header');
        $this->load->view('admin/accounts/balancesheet', $data);
        $this->load->view('layout/footer');
    }

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
            $this->load->view('layout/header');
            $this->load->view('admin/accounts/balancesheet', $data);
            $this->load->view('layout/footer');
        } else {
            $centre_id = $admin['centre_id'];
            $finYear = $admin['financial_year'];
            $year = $this->input->post('year');
            $data['year'] = $this->trial->getFinancialYear($year);
            if ($finYear == $year) {

                $data['type'] = "current";
                $liability = $this->trial->getLiabilityWithoutCapital($year);
                $assets = $this->trial->getAssets($year);
                $capital = $this->trial->getCapital($year);
                $data['liability'] = $liability;
                $data['assets'] = $assets;
                $data['capital'] = $capital;
                $data['profitAndLoss'] = $this->trial->getProfitAndLoss($year);
                $data['reserveAndSurplus'] = $this->trial->getAllProfitAndLoss($year - 101);

                $incomeAndExpense = $this->trial->getIncomeAndExpense();
                $data['incomeAndExpense'] = $incomeAndExpense;
            } else {

                $data['type'] = "previous";
                $liability = $this->trial->getPreviousLiabilityWithoutCapital($year);
                $assets = $this->trial->getPreviousAssets($year);
                $capital = $this->trial->getPreviousCapital($year);
                $data['liability'] = $liability;
                $data['assets'] = $assets;
                $data['capital'] = $capital;
                $data['profitAndLoss'] = $this->trial->getProfitAndLoss($year);
                $data['reserveAndSurplus'] = $this->trial->getAllProfitAndLoss($year - 101);

            }
            $this->load->view('layout/header');
            $this->load->view('admin/accounts/balancesheet', $data);
            $this->load->view('layout/footer');
        }

    }
}
