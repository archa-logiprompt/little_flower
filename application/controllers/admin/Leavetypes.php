<?php

/**
 * 
 */
class LeaveTypes extends Admin_Controller {

    function __construct() {

        parent::__construct();

        $this->load->helper('file');
        $this->config->load("payroll");

        $this->load->model('leavetypes_model');
        $this->load->model('staff_model');
    }

    function index() {

        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/leavetypes');
        $data["title"] = "Add Leave Type";

        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        // var_dump(        $centre_id);exit;
        $LeaveTypes = $this->leavetypes_model->getLeaveType( $centre_id);
        $data["leavetype"] = $LeaveTypes;
        $this->load->view("layout/header");
        $this->load->view("admin/staff/leavetypes", $data);
        $this->load->view("layout/footer");
    }

    function createLeaveType() {


        // $this->form_validation->set_rules(
        //         'type', 'Leave Type', array('required',
        //     array('check_exists', array($this->leavetypes_model, 'valid_leave_type'))
        //         )
        // );
        $this->form_validation->set_rules('type', 'Leave Type', 'required');

        // $data["title"] = "Add Leave Type";
        if ($this->form_validation->run()) {

            $type = $this->input->post("type");
            $leavetypeid = $this->input->post("leavetypeid");
            $status = $this->input->post("status");
            if (empty($leavetypeid)) {

                if (!$this->rbac->hasPrivilege('leave_types', 'can_add')) {
                    access_denied();
                }
            } else {

                if (!$this->rbac->hasPrivilege('leave_types', 'can_edit')) {
                    access_denied();
                }
            }

            if (!empty($leavetypeid)) {
                $data = array('type' => $type, 'is_active' => 'yes', 'id' => $leavetypeid);
            } else {

                $data = array('type' => $type, 'is_active' => 'yes');
            }
            $admin = $this->session->userdata('admin');
            $centre_id = $admin['centre_id'];
            $data['centre_id']=$centre_id;
            $insert_id = $this->leavetypes_model->addLeaveType($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Record added Successfully</div>');
            redirect("admin/leavetypes");
        } else {

            $admin = $this->session->userdata('admin');
            $centre_id = $admin['centre_id'];
            $data['centre_id']=$centre_id;
            $LeaveTypes = $this->leavetypes_model->getLeaveType($centre_id);
            $data["leavetype"] = $LeaveTypes;
            $this->load->view("layout/header");
            $this->load->view("admin/staff/leavetypes", $data);
            $this->load->view("layout/footer");
        }
    }

    function leaveedit($id) {

        $result = $this->staff_model->getLeaveType($id);

        $data["title"] = "Edit Leave Type";
        $data["result"] = $result;

        $LeaveTypes = $this->leavetypes_model->getLeaveType();
        $data["leavetype"] = $LeaveTypes;
        $this->load->view("layout/header");
        $this->load->view("admin/staff/leavetypes", $data);
        $this->load->view("layout/footer");
    }

    function leavedelete($id) {

        $this->leavetypes_model->deleteLeaveType($id);
        redirect('admin/leavetypes');
    }

}

?>