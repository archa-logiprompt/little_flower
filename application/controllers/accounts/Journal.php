<?php

/**
 * 
 */
class Journal extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('accounts/Journal_Model', 'journal');
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('journal', 'can_view')) {
            access_denied();
        }

        $data['ledgers'] = $this->journal->get();
        $data['filtered'] = $this->journal->getFiltered();

        $item_result = $this->itemstock_model->get();
        $data['itemlist'] = $item_result;
        $itemcategory = $this->itemcategory_model->get();
        $data['itemcatlist'] = $itemcategory;
        $itemsupplier = $this->itemsupplier_model->get();
        $data['itemsupplier'] = $itemsupplier;
        $itemstore = $this->itemstore_model->get();
        $data['itemstore'] = $itemstore;

        $data['title'] = 'Add Issue item';
        $data['title_list'] = 'Recent Issue items';
        $roles = $this->role_model->get();
        $data['roles'] = $roles;


        $this->session->set_userdata('top_menu', 'accounts');
        $this->session->set_userdata('sub_menu', 'admin/journal');
        $this->load->view('layout/header', $data);
        $this->load->view('admin/accounts/journal', $data);
        $this->load->view('layout/footer', $data);
    }

    public function insert($id = 0)
    {
        $item_result = $this->itemstock_model->get();
        $data['itemlist'] = $item_result;
        $itemcategory = $this->itemcategory_model->get();
        $data['itemcatlist'] = $itemcategory;
        $itemsupplier = $this->itemsupplier_model->get();
        $data['itemsupplier'] = $itemsupplier;
        $itemstore = $this->itemstore_model->get();
        $data['itemstore'] = $itemstore;

        $data['title'] = 'Add Issue item';
        $data['title_list'] = 'Recent Issue items';
        $roles = $this->role_model->get();
        $data['roles'] = $roles;


        if (!$this->rbac->hasPrivilege('journal', 'can_add')) {
            access_denied();
        }
        $data['ledgers'] = $this->journal->get();
        $data['filtered'] = $this->journal->getFiltered();
        $radio = $this->input->post('radio-btn');
        // var_dump($this->input->post());exit;

        $this->form_validation->set_rules('by[]', 'This', 'trim|required');
        $this->form_validation->set_rules('byamount[]', 'Amount', 'trim|required');
        $this->form_validation->set_rules('to[]', 'This', 'trim|required');
        $this->form_validation->set_rules('toamount[]', 'Amount', 'trim|required');


        // if ($radio == "Journal") {
        //     $this->form_validation->set_rules('by[]', 'This', 'trim|required');
        //     $this->form_validation->set_rules('byamount[]', 'Amount', 'trim|required');
        //     $this->form_validation->set_rules('to[]', 'This', 'trim|required');
        //     $this->form_validation->set_rules('toamount[]', 'Amount', 'trim|required');
        // } else if ($radio == "Purchase") {
        //     $this->form_validation->set_rules('by[]', 'This', 'trim|required');
        //     $this->form_validation->set_rules('byamount[]', 'Amount', 'trim|required');
        //     $this->form_validation->set_rules('toFiltered[]', 'This', 'trim|required');
        //     $this->form_validation->set_rules('toamount[]', 'Amount', 'trim|required');
        //     $this->form_validation->set_rules('item_id', 'Item', 'trim|required|xss_clean');
        //     $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|xss_clean');
        //     $this->form_validation->set_rules('item_category_id', 'Item Category', 'trim|required|xss_clean');
        // } else if ($radio == "Sales") {
        //     $this->form_validation->set_rules('byFiltered[]', 'This', 'trim|required');
        //     $this->form_validation->set_rules('byamount[]', 'Amount', 'trim|required');
        //     $this->form_validation->set_rules('to[]', 'This', 'trim|required');
        //     $this->form_validation->set_rules('toamount[]', 'Amount', 'trim|required');
        //     $this->form_validation->set_rules('account_type', 'Account Type', 'required|trim|xss_clean');
        //     $this->form_validation->set_rules('issue_to', 'Issue To', 'required|trim|xss_clean');
        //     $this->form_validation->set_rules('issue_by', 'Issue By', 'required|trim|xss_clean');
        //     $this->form_validation->set_rules('issue_date', 'Issue Date', 'required|trim|xss_clean');
        //     // $this->form_validation->set_rules('note', 'Note', 'required|trim|xss_clean');
        //     $this->form_validation->set_rules('quantity_issue', 'Quantity', 'required|trim|xss_clean');
        //     $this->form_validation->set_rules('item_category_id_issue', 'Item Category', 'required|trim|xss_clean');
        //     $this->form_validation->set_rules('item_id_issue', 'Item', 'required|trim|xss_clean');
        // }


        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/accounts/journal', $data);
            $this->load->view('layout/footer', $data);
        } else {
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
                'date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'narration' => $this->input->post('narration'),
                'centre_id' => $centre_id,
                'financial_year' => $financial_year
            );
            
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
            // var_dump($data);exit;
            $this->journal->add($entry);


            // if ($radio == "Journal") {

            //     $by = json_encode($this->input->post('by'));
            //     $byAmount = json_encode($this->input->post('byamount'));
            //     $to = json_encode($this->input->post('to'));
            //     $toAmount = json_encode($this->input->post('toamount'));

            //     $entry = array(
            //         'debit' => $by,
            //         'debit_amount' => $byAmount,
            //         'credit_amount' => $toAmount,
            //         'credit' => $to,
            //         'narration' => $this->input->post('narration'),
            //         'centre_id' => $centre_id,
            //         'financial_year' => $financial_year
            //     );
            //     // var_dump( $data);exit;
            //     $byarray = $this->input->post('by');
            //     $byamountarray = $this->input->post('byamount');
            //     foreach ($byarray as $key => $value) {
            //         $this->db->set('debit', 'debit + ' . $byamountarray[$key], FALSE);
            //         $this->db->where('id', $value)->where('centre_id', $centre_id)->update('ledgers');
            //     }
            //     $toarray = $this->input->post('to');
            //     $toamountarray = $this->input->post('toamount');
            //     foreach ($toarray as $key => $value) {
            //         $this->db->set('credit', 'credit + ' . $toamountarray[$key], FALSE);
            //         $this->db->where('id', $value)->where('centre_id', $centre_id)->update('ledgers');
            //     }
            //     // var_dump($data);exit;
            //     $this->journal->add($entry);
            // } else if ($radio == "Purchase") {
            //     $by = json_encode($this->input->post('by'));
            //     $byAmount = json_encode($this->input->post('byamount'));
            //     $to = json_encode($this->input->post('toFiltered'));
            //     $toAmount = json_encode($this->input->post('toamount'));

            //     $entry = array(
            //         'debit' => $by,
            //         'debit_amount' => $byAmount,
            //         'credit_amount' => $toAmount,
            //         'credit' => $to,
            //         'narration' => $this->input->post('narration'),
            //         'centre_id' => $centre_id,
            //         'financial_year' => $financial_year
            //     );
            //     $stock = array(
            //         'centre_id' => $admin['centre_id'],
            //         'item_id' => $this->input->post('item_id'),
            //         'symbol' => $this->input->post('symbol'),
            //         'supplier_id' => $this->input->post('supplier_id'),
            //         'store_id' => $store_id,
            //         'quantity' => $this->input->post('symbol') . $this->input->post('quantity'),
            //         'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
            //         'description' => $this->input->post('description'),
            //     );
            //     // var_dump($stock);exit;
            //     $insert_id = $this->itemstock_model->add($stock);
            //     if (isset($_FILES["item_photo"]) && !empty($_FILES['item_photo']['name'])) {
            //         $fileInfo = pathinfo($_FILES["item_photo"]["name"]);
            //         $img_name = $insert_id . '.' . $fileInfo['extension'];
            //         move_uploaded_file($_FILES["item_photo"]["tmp_name"], "./uploads/inventory_items/" . $img_name);
            //         $data_img = array('id' => $insert_id, 'attachment' => 'uploads/inventory_items/' . $img_name);
            //         $this->itemstock_model->add($data_img);
            //     }
            //     // var_dump($data);exit;
            //     $this->journal->add($entry);
            //     $byarray = $this->input->post('by');
            //     $byamountarray = $this->input->post('byamount');
            //     foreach ($byarray as $key => $value) {
            //         $this->db->set('debit', 'debit + ' . $byamountarray[$key], FALSE);
            //         $this->db->where('id', $value)->where('centre_id', $centre_id)->update('ledgers');
            //     }
            //     $toarray = $this->input->post('toFiltered');
            //     $toamountarray = $this->input->post('toamount');
            //     foreach ($toarray as $key => $value) {
            //         $this->db->set('credit', 'credit + ' . $toamountarray[$key], FALSE);
            //         $this->db->where('id', $value)->where('centre_id', $centre_id)->update('ledgers');
            //     }
            //     // var_dump($data);exit;

            // } else if ($radio == "Sales") {

            //     $by = json_encode($this->input->post('byFiltered'));
            //     $byAmount = json_encode($this->input->post('byamount'));
            //     $to = json_encode($this->input->post('to'));
            //     $toAmount = json_encode($this->input->post('toamount'));

            //     $entry = array(
            //         'debit' => $by,
            //         'debit_amount' => $byAmount,
            //         'credit_amount' => $toAmount,
            //         'credit' => $to,
            //         'narration' => $this->input->post('narration'),
            //         'centre_id' => $centre_id,
            //         'financial_year' => $financial_year
            //     );
            //     $this->journal->add($entry);

            //     $return_date = "";
            //     if (($this->input->post('return_date')) != "") {

            //         $return_date = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('return_date')));
            //     }

            //     $admin = $this->session->userdata('admin');
            //     $issue = array(
            //         'centre_id' => $admin['centre_id'],
            //         'issue_to' => $this->input->post('issue_to'),
            //         'issue_by' => $this->input->post('issue_by'),
            //         'issue_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('issue_date'))),
            //         'return_date' => $return_date,
            //         'note' => $this->input->post('note'),
            //         'quantity' => $this->input->post('quantity_issue'),
            //         'issue_type' => $this->input->post('account_type'),
            //         'item_category_id' => $this->input->post('item_category_id_issue'),
            //         'item_id' => $this->input->post('item_id_issue'),
            //         'financial_year' => $financial_year
            //     );
            //     $this->itemissue_model->add($issue);

            //     $byarray = $this->input->post('byFiltered');

            //     $byamountarray = $this->input->post('byamount');
            //     foreach ($byarray as $key => $value) {
            //         $this->db->set('debit', 'debit + ' . $byamountarray[$key], FALSE);
            //         $this->db->where('id', $value)->where('centre_id', $centre_id)->update('ledgers');
            //     }
            //     $toarray = $this->input->post('to');
            //     $toamountarray = $this->input->post('toamount');
            //     foreach ($toarray as $key => $value) {
            //         $this->db->set('credit', 'credit + ' . $toamountarray[$key], FALSE);
            //         $this->db->where('id', $value)->where('centre_id', $centre_id)->update('ledgers');
            //     }
            //     // var_dump($data);exit;
            // }


            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Journal Entry has been Added</div>');
            redirect('accounts/journal');
        }
    }
}
