<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Route_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id = null) {
        $admin=$this->session->userdata('admin');
        $this->db->select()->from('transport_route');
        $this->db->where('centre_id',$admin['centre_id']);
        if ($id != null) {
            $this->db->where('transport_route.id', $id);
        } else {
            $this->db->order_by('transport_route.id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }


    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('transport_route');
    }


    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('transport_route', $data);
        } else {
            $this->db->insert('transport_route', $data);
            return $this->db->insert_id();
        }
    }

    public function listroute() {
        $admin=$this->session->userdata('admin');
        $this->db->select()->from('transport_route');
        $this->db->where('centre_id',$admin['centre_id']);
        $listtransport = $this->db->get();
        return $listtransport->result_array();
    }
    public function listrouteStudent() {
        $admin=$this->session->userdata('student');
        $centre_id=$admin['centre_id'];
        if($admin['role']=='parent'){
            $id =  $_SESSION['parent_childs'][0]['student_id'];
             $centre_id=$this->db->where('id',$id)->get('students')->row()->centre_id;
 
         }
        $this->db->select()->from('transport_route');
        $this->db->where('centre_id',$centre_id);
        $listtransport = $this->db->get();
        return $listtransport->result_array();
    }

    public function listvehicles() {
        $admin=$this->session->userdata('admin');
        $this->db->select()->from('vehicles');
        $this->db->where('centre_id',$admin['centre_id']);
        $listvehicles = $this->db->get();
        return $listvehicles->result_array();
    }

    function studentTransportDetails($carray) {
 
       $admin=$this->session->userdata('admin');
        $userdata = $this->customlib->getUserData();

        if (($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {
            if (!empty($carray)) {

                $this->db->where_in("student_session.class_id", $carray);
            } else {
                $this->db->where_in("student_session.class_id", "");
            }
        }
        $query = $this->db->select('students.firstname,students.id,students.admission_no,students.father_name,students.mother_name, students.father_phone,students.mother_phone,classes.class,sections.section,students.lastname,students.mobileno,transport_route.route_title,transport_route.fare,vehicles.vehicle_no,vehicles.vehicle_model,vehicles.driver_name,vehicles.driver_contact')->join('student_session', 'students.id = student_session.student_id')->join('sections', 'sections.id = student_session.section_id')->join('classes', 'classes.id = student_session.class_id')->join("vehicle_routes", "students.vehroute_id = vehicle_routes.id")->join("vehicles", "vehicle_routes.vehicle_id = vehicles.id")->join("transport_route", "vehicle_routes.route_id = transport_route.id")->where('students.centre_id',$admin['centre_id'])->where('student_session.session_id',$this->current_session)->get("students");
        // $query = $this->db->select('students.firstname,students.id, students.father_name,students.mother_name, students.father_phone,students.mother_phone, students.admission_no,students.lastname,students.mobileno,transport_route.route_title,transport_route.fare,vehicles.vehicle_no,vehicles.vehicle_model,vehicles.driver_name,vehicles.driver_contact')->join("vehicle_routes", "students.vehroute_id = vehicle_routes.id")->join("vehicles", "vehicle_routes.vehicle_id = vehicles.id")->join("transport_route", "vehicle_routes.route_id = transport_route.id")->where("students.is_active", "yes")->get("students");
      //  echo $this->db->last_query();
       // exit();
        return $query->result_array();
    }

    function searchTransportDetails($section_id, $class_id, $route_title, $vehicle_no) {
        $admin=$this->session->userdata('admin');

        if((!empty($class_id)) && (!empty($section_id))){
           
            $this->db->where('student_session.class_id',$class_id)->where('student_session.section_id',$section_id)->where('student_session.session_id',$this->current_session);
        }


        if(!empty($route_title)){
           
            $this->db->where('transport_route.route_title',$route_title)->where('student_session.session_id',$this->current_session);
        }

        if(!empty($vehicle_no)){
           
            $this->db->where('vehicles.vehicle_no',$vehicle_no)->where('student_session.session_id',$this->current_session);
        }

        $query = $this->db->select('students.firstname,students.id,students.admission_no,students.father_name,students.mother_name, students.father_phone,students.mother_phone,classes.class,sections.section,students.lastname,students.mobileno,transport_route.route_title,transport_route.fare,vehicles.vehicle_no,vehicles.vehicle_model,vehicles.driver_name,vehicles.driver_contact')->join('student_session', 'students.id = student_session.student_id')->join('sections', 'sections.id = student_session.section_id')->join('classes', 'classes.id = student_session.class_id')->join("vehicle_routes", "students.vehroute_id = vehicle_routes.id")->join("vehicles", "vehicle_routes.vehicle_id = vehicles.id")->join("transport_route", "vehicle_routes.route_id = transport_route.id")->where('students.centre_id',$admin['centre_id'])->get("students");
            
        
        return $query->result_array();
    }


    public function getClass($student_id)
    {
        $query = $this->db->query("SELECT  classes.class, classes.id  FROM  `classes`  where id in ( SELECT max(class_id) from student_session WHERE student_id = $student_id) ");
        return $query->row_array();
    }

     public function getSection($student_id,$class_id)
    {
        $query = $this->db->query("SELECT  sections.section  FROM  `sections` join student_session on student_session.section_id = sections.id where student_session.class_id = ".$class_id." and student_session.student_id = ".$student_id);
        return $query->row_array();
    }
}


