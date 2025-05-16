<?php

/**
 * 
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Stock extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        // $this->load->model('accounts/Stock_Model', 'stock');
    }

    public function index()

    {

        if (!$this->rbac->hasPrivilege('stocks', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/stocks');
        // $data['log'] = $this->history->get();

        $this->load->view('layout/header');
        $this->load->view('admin/accounts/stocks');
        $this->load->view('layout/footer');
    }

    
}
