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
        if (!$this->rbac->hasPrivilege('trial', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/trial');
        $data['financial_year'] = $this->trial->getFinancialYear();

        $admin = $this->session->userdata('admin');

        $centre_id = $admin['centre_id'];
        $finYear = $admin['financial_year'];
        $year = $this->input->post('year');

        // var_dump($finYear,$year);exit;
        if ($finYear == $year) {


            $data['type'] = 0;
            $data['capital'] = $this->trial->getCurrentCapital($centre_id, $year);
            $data['pcapital'] = $this->trial->getPreviousCapital($centre_id, $year - 101);

            $data['cash'] = $this->trial->getCurrentCash($centre_id, $year);
            $data['pcash'] = $this->trial->getPreviousCash($centre_id, $year - 101);

            $data['ledgers'] = $this->trial->getCurrent($centre_id);
            $data['profit_and_loss'] = $this->trial->getProfitAndLoss($year - 101);

            $openingStock = $this->trial->getOpeningStock($year - 101);
            $data['purchases'] = $this->trial->getPurchase($centre_id);
            $purchaseValue = $data['purchases']->debit - $data['purchases']->credit;

            $soldGoods = 0;
            $data['stockLeft'] = $this->pandl->getStockLeft($centre_id, $year);
            foreach ($data['stockLeft'] as $row) {
                $soldGoods = ($row["total"] * $row["price"]) + $soldGoods;
            }
            // var_dump($soldGoods);exit;

            if ($soldGoods == 0) {
                $data['purchaseValue'] = 0;
            } else if ($purchaseValue == 0) {
                $data['purchaseValue'] = 0;
            } else {
                $data['purchaseValue'] = abs($purchaseValue - $soldGoods - $purchaseValue);
            }

            // Convert values to integers or floats if they are in string format



            // Calculate closingStock
            $data['closingStock'] = abs($soldGoods - $openingStock->closing_stock - ($purchaseValue != 0 ? abs($purchaseValue) : 0));
        } else {
            $data['type'] = 1;
            $capital = $this->trial->getCapital($centre_id, $year);
            $currentCapital = $this->trial->getCurrentCapital($centre_id, $year);
            $data['capital'] = $capital->balance + $currentCapital->credit - $currentCapital->debit;
            $data['ledgers'] = $this->trial->get($centre_id);
            $data['profit_and_loss'] = $this->trial->getProfitAndLoss($year - 101);
            $data['closingStock'] = $this->trial->getOpeningStock($year - 101);
        }




        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/trial');


        $this->load->view('layout/header', $data);
        $this->load->view('admin/accounts/trial', $data);
        $this->load->view('layout/footer', $data);
    }
}
