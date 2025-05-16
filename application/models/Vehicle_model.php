<?php

if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Vehicle_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id = null)
    {
        $admin = $this->session->userdata('admin');
        $this->db->select()->from('vehicles');
        $this->db->where('centre_id', $admin['centre_id']);
        if ($id != null) {
            $this->db->where('vehicles.id', $id);
        } else {
            $this->db->order_by('vehicles.id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row();
        } else {
            return $query->result_array();
        }
    }
    public function getclinical($from_date = null, $to_date = null)
    {
        $this->db->select('assign_ward.datefrom, assign_ward.group_id,assign_ward.dateto, assign_ward.class_id, assign_ward.section_id, clinical_groupname.group_name, COUNT(clinical_group.student_session_id) AS session_count');
        $this->db->from('assign_ward');

        $this->db->join('clinical_groupname', 'assign_ward.group_id = clinical_groupname.id');
        $this->db->join('clinical_group', 'assign_ward.group_id = clinical_group.group_id');

        if ($from_date && $to_date) {
            $this->db->where('assign_ward.datefrom >=', $from_date);
            $this->db->where('assign_ward.dateto <=', $to_date);
        }

        $this->db->group_by('clinical_groupname.group_name');

        $query = $this->db->get();
        return $query->result_array();
    }





    public function remove($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('vehicles');
    }

    public function add($data)
    {
        if (isset ($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('vehicles', $data);
        } else {
            $this->db->insert('vehicles', $data);
            return $this->db->insert_id();
        }
    }

    public function vehicleListByarray($array)
    {

        $this->db->select('*');
        $this->db->from('vehicles');
        $this->db->where_in('vehicles.id', $array);
        $query = $this->db->get();
        return $query->result();
    }

    public function getClinicalData($date)
    {

        $result = $this->db->select('*,count(student_session_id)as total_students')
            ->from('clinical_group')
            ->join('clinical_groupname', 'clinical_groupname.id = clinical_group.group_id')
            ->join('assign_ward', 'assign_ward.group_id = clinical_groupname.id')
            ->join('warddetail', "warddetail.id=assign_ward.ward_id")
            ->join('classes', "classes.id=assign_ward.class_id")
            ->join('sections', "sections.id=assign_ward.section_id")
            ->join('clinical_location', "clinical_location.id=warddetail.location_id")
            ->where('assign_ward.datefrom <=', $date)
            ->where('assign_ward.dateto >=', $date)
            ->group_by('group_name')
            ->get()
            ->result_array();
        return $result;
    }

    public function getDriver($id = null)
    {


        $this->db->select();
        if ($id) {
            $result = $this->db->where('id', $id)->get('drivers')->row();
        } else {

            $result = $this->db->get('drivers')->result_array();
        }
        return $result;
    }

    public function addDriver($data)
    {

        if ($data['id']) {
            $this->db->where('id', $data['id'])->update('drivers', $data);
        } else {

            $this->db->insert('drivers', $data);
        }
    }

    public function deleteDriver($id)
    {
        $this->db->where('id', $id)->delete('drivers');
        redirect('admin/vehicle/driver');
    }

    public function getTransport($date, $driver_id)
    {

        $formatted_date = date('Y-m-d', strtotime($date));

        $this->db->select('*,drivers.driver_name,transportation.id as tid');
        if ($driver_id) {
            $result = $this->db
                ->where('driver_id', $driver_id) // Filter by driver_id
                ->where('date', $formatted_date) // Filter by formatted date
                ->join('drivers', 'drivers.id=transportation.driver_id')->join('vehicles', 'vehicles.id=transportation.vehicle_id')->get('transportation') // Retrieve data from 'transportation' table
                ->result_array();
            // echo $this->db->last_query();exit;
        } else {
            $result = $this->db->where('date', $formatted_date)->join('drivers', 'drivers.id=transportation.driver_id')->join('vehicles', 'vehicles.id=transportation.vehicle_id')->get('transportation')->result_array();
        }
        return $result;
    }

    public function deleteTransport($id)
    {
        $this->db->where('id', $id)->delete('transportation');
    }



}
