<?php

/**
 * 
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class AccountLogs extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('accounts/AccountLog_Model', 'history');
        $this->load->model('accounts/Journal_Model', 'journal');

        $this->load->helper('lang_helper');
    }

    public function index()
    {

        if (!$this->rbac->hasPrivilege('logs', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/logs');
        // $data['log'] = $this->history->get();

        $this->load->view('layout/header');
        $this->load->view('admin/accounts/accountLogs');
        $this->load->view('layout/footer');
    }

    public function search()
    {
        if (!$this->rbac->hasPrivilege('logs', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/logs');

        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];

        $from = $this->input->post('datefrom');
        $to = $this->input->post('dateto');

        $newFrom = date("Y-m-d", strtotime($from));
        $newTo = date("Y-m-d", strtotime("$to +1 day"));


        $data['log'] = $this->history->get($newFrom, $newTo, $centre_id);

        $this->load->view('layout/header');
        $this->load->view('admin/accounts/accountLogs', $data);
        $this->load->view('layout/footer');
    }
    public function edit($id)
    {
        $entry = $this->history->getEntry($id);
        $data['entry'] = $entry;

        $data['ledgers'] = $this->journal->get();
        $data['filtered'] = $this->journal->getFiltered();




        $data['title'] = 'Add Issue item';
        $data['title_list'] = 'Recent Issue items';
        $roles = $this->role_model->get();
        $data['roles'] = $roles;

        $this->load->view('layout/header');
        $this->load->view('admin/accounts/editaccountLogs', $data);
        $this->load->view('layout/footer');
    }

    public function modifiedentry($id)
    {

        $this->form_validation->set_rules('by[]', 'This', 'trim|required');
        $this->form_validation->set_rules('byamount[]', 'Amount', 'trim|required');
        $this->form_validation->set_rules('to[]', 'This', 'trim|required');
        $this->form_validation->set_rules('toamount[]', 'Amount', 'trim|required');
        $this->form_validation->set_rules('narration', 'Narration', 'trim|required');
        $data['ledgers'] = $this->journal->get();


        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/accounts/editaccountLogs', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $previous_entry = $this->history->getEntry($id);
            $admin = $this->session->userdata('admin');
            $centre_id = $admin['centre_id'];
            $financial_year = $admin['financial_year'];


            $by = json_encode($this->input->post('by'));
            $byAmount = json_encode($this->input->post('byamount'));
            $to = json_encode($this->input->post('to'));
            $toAmount = json_encode($this->input->post('toamount'));

            $entry = array(
                'debit' => $by,
                'debit_amount' => $byAmount,
                'credit_amount' => $toAmount,
                'credit' => $to,
                'narration' => $this->input->post('narration') . "(Modified)",
                'centre_id' => $centre_id,
                'financial_year' => $financial_year
            );



            $previous_byarray = json_decode($previous_entry->debit);
            $previous_byamountarray = json_decode($previous_entry->debit_amount);
            foreach ($previous_byarray as $key => $value) {
                $this->db->set('debit', 'debit - ' . $previous_byamountarray[$key], FALSE);
                $this->db->where('id', $value)->where('centre_id', $centre_id)->update('ledgers');
            }
            $previous_toarray = json_decode($previous_entry->credit);
            $previous_toamountarray = json_decode($previous_entry->credit_amount);
            foreach ($previous_toarray as $key => $value) {
                $this->db->set('credit', 'credit - ' . $previous_toamountarray[$key], FALSE);
                $this->db->where('id', $value)->where('centre_id', $centre_id)->update('ledgers');
            }





            $byarray = $this->input->post('by');
            $byamountarray = $this->input->post('byamount');
            foreach ($byarray as $key => $value) {
                $this->db->set('debit', 'debit + ' . $byamountarray[$key], FALSE);
                $this->db->where('id', $value)->where('centre_id', $centre_id)->update('ledgers');
            }
            $toarray = $this->input->post('to');
            $toamountarray = $this->input->post('toamount');
            foreach ($toarray as $key => $value) {
                $this->db->set('credit', 'credit + ' . $toamountarray[$key], FALSE);
                $this->db->where('id', $value)->where('centre_id', $centre_id)->update('ledgers');
            }


            $this->db->where('id', $id)->update('account_logs', ['is_changed' => 1]);


            // var_dump($data);exit;
            $this->journal->add($entry);
        }



    }

    public function delete($id)
    {
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $financial_year = $admin['financial_year'];
        $previous_entry = $this->history->getEntry($id);
        $previous_byarray = json_decode($previous_entry->debit);
        $previous_byamountarray = json_decode($previous_entry->debit_amount);
        foreach ($previous_byarray as $key => $value) {
            $this->db->set('debit', 'debit - ' . $previous_byamountarray[$key], FALSE);
            $this->db->where('id', $value)->where('centre_id', $centre_id)->update('ledgers');
        }
        $previous_toarray = json_decode($previous_entry->credit);
        $previous_toamountarray = json_decode($previous_entry->credit_amount);
        foreach ($previous_toarray as $key => $value) {
            $this->db->set('credit', 'credit - ' . $previous_toamountarray[$key], FALSE);
            $this->db->where('id', $value)->where('centre_id', $centre_id)->update('ledgers');
        }

        $entry = array(
            'debit' => $previous_entry->debit,
            'debit_amount' => $previous_entry->debit_amount,
            'credit_amount' => $previous_entry->credit_amount,
            'credit' => $previous_entry->credit,
            'narration' => "Entry has been deleted(Deleted)",
            'centre_id' => $centre_id,
            'financial_year' => $financial_year
        );
        $this->db->where('id', $id)->update('account_logs', ['is_changed' => 1]);
        $this->journal->add($entry);



    }
}
