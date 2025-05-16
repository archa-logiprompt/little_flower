<?php

if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Vehicle extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        if (!$this->rbac->hasPrivilege('vehicle', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Transport');
        $this->session->set_userdata('sub_menu', 'vehicle/index');
        $data['title'] = 'Add Vehicle';
        $listVehicle = $this->vehicle_model->get();
        $data['listVehicle'] = $listVehicle;
        $this->form_validation->set_rules('vehicle_no', 'Vehicle No', 'required|is_unique[vehicles.vehicle_no]');
        $this->form_validation->set_rules('seat', 'Seat', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header');
            $this->load->view('admin/vehicle/index', $data);
            $this->load->view('layout/footer');
        } else {
            $manufacture_year = $this->input->post('manufacture_year');

            $admin = $this->session->userdata('admin');
            $data = array(
                'centre_id' => $admin['centre_id'],
                'vehicle_no' => $this->input->post('vehicle_no'),
                'seat' => $this->input->post('seat'),
                'vehicle_model' => $this->input->post('vehicle_model'),
                'driver_name' => $this->input->post('driver_name'),
                'driver_licence' => $this->input->post('driver_licence'),
                'driver_contact' => $this->input->post('driver_contact'),
                'note' => $this->input->post('note'),
            );

            ($manufacture_year != "") ? $data['manufacture_year'] = $manufacture_year : '';
            $this->vehicle_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Vehicle added successfully</div>');
            redirect('admin/vehicle/index');
        }
    }

    function edit($id)
    {

        if (!$this->rbac->hasPrivilege('vehicle', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Add Vehicle';
        $data['id'] = $id;
        $editvehicle = $this->vehicle_model->get($id);

        $data['editvehicle'] = $editvehicle;
        $listVehicle = $this->vehicle_model->get();
        $data['listVehicle'] = $listVehicle;
        $this->form_validation->set_rules('vehicle_no', 'Vehicle No', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header');
            $this->load->view('admin/vehicle/edit', $data);
            $this->load->view('layout/footer');
        } else {
            $manufacture_year = $this->input->post('manufacture_year');
            $data = array(
                'id' => $this->input->post('id'),
                'vehicle_no' => $this->input->post('vehicle_no'),
                'vehicle_model' => $this->input->post('vehicle_model'),
                'driver_name' => $this->input->post('driver_name'),
                'driver_licence' => $this->input->post('driver_licence'),
                'driver_contact' => $this->input->post('driver_contact'),
                'note' => $this->input->post('note'),
            );
            ($manufacture_year != "") ? $data['manufacture_year'] = $manufacture_year : '';
            $this->vehicle_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Transport updated successfully</div>');
            redirect('admin/vehicle/index');
        }
    }

    function delete($id)
    {

        if (!$this->rbac->hasPrivilege('vehicle', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $this->vehicle_model->remove($id);
        redirect('admin/vehicle/index');
    }

    public function createnewtransport()
    {
        if (!$this->rbac->hasPrivilege('assign_students', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Transport');
        $this->session->set_userdata('sub_menu', 'vehroute/assign_students');

        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('vehicle_id', 'Vehicle No', 'trim|required|xss_clean');
        $this->form_validation->set_rules('driver_id', 'Driver', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('location', 'To', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('from', 'From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('time', 'Time', 'trim|required|xss_clean');
        $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('total_students', 'Count', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('group_name', 'Title', 'trim|required|xss_clean');

        $drivers = $this->vehicle_model->getDriver();
        $data['drivers'] = $drivers;
        $vehicles = $this->vehicle_model->get();
        $data['vehicles'] = $vehicles;
        $data['search'] = false;


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('admin/vehicle/createtransport', $data);
            $this->load->view('layout/footer');
        } else {
            $data = array(
                "type" => $this->input->post("type"),
                "date" => date('Y-m-d', strtotime($this->input->post("date"))),
                "group_name" => $this->input->post("group_name"),
                'from' => $this->input->post("from"),
                'class_section' => $this->input->post("class_section"),
                'total_students' => $this->input->post("total_students"),
                'location' => $this->input->post("location"),
                'time' => $this->input->post("time"),
                'driver_id' => $this->input->post("driver_id"),
                'vehicle_id' => $this->input->post("vehicle_id"),
                'remarks' => $this->input->post("remarks"),
            );
            $this->db->insert('transportation', $data);
            // echo $this->db->last_query();exit;

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Transporation added successfully</div>');

            $this->load->view('layout/header');
            $this->load->view('admin/vehicle/createtransport', $data);
            $this->load->view('layout/footer');

        }
    }

    function assign_students()
    {
        if (!$this->rbac->hasPrivilege('assign_students', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Transport');
        $this->session->set_userdata('sub_menu', 'vehroute/assign_students');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('admin/vehicle/assignstudents', );
            $this->load->view('layout/footer');
        } else {
            $date = $this->input->post('date');

            $exist = $this->db->select()->where('date', date('Y-m-d', strtotime($date)))->get('transportation')->result_array();

            if (!$exist) {
                $data['date'] = date('d-m-Y', strtotime($date));
                $data['search'] = true;
                $clinicalList = $this->vehicle_model->getClinicalData(date('Y-m-d', strtotime($date)));
                $data['clinicalList'] = $clinicalList;
                $drivers = $this->vehicle_model->getDriver();
                $data['drivers'] = $drivers;
                $vehicles = $this->vehicle_model->get();
                $data['vehicles'] = $vehicles;
            } else {
                $data['date'] = date('d-m-Y', strtotime($date));
                $data['search'] = true;
                $clinicalList = $this->vehicle_model->getClinicalData(date('Y-m-d', strtotime($date)));
                foreach ($clinicalList as $key => $row) {
                    $existingData = $this->db->select()->where('group_name', $row['group_name'])->where('date', date('Y-m-d', strtotime($date)))->get('transportation')->row();
                    if ($existingData) {
                        $clinicalList[$key]['update'] = $existingData;
                    }
                }
                $data['clinicalList'] = $clinicalList;
                $drivers = $this->vehicle_model->getDriver();
                $data['drivers'] = $drivers;
                $vehicles = $this->vehicle_model->get();
                $data['vehicles'] = $vehicles;
            }




            $this->load->view('layout/header', $data);
            $this->load->view('admin/vehicle/assignstudents', $data);
            $this->load->view('layout/footer', $data);

        }



        //  $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Vehicle added successfully</div>');
        // redirect('admin/vehicle/index');
    }

    public function createTransportation()
    {


        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $date = $this->input->post('date');
        $from = $this->input->post('from');
        $group_name = $this->input->post('group_name');
        $class_section = $this->input->post('class_section');
        $total_students = $this->input->post('total_students');
        $location = $this->input->post('location');
        $time = $this->input->post('time');
        $driver_id = $this->input->post('driver_id');
        $vehicle_id = $this->input->post('vehicle_id');
        $remark = $this->input->post('remark');



        foreach ($id as $i => $row) {
            if ($row == 0) {
                $data = array(
                    "type" => $type[$i],
                    "date" => date('Y-m-d', strtotime($date)),
                    "group_name" => $group_name[$i],
                    'class_section' => $class_section[$i],
                    'from' => $from[$i],
                    'total_students' => $total_students[$i],
                    'location' => $location[$i],
                    'time' => $time[$i],
                    'driver_id' => $driver_id[$i],
                    'vehicle_id' => $vehicle_id[$i],
                    'remarks' => $remark[$i],
                );

                $this->db->insert('transportation', $data);
            } else {
                $data = array(
                    "type" => $type[$i],
                    "date" => date('Y-m-d', strtotime($date)),
                    "group_name" => $group_name[$i],
                    'from' => $from[$i],
                    'class_section' => $class_section[$i],
                    'total_students' => $total_students[$i],
                    'location' => $location[$i],
                    'time' => $time[$i],
                    'driver_id' => $driver_id[$i],
                    'vehicle_id' => $vehicle_id[$i],
                    'remarks' => $remark[$i],
                );
                $this->db->where('id', $row);
                $this->db->update('transportation', $data);
            }

        }
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Transportation added successfully</div>');

        redirect("admin/vehicle/assign_students");

    }


    public function driver()
    {
        if (!$this->rbac->hasPrivilege('vehicle', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Transport');
        $this->session->set_userdata('sub_menu', 'vehicle/driver');
        $data['title'] = 'Add Vehicle';
        $this->form_validation->set_rules('driver_name', 'Driver Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('age', 'Age', 'trim|required|xss_clean');
        $this->form_validation->set_rules('contact', 'Contact', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('licence_no', 'Licence Number', 'trim|required|xss_clean');
        $this->form_validation->set_rules('blood_group', 'Blood Group', 'trim|required|xss_clean');
        $data['driverList'] = $this->vehicle_model->getDriver();

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header');
            $this->load->view('admin/vehicle/driver', $data);
            $this->load->view('layout/footer');
        } else {


            $admin = $this->session->userdata('admin');
            $data = array(
                'driver_name' => $this->input->post('driver_name'),
                'age' => $this->input->post('age'),
                'address' => $this->input->post('address'),
                'blood_group' => $this->input->post('blood_group'),
                'licence_no' => $this->input->post('licence_no'),
                'contact' => $this->input->post('contact'),
            );


            $this->vehicle_model->addDriver($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Driver added successfully</div>');
            redirect('admin/vehicle/driver');
        }
    }

    public function driverdelete($id)
    {
        $this->vehicle_model->deleteDriver($id);

    }

    public function driveredit($id)
    {
        $this->session->set_userdata('top_menu', 'Transport');
        $this->session->set_userdata('sub_menu', 'vehroute/assign_students');
        $data['title'] = 'Add Vehicle';
        $this->form_validation->set_rules('driver_name', 'Driver Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('age', 'Age', 'trim|required|xss_clean');
        $this->form_validation->set_rules('contact', 'Contact', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('licence_no', 'Licence Number', 'trim|required|xss_clean');
        $this->form_validation->set_rules('blood_group', 'Blood Group', 'trim|required|xss_clean');
        $data['driverList'] = $this->vehicle_model->getDriver();
        $data['driver'] = $this->vehicle_model->getDriver($id);

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header');
            $this->load->view('admin/vehicle/driveredit', $data);
            $this->load->view('layout/footer');
        } else {


            $admin = $this->session->userdata('admin');
            $data = array(
                'id' => $id,
                'driver_name' => $this->input->post('driver_name'),
                'age' => $this->input->post('age'),
                'address' => $this->input->post('address'),
                'blood_group' => $this->input->post('blood_group'),
                'licence_no' => $this->input->post('licence_no'),
                'contact' => $this->input->post('contact'),
            );


            $this->vehicle_model->addDriver($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Driver updated successfully</div>');
            redirect('admin/vehicle/driver');
        }
    }

    public function transport_report()
    {
        if (!$this->rbac->hasPrivilege('transport_report', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Transport');
        $this->session->set_userdata('sub_menu', 'vehroute/transport_report');

        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');

        $data['drivers'] = $this->vehicle_model->getDriver();
        $data['search'] = false;


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('admin/vehicle/transportreport', $data);
            $this->load->view('layout/footer');
        } else {
            $date = $this->input->post('date');
            $data['date'] = $date;
            $driver_id = $this->input->post('driver');
            $data['driver_id'] = $driver_id;
            $data['search'] = true;
            $result = $this->vehicle_model->getTransport($date, $driver_id);
            $data['result'] = $result;

            $this->load->view('layout/header', $data);
            $this->load->view('admin/vehicle/transportreport', $data);
            $this->load->view('layout/footer', $data);

        }
    }
    public function reportdelete($id)
    {
        $this->vehicle_model->deleteTransport($id);
        redirect("admin/vehicle/transport_report");
    }


    public function reportedit($id)
    {

        $data['row'] = $this->db->select()->where('id', $id)->get('transportation')->row();
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
        $drivers = $this->vehicle_model->getDriver();
        $data['drivers'] = $drivers;
        $vehicles = $this->vehicle_model->get();
        $data['vehicles'] = $vehicles;


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/vehicle/transportreportedit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $type = explode("-", $this->input->post("type"));
            $data = array(
                "type" => $type[0],
                "date" => date('Y-m-d', strtotime($this->input->post("date"))),
                "group_name" => $type[1],
                'from' => $this->input->post("from"),
                'class_section' => $this->input->post("class_section"),
                'total_students' => $this->input->post("total_students"),
                'location' => $this->input->post("location"),
                'time' => $this->input->post("time"),
                'driver_id' => $this->input->post("driver_id"),
                'vehicle_id' => $this->input->post("vehicle_id"),
                'remarks' => $this->input->post("remarks"),
            );
            $this->db->where('id', $id);
            $this->db->update('transportation', $data);


            redirect("admin/vehicle/transport_report");

        }



    }



}


?>