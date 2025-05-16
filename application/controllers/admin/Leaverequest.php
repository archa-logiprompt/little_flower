<?php

/**
 * 
 */
class Leaverequest extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->config->load("payroll");

        $this->load->model("staff_model");
        $this->load->model("leaverequest_model");
        $this->load->model("superviser_model");
        $this->contract_type = $this->config->item('contracttype');
        $this->marital_status = $this->config->item('marital_status');
        $this->staff_attendance = $this->config->item('staffattendance');
        $this->payroll_status = $this->config->item('payroll_status');
        $this->payment_mode = $this->config->item('payment_mode');
        $this->status = $this->config->item('status');
    }

    function leaverequest()
    {
        if (!$this->rbac->hasPrivilege('assigned_staff', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/leaverequest/leaverequest');
        
        $LeaveTypes = $this->staff_model->getLeaveType();
        // var_dump(  $LeaveTypes);exit;
        $userdata = $this->customlib->getUserData();
        $data['usertype'] = $userdata['user_type'];
        $user = $this->customlib->getUserData();
        $data['user']=$user;
        $leave_request= $this->db->select('staff_leave_request.*,staff.name,staff.surname,leave_types.type')->join('staff', 'staff.id=staff_leave_request.staff_id')->join('leave_types', 'leave_types.id=staff_leave_request.leave_type_id')->where('status',0)->where('assigned_staff',$data['user']['id'])->order_by('id', "desc")->get('staff_leave_request')->result_array();
        // $data['assigned_staff']=$this->db->select('assigned_staff')
       
        if($data['usertype']=='HOD')
        {
         
            $leave_request = $this->leaverequest_model->getStafLeaveAdmin();
            
        }
        elseif($data['usertype']=='PRINCIPAL')
        {
           
            $leave_request = $this->leaverequest_model->getStafLeaveforprincipal();

        }
        elseif($data['usertype']=='Director')
        {
           
            $leave_request = $this->leaverequest_model->getStafLeavefordirector();
            // var_dump($leave_request);exit;
        }
        

        $data["leave_request"] = $leave_request;
        $data["leavetype"] = $LeaveTypes;
        $staffRole = $this->staff_model->getStaffRole();
        $data["staffrole"] = $staffRole;
        $data["status"] = $this->status;

        $this->load->view("layout/header", $data);
        $this->load->view("admin/staff/staffleaverequest", $data);
        $this->load->view("layout/footer", $data);
    }
    function leaveStatuspr()
    {
        if ((!$this->rbac->hasPrivilege('approve_leave_requestpr', 'can_edit'))) {
            access_denied();
        }
        $leave_request_id = $this->input->post("leave_request_id");
        $status = $this->input->post("status");
        $adminRemark = $this->input->post("detailremark");
        $data = array('pstatus' => $status, 'principal_remark' => $adminRemark);
        $this->leaverequest_model->changeLeaveStatus($data, $leave_request_id);
        $array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
        echo json_encode($array);
    }
    function leaveStatusdr()
    {
        if ((!$this->rbac->hasPrivilege('approve_leave_requestdr', 'can_edit'))) {
            access_denied();
        }
        $leave_request_id = $this->input->post("leave_request_id");
        $status = $this->input->post("status");
        $adminRemark = $this->input->post("detailremark");
        $data = array('dstatus' => $status, 'director_remark' => $adminRemark);
        $this->leaverequest_model->changeLeaveStatus($data, $leave_request_id);
        $array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
        echo json_encode($array);
    }
    function leaverequesthod()
    {
        if (!$this->rbac->hasPrivilege('approve_leave_request_hod', 'can_view')) {
            access_denied();
        }
        $userdata = $this->customlib->getUserData();
        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/leaverequest/leaverequesthod');

        $leave_request = $this->leaverequest_model->staff_leave_requesthod($userdata['department']);

        $data["leave_request"] = $leave_request;

        $LeaveTypes = $this->staff_model->getLeaveType();


        $data["leavetype"] = $LeaveTypes;
        $staffRole = $this->staff_model->getStaffRole();
        $data["staffrole"] = $staffRole;
        $data["status"] = $this->status;

        $this->load->view("layout/header", $data);
        $this->load->view("admin/staff/staffleaverequesthod", $data);
        $this->load->view("layout/footer", $data);
    }
    function leaveStatushod()
    {
        if ((!$this->rbac->hasPrivilege('approve_leave_request_hod', 'can_edit'))) {
            access_denied();
        }
        $leave_request_id = $this->input->post("leave_request_id");
        $status = $this->input->post("status");
        $adminRemark = $this->input->post("detailremark");
        $data = array('hod' => $status, 'hod_remark' => $adminRemark);
        $this->leaverequest_model->changeLeaveStatushod($data, $leave_request_id);
        $array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
        echo json_encode($array);
    }
    function leaveStatussuperviser()
    {
        if ((!$this->rbac->hasPrivilege('superviser_approve', 'can_edit'))) {
            access_denied();
        }
        $leave_request_id = $this->input->post("leave_request_id");
        $status = $this->input->post("status");
        $adminRemark = $this->input->post("detailremark");
        $data = array('status' => $status, 'admin_remark' => $adminRemark);
        $this->leaverequest_model->changeLeaveStatussuperviser($data, $leave_request_id);
        $array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
        echo json_encode($array);
    }




    function countLeave($id)
    {
        $lid = $this->input->post("lid");
        $alloted_leavetype = $this->leaverequest_model->allotedLeaveType($id);

        $i = 0;
        $html = "<select value='' name='leave_type' id='leave_type' class='form-control'><option>Select</option>";
        $data = array();
        if (!empty ($alloted_leavetype[0]["alloted_leave"])) {
            foreach ($alloted_leavetype as $key => $value) {
                $count_leaves[] = $this->leaverequest_model->countLeavesData($id, $value["leave_type_id"]);
                $data[$i]['type'] = $value["type"];
                $data[$i]['id'] = $value["leave_type_id"];
                $data[$i]['alloted_leave'] = $value["alloted_leave"];
                $data[$i]['approve_leave'] = $count_leaves[$i]['approve_leave'];


                $i++;
            }

            foreach ($data as $dkey => $dvalue) {
                if (!empty ($dvalue["alloted_leave"])) {
                    if ($lid == $dvalue["id"]) {
                        $a = "selected";
                    } else {
                        $a = "";
                    }
                    //    $available  = $dvalue["alloted_leave"]-$dvalue["approve_leave"];
                    if ($dvalue["alloted_leave"] == "") {

                        $available = $dvalue["approve_leave"];
                    } else {
                        $available = $dvalue["alloted_leave"] - $dvalue["approve_leave"];
                    }
                    if ($available > 0) {

                        $html .= "<option value=" . $dvalue["id"] . " $a>" . $dvalue["type"] . " (" . $available . ")" . "</option>";
                    }
                }
            }
        }
        $html .= "</select>";
        echo $html;
    }

    function leaveStatus()
    {
        if ((!$this->rbac->hasPrivilege('approve_leave_request', 'can_edit'))) {
            access_denied();
        }
        $leave_request_id = $this->input->post("leave_request_id");
        $status = $this->input->post("status");
        $adminRemark = $this->input->post("detailremark");
        $data = array('status' => $status, 'admin_remark' => $adminRemark);
        $this->leaverequest_model->changeLeaveStatus($data, $leave_request_id);
        $array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
        echo json_encode($array);
    }

    function leaveRecord()
    {
        // if(!$this->rbac->hasPrivilege('leave_request','can_view')){
//         access_denied();
//         }
        $id = $this->input->post("id");

        $result = $this->staff_model->getLeaveRecord($id);
        $leave_from = date("m/d/Y", strtotime($result->leave_from));
        $result->leavefrom = $leave_from;
        $leave_to = date("m/d/Y", strtotime($result->leave_to));
        $result->leaveto = $leave_to;
        $result->days = $this->dateDifference($result->leave_from, $result->leave_to);
        echo json_encode($result);
    }

    function leaveRecordsuper()
    {
        // if(!$this->rbac->hasPrivilege('leave_request','can_view')){
//         access_denied();
//         }
        $id = $this->input->post("id");

        $result = $this->staff_model->getLeaveSuperRecord($id);
        $leave_from = date("m/d/Y", strtotime($result->leave_from));
        $result->leavefrom = $leave_from;
        $leave_to = date("m/d/Y", strtotime($result->leave_to));
        $result->leaveto = $leave_to;
        $result->days = $this->dateDifference($result->leave_from, $result->leave_to);
        echo json_encode($result);
    }

    function dateDifference($date_1, $date_2, $differenceFormat = '%a')
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($differenceFormat) + 1;
    }

    function addLeave()
    {

        // if(!$this->rbac->hasPrivilege('leave_request','can_add')){
//         access_denied();
//         }

        $role = $this->input->post("role");
        $empid = $this->input->post("empname");
        $applied_date = $this->input->post("applieddate");
        $leavetype = $this->input->post("leave_type");

        $reason = $this->input->post("reason");
        $remark = $this->input->post("remark");
        $status = $this->input->post("addstatus");
        $request_id = $this->input->post("leaverequestid");
        $leave_method = $this->input->post("method");
        $this->form_validation->set_rules('role', 'Role', 'trim|required|xss_clean');
        $this->form_validation->set_rules('empname', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('applieddate', 'Applied Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('leavedates', 'Leave from Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('method', 'Leave method', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {

            $msg = array(
                'role' => form_error('role'),
                'empname' => form_error('empname'),
                'applieddate' => form_error('applieddate'),
                'leavedates' => form_error('leavedates'),

            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {

            $a = $this->input->post("leavedates");
            $b = explode('-', trim($a));

            $leavefrom = date("Y-m-d", strtotime($b[0]));
            $leaveto = date("Y-m-d", strtotime($b[1]));

            $staff_id = $empid;
            if (isset ($_FILES["userfile"]) && !empty ($_FILES['userfile']['name'])) {
                $uploaddir = './uploads/staff_documents/' . $staff_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die ("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["userfile"]["name"]);
                $document = basename($_FILES['userfile']['name']);
                $img_name = $uploaddir . basename($_FILES['userfile']['name']);
                move_uploaded_file($_FILES["userfile"]["tmp_name"], $img_name);
            } else {

                $document = $this->input->post("filename");
            }

            $applied_by = $this->customlib->getAdminSessionUserName();
            $leave_days = $this->dateDifference($leavefrom, $leaveto);
            if (!empty ($request_id)) {


                $data = array(
                    'id' => $request_id,
                    'staff_id' => $staff_id,
                    'date' => date('Y-m-d', $this->customlib->datetostrtotime($applied_date)),
                    'leave_type_id' => $leavetype,
                    'leave_days' => $leave_days,
                    'leave_from' => $leavefrom,
                    'leave_method' => $leave_method,
                    'leave_to' => $leaveto,
                    'employee_remark' => $reason,
                    'status' => $status,
                    'admin_remark' => $remark,
                    'applied_by' => $applied_by,
                    'document_file' => $document
                );
            } else {

                $data = array('staff_id' => $staff_id, 'date' => date("Y-m-d", strtotime($applied_date)), 'leave_days' => $leave_days, 'leave_type_id' => $leavetype, 'leave_from' => $leavefrom, 'leave_method' => $leave_method, 'leave_to' => $leaveto, 'employee_remark' => $reason, 'status' => $status, 'admin_remark' => $remark, 'applied_by' => $applied_by, 'document_file' => $document);
            }


            $this->leaverequest_model->addLeaveRequest($data);
            $array = array('status' => 'success', 'error' => '', 'message' => "Record Saved Successfully");
        }

        echo json_encode($array);
    }

    // public function add_staff_leave() {


    //     $userdata = $this->customlib->getUserData();
    //     $applied_date = $this->input->post("applieddate");
    //     $leavetype = $this->input->post("leave_type");
    //     $leave_method = $this->input->post("method");
    //     $reason = $this->input->post("reason");
    //     $remark = '';
    //     $status = 'pending';
    //     $request_id = $this->input->post("leaverequestid");


    //     $this->form_validation->set_rules('applieddate', 'Applied Date', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('leavedates', 'Leave from Date', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('leave_type', 'Leave Type', 'trim|required|xss_clean');

    //     if ($this->form_validation->run() == FALSE) {


    //         $msg = array(
    //             'applieddate' => form_error('applieddate'),
    //             'leavedates' => form_error('leavedates'),
    //             'leave_type' => form_error('leave_type'),
    //         );

    //         $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    //     } else {
    //         $a = $this->input->post("leavedates");
    //         $b = explode('-', trim($a));

    //         $leavefrom = date("Y-m-d", strtotime($b[0]));
    //         $leaveto = date("Y-m-d", strtotime($b[1]));

    //         $staff_id = $userdata["id"];
    //         if (isset($_FILES["userfile"]) && !empty($_FILES['userfile']['name'])) {
    //             $uploaddir = './uploads/staff_documents/' . $staff_id . '/';
    //             if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
    //                 die("Error creating folder $uploaddir");
    //             }
    //             $fileInfo = pathinfo($_FILES["userfile"]["name"]);
    //             $document = basename($_FILES['userfile']['name']);
    //             $img_name = $uploaddir . basename($_FILES['userfile']['name']);
    //             move_uploaded_file($_FILES["userfile"]["tmp_name"], $img_name);
    //         } else {

    //             $document = $this->input->post("filename");
    //         }

    //         $applied_by = $this->customlib->getAdminSessionUserName();
    //         $leave_days = $this->dateDifference($leavefrom, $leaveto);
    //         if (!empty($request_id)) {


    //             $data = array('id' => $request_id,
    //                 'staff_id' => $staff_id,
    //                 'date' => date('Y-m-d', $this->customlib->datetostrtotime($applied_date)),
    //                 'leave_type_id' => $leavetype,
    //                 'leave_days' => $leave_days,
    // 				'leave_method' => $leave_method,
    //                 'leave_from' => $leavefrom,
    //                 'leave_to' => $leaveto, 'employee_remark' => $reason, 'status' => $status, 'admin_remark' => $remark, 'applied_by' => $applied_by, 'document_file' => $document);
    //         } else {

    //             $data = array('staff_id' => $staff_id, 'date' => date("Y-m-d", strtotime($applied_date)), 'leave_days' => $leave_days, 'leave_type_id' => $leavetype, 'leave_from' => $leavefrom, 'leave_to' => $leaveto, 'employee_remark' => $reason, 'status' => $status, 'admin_remark' => $remark, 'applied_by' => $applied_by, 'leave_method' => $leave_method,'document_file' => $document);
    //         }


    //         $this->leaverequest_model->addLeaveRequest($data);

    //         $array = array('status' => 'success', 'error' => '', 'message' => "Record Saved Successfully");
    //     }
    //     echo json_encode($array);
    // }
    function addSleave()
    {

        if (!$this->rbac->hasPrivilege('superviser_leave', 'can_add')) {
            access_denied();
        }

        $role = $this->input->post("role");
        $empid = $this->input->post("empname");
        $applied_date = $this->input->post("applieddate");
        $leavetype = $this->input->post("leave_type");

        $reason = $this->input->post("reason");
        $remark = $this->input->post("remark");
        $status = $this->input->post("addstatus");
        $request_id = $this->input->post("leaverequestid");
        $leave_method = $this->input->post("method");
        $this->form_validation->set_rules('role', 'Role', 'trim|required|xss_clean');
        $this->form_validation->set_rules('empname', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('applieddate', 'Applied Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('leavedates', 'Leave from Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('method', 'Leave method', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {

            $msg = array(
                'role' => form_error('role'),
                'empname' => form_error('empname'),
                'applieddate' => form_error('applieddate'),
                'leavedates' => form_error('leavedates'),

            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {

            $a = $this->input->post("leavedates");
            $b = explode('-', trim($a));

            $leavefrom = date("Y-m-d", strtotime($b[0]));
            $leaveto = date("Y-m-d", strtotime($b[1]));

            $staff_id = $empid;
            if (isset ($_FILES["userfile"]) && !empty ($_FILES['userfile']['name'])) {
                $uploaddir = './uploads/staff_documents/' . $staff_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die ("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["userfile"]["name"]);
                $document = basename($_FILES['userfile']['name']);
                $img_name = $uploaddir . basename($_FILES['userfile']['name']);
                move_uploaded_file($_FILES["userfile"]["tmp_name"], $img_name);
            } else {

                $document = $this->input->post("filename");
            }

            $applied_by = $this->customlib->getAdminSessionUserName();
            $leave_days = $this->dateDifference($leavefrom, $leaveto);
            if (!empty ($request_id)) {


                $data = array(
                    'id' => $request_id,
                    'staff_id' => $staff_id,
                    'date' => date('Y-m-d', $this->customlib->datetostrtotime($applied_date)),
                    'leave_type_id' => $leavetype,
                    'leave_days' => $leave_days,
                    'leave_from' => $leavefrom,
                    'leave_method' => $leave_method,
                    'leave_to' => $leaveto,
                    'employee_remark' => $reason,
                    'status' => $status,
                    'admin_remark' => $remark,
                    'applied_by' => $applied_by,
                    'document_file' => $document
                );
            } else {

                $data = array('staff_id' => $staff_id, 'date' => date("Y-m-d", strtotime($applied_date)), 'leave_days' => $leave_days, 'leave_type_id' => $leavetype, 'leave_from' => $leavefrom, 'leave_method' => $leave_method, 'leave_to' => $leaveto, 'employee_remark' => $reason, 'status' => $status, 'admin_remark' => $remark, 'applied_by' => $applied_by, 'document_file' => $document);
            }


            $this->superviser_model->addSuperviserLeaveRequest($data);
            $array = array('status' => 'success', 'error' => '', 'message' => "Record Saved Successfully");
        }

        echo json_encode($array);
    }
    public function add_superviser_leave()
    {


        $userdata = $this->customlib->getUserData();
        $applied_date = $this->input->post("applieddate");
        $leavetype = $this->input->post("leave_type");
        $leave_method = $this->input->post("method");
        $reason = $this->input->post("reason");
        $remark = '';
        $status = 'pending';
        $request_id = $this->input->post("leaverequestid");


        $this->form_validation->set_rules('applieddate', 'Applied Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('leavedates', 'Leave from Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('leave_type', 'Leave Type', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {


            $msg = array(
                'applieddate' => form_error('applieddate'),
                'leavedates' => form_error('leavedates'),
                'leave_type' => form_error('leave_type'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $a = $this->input->post("leavedates");
            $b = explode('-', trim($a));

            $leavefrom = date("Y-m-d", strtotime($b[0]));
            $leaveto = date("Y-m-d", strtotime($b[1]));

            $staff_id = $userdata["id"];
            if (isset ($_FILES["userfile"]) && !empty ($_FILES['userfile']['name'])) {
                $uploaddir = './uploads/staff_documents/' . $staff_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die ("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["userfile"]["name"]);
                $document = basename($_FILES['userfile']['name']);
                $img_name = $uploaddir . basename($_FILES['userfile']['name']);
                move_uploaded_file($_FILES["userfile"]["tmp_name"], $img_name);
            } else {

                $document = $this->input->post("filename");
            }

            $applied_by = $this->customlib->getAdminSessionUserName();
            $leave_days = $this->dateDifference($leavefrom, $leaveto);
            if (!empty ($request_id)) {


                $data = array(
                    'id' => $request_id,
                    'staff_id' => $staff_id,
                    'date' => date('Y-m-d', $this->customlib->datetostrtotime($applied_date)),
                    'leave_type_id' => $leavetype,
                    'leave_days' => $leave_days,
                    'leave_method' => $leave_method,
                    'leave_from' => $leavefrom,
                    'leave_to' => $leaveto,
                    'employee_remark' => $reason,
                    'status' => $status,
                    'admin_remark' => $remark,
                    'applied_by' => $applied_by,
                    'document_file' => $document
                );
            } else {

                $data = array(
                    'staff_id' => $staff_id,
                    'date' => date("Y-m-d", strtotime($applied_date)),
                    'leave_days' => $leave_days,
                    'leave_type_id' => $leavetype,
                    'leave_from' => $leavefrom,
                    'leave_to' => $leaveto,
                    'employee_remark' => $reason,
                    'status' => $status,
                    'admin_remark' => $remark,
                    'applied_by' => $applied_by,
                    'leave_method' => $leave_method,
                    'document_file' => $document
                );
            }

            //  echo  $data;
            $this->superviser_model->addSuperviserLeaveRequest($data);

            $array = array('status' => $data, 'error' => '', 'message' => "Record Saved Successfully");
        }
        echo json_encode($array);
    }





    public function test()
    {

        $data = array
        (
            "staff_id" => 5,
            "date" => '2018-06-25',
            "leave_days" => 1,
            "leave_type_id" => 5,
            "leave_from" => '2018-06-25',
            "leave_to" => '2018-06-25',
            "employee_remark" => 'safsdf',
            "status" => 'pending',
            "admin_remark" => '',
            "applied_by" => 'admin',
            "document_file" => '',
        );

        $this->db->insert("staff_leave_request", $data);
    }
    function superleaverequest()
    {
        if (!$this->rbac->hasPrivilege('superviser_leave', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/leaverequest/leaverequest');
        $leave_request = $this->leaverequest_model->superviser_leave_request();

        $data["leave_request"] = $leave_request;

        $LeaveTypes = $this->staff_model->getLeaveType();
        $userdata = $this->customlib->getUserData();

        $data["leavetype"] = $LeaveTypes;
        $staffRole = $this->staff_model->getStaffRole();
        $data["staffrole"] = $staffRole;
        $data["status"] = $this->status;

        $this->load->view("layout/header", $data);
        $this->load->view("admin/staff/superviserrequest", $data);
        $this->load->view("layout/footer", $data);
    }
    function leaveapprovesuper()
    {
        if (!$this->rbac->hasPrivilege('superviser_approve', 'can_view')) {
            access_denied();
        }
        $userdata = $this->customlib->getUserData();
        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/leaverequest/leaveapprovesuper');

        $leave_request = $this->leaverequest_model->staff_leave_super($userdata['department']);

        $data["leave_request"] = $leave_request;

        $LeaveTypes = $this->staff_model->getLeaveType();


        $data["leavetype"] = $LeaveTypes;
        $staffRole = $this->staff_model->getStaffRole();
        $data["staffrole"] = $staffRole;
        $data["status"] = $this->status;

        $this->load->view("layout/header", $data);
        $this->load->view("admin/staff/superviserapprove", $data);
        $this->load->view("layout/footer", $data);
    }


    function leaverequestcc()
    {
        if (!$this->rbac->hasPrivilege('approve_leave_by_class_coordinator', 'can_view')) {
            access_denied();
        }
        $userdata = $this->customlib->getUserData();
        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/leaverequest/leaverequestcc');

        $leave_request = $this->leaverequest_model->getStafLeaveCC(0);

        $data["leave_request"] = $leave_request;

        $LeaveTypes = $this->staff_model->getLeaveType();


        $data["leavetype"] = $LeaveTypes;
        $staffRole = $this->staff_model->getStaffRole();
        $data["staffrole"] = $staffRole;
        $data["status"] = $this->status;

        $this->load->view("layout/header", $data);
        $this->load->view("admin/staff/leaverequestcc", $data);
        $this->load->view("layout/footer", $data);
    }


    public function leaverequestugpg()
    {
        if (!$this->rbac->hasPrivilege('approve_leave_request_ug/pg', 'can_view')) {
            access_denied();
        }
        $userdata = $this->customlib->getUserData();
        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/leaverequest/leaverequestugpg');

        $leave_request = $this->leaverequest_model->getStafLeaveugpg();

        $data["leave_request"] = $leave_request;

        $LeaveTypes = $this->staff_model->getLeaveType();


        $data["leavetype"] = $LeaveTypes;
        $staffRole = $this->staff_model->getStaffRole();
        $data["staffrole"] = $staffRole;
        $data["status"] = $this->status;

        $this->load->view("layout/header", $data);
        $this->load->view("admin/staff/leaverequestupgp", $data);
        $this->load->view("layout/footer", $data);
    }
    public function leaverequestprincipal()
    {
        if (!$this->rbac->hasPrivilege('approve_leave_requestpr', 'can_view')) {
            access_denied();
        }
        $userdata = $this->customlib->getUserData();
        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/leaverequest/leaverequestprincipal');

        $leave_request = $this->leaverequest_model->getStafLeaveprincipal();

        $data["leave_request"] = $leave_request;

        $LeaveTypes = $this->staff_model->getLeaveType();


        $data["leavetype"] = $LeaveTypes;
        $staffRole = $this->staff_model->getStaffRole();
        $data["staffrole"] = $staffRole;
        $data["status"] = $this->status;

        $this->load->view("layout/header", $data);
        $this->load->view("admin/staff/leaverequestprincipal", $data);
        $this->load->view("layout/footer", $data);
    }

    public function updateleaverequest($path,$id, $status)
    {
        $data = array(
            'id' => $id,
            'status' => $status,

        );
        $this->staff_model->getLeaveStatus($data);

        redirect('admin/leaverequest/' . $path);

    }

    public function add_staff_leave()
    {
        $userdata = $this->customlib->getUserData();
        $staff_id = $userdata["id"];

        $userType = explode(',', $this->db->select('role_id')->where('staff_id', $staff_id)->get('staff_roles')->row()->role_id);
// var_dump($userType);exit;


        if (in_array("2", $userType) && in_array("14", $userType)) {
            $status = '2';
        } 
        else if (in_array("2", $userType)) 
        {
            if ($this->rbac->hasPrivilege('approve_leave_by_class_coordinator', 'can_view')) {
                $status = '0';
            } else if ($this->rbac->hasPrivilege('approve_leave_request_ug/pg', 'can_view')) {
                $status = '3';
            } else if ($this->rbac->hasPrivilege('approve_leave_request_hod', 'can_view')) {
                $status = '1';
            } else if ($this->rbac->hasPrivilege('approve_leave_by_class_coordinator', 'can_view')) {
                $status = '1';
            } else {
                $status = '0';
            }
        } else {
            $status = "4";
        }




        $applied_date = $this->input->post("applieddate");
        $leavetype = $this->input->post("leave_type");
        $leave_method = $this->input->post("method");
        $reason = $this->input->post("reason");
        $assigned_staff = $this->input->post("assigned_staff");

        $remark = '';

        // print_r($staff_id);exit;
        $request_id = $this->input->post("leaverequestid");


        $this->form_validation->set_rules('applieddate', 'Applied Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('leavedates', 'Leave from Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('leave_type', 'Leave Type', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {


            $msg = array(
                'applieddate' => form_error('applieddate'),
                'leavedates' => form_error('leavedates'),
                'leave_type' => form_error('leave_type'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $a = $this->input->post("leavedates");
            $b = explode('-', trim($a));

            $leavefrom = date("Y-m-d", strtotime($b[0]));
            $leaveto = date("Y-m-d", strtotime($b[1]));


            if (isset ($_FILES["userfile"]) && !empty ($_FILES['userfile']['name'])) {
                $uploaddir = './uploads/staff_documents/' . $staff_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die ("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["userfile"]["name"]);
                $document = basename($_FILES['userfile']['name']);
                $img_name = $uploaddir . basename($_FILES['userfile']['name']);
                move_uploaded_file($_FILES["userfile"]["tmp_name"], $img_name);
            } else {

                $document = $this->input->post("filename");
            }

            $applied_by = $this->customlib->getAdminSessionUserName();
            $leave_days = $this->dateDifference($leavefrom, $leaveto);
            if (!empty ($request_id)) {


                $data = array(
                    'id' => $request_id,
                    'staff_id' => $staff_id,
                    'date' => date('Y-m-d', $this->customlib->datetostrtotime($applied_date)),
                    'leave_type_id' => $leavetype,
                    'leave_days' => $leave_days,
                    'leave_method' => $leave_method,
                    'leave_from' => $leavefrom,
                    'leave_to' => $leaveto,
                    'employee_remark' => $reason,
                    'status' => $status,
                    'applied_by' => $applied_by,
                    'document_file' => $document,
                    'assigned_staff' => $assigned_staff 

                );
            } else {

                $data = array('staff_id' => $staff_id, 'date' => date("Y-m-d", strtotime($applied_date)), 'leave_days' => $leave_days, 'leave_type_id' => $leavetype, 'leave_from' => $leavefrom, 'leave_to' => $leaveto, 'employee_remark' => $reason, 'status' => $status, 'applied_by' => $applied_by, 'leave_method' => $leave_method, 'document_file' => $document,'assigned_staff'=>  $assigned_staff );
            }


            $this->leaverequest_model->addLeaveRequest($data);

            $array = array('status' => 'success', 'error' => '', 'message' => "Record Saved Successfully");
        }

        echo json_encode($array);
    }








    /*?><!--public function lvmethod(){
       $lv=o;
       if("dstatus"=="approve" && 'leave_method'=="full")
       {
           $lv=1;
       }
       elseif('dstatus'=="approve" && 'leave_method'=="half"){
           
           $lv=0.5;
       }
       $data=array
   (

   'staff_id' => $staff_id,
   $alloted_leave=$this->input->post("$lv")
   );
   $this->leaverequest_model->allotedleave($data,$staff_id);
   }
   --><?php */
}

?>