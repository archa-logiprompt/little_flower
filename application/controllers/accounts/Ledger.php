<?php
class Ledger extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('accounts/Ledger_Model', 'ledger');
    }

    public function index()
    {
        //
        if (!$this->rbac->hasPrivilege('ledger', 'can_view')) {
            access_denied();
        }
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/ledger');
        $data['ledgers'] = $this->ledger->get($centre_id);
        $data['type'] = $this->ledger->getType();

        $this->load->view('layout/header', $data);
        $this->load->view('admin/accounts/ledger', $data);
        $this->load->view('layout/footer', $data);
    }
    public function insert($id = 0)
    {
        if (!$this->rbac->hasPrivilege('ledger', 'can_add')) {
            access_denied();
        }
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];

        $data['ledgers'] = $this->ledger->get($centre_id);
        $data['type'] = $this->ledger->getType();




        $this->form_validation->set_rules('name', 'Ledger Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/accounts/ledger', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $admin = $this->session->userdata('admin');
            $centre_id = $admin['centre_id'];
            if ($id == 0) {
                $data = array(

                    'ledger' => $this->input->post('name'),
                    'type' => $this->input->post('type'),
                    'centre_id' => $centre_id,
                    'debit' => $this->input->post('debit'),
                    'credit' => $this->input->post('credit'),
                );
                // var_dump($data);exit;

            } else {
                $data = array(
                    'id' => $id,
                    'ledger' => $this->input->post('name'),
                    'type' => $this->input->post('type'),
                    'debit' => $this->input->post('debit'),
                    'credit' => $this->input->post('credit'),
                );
            }

            $this->ledger->add($data);
            $insert_id = $this->db->insert_id();
            if ($insert_id) {

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Ledger added successfully</div>');
            }
            else{
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Ledger already exists</div>');

            }
            redirect('accounts/ledger');
        }
    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('ledger', 'can_edit')) {
            access_denied();
        }
        $this->form_validation->set_rules('name', 'Subject', 'trim|required|xss_clean');
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $data['ledgers'] = $this->ledger->get($centre_id);
        $data['type'] = $this->ledger->getType();
        $data['item'] = $this->ledger->getById($id);
        // var_dump($data['item']);
        // exit;
        $data['id'] = $id;
        // var_dump($data['item']);
        // exit();

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/accounts/ledgerEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'ledger' => $this->input->post('name'),
                'type' => $this->input->post('type'),

            );
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Ledger updated successfully</div>');
            redirect('admin/subject/index');
        }
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('ledger', 'can_add')) {
            access_denied();
        }
        $this->ledger->delete($id);
        redirect('accounts/ledger');
    }

    public function view($id)
    {
        $data['ledger'] = $this->ledger->viewLedger($id);
        $data['ledgerName'] = $this->ledger->ledgerName($id->ledger);
        // var_dump($data);exit;
        $data['id'] = $id;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/accounts/ledgerView', $data);
        $this->load->view('layout/footer', $data);
    }
}


?>