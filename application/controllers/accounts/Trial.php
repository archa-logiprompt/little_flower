<?php

/**
 * 
 */
class Trial extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('accounts/Trial_Model', 'trial');
        $this->load->model('accounts/ProfitAndLoss_Model', 'pandl');
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('trial', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/trial');

        $data['financial_year'] = $this->trial->getFinancialYear();

        $this->load->view('layout/header', $data);
        $this->load->view('admin/accounts/trial', $data);
        $this->load->view('layout/footer', $data);
    }

    public function search()
    {

        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/trial');
        if (!$this->rbac->hasPrivilege('trial', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/trial');
        $data['financial_year'] = $this->trial->getFinancialYear();

        $admin = $this->session->userdata('admin');
        $data['type'] = false;
        $this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/accounts/trial', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $centre_id = $admin['centre_id'];
            $finYear = $admin['financial_year'];
            $year = $this->input->post('year');
            $data['year'] = $this->trial->getFinancialYear($year);
            if ($finYear == $year) {

                $data['type'] = "current";

                $assetAndLiability = $this->trial->getAssetAndLiability($year);
                $data['assetAndLiability'] = $assetAndLiability;
                $data['profitAndLoss'] = $this->trial->getProfitAndLoss($year - 101);

                $incomeAndExpense = $this->trial->getIncomeAndExpense();
                $data['incomeAndExpense'] = $incomeAndExpense;
                // $data['profit_and_loss'] = $this->trial->getProfitAndLoss($year - 101);




            } else {

                $data['type'] = "previous";
                $assetAndLiability = $this->trial->getPreviousAssetAndLiability($year);
                $data['assetAndLiability'] = $assetAndLiability;
                $data['profitAndLoss'] = $this->trial->getProfitAndLoss($year-101);

                $incomeAndExpense = $this->trial->getPreviousIncomeAndExpense($year);

            }
            $data['incomeAndExpense'] = $incomeAndExpense;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/accounts/trial', $data);
            $this->load->view('layout/footer', $data);
        }




    }
}
