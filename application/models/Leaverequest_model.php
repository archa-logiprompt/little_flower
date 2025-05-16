<?php

/**
 * 
 */
class Leaverequest_model extends CI_model
{

    public function staff_leave_request($id = null)
    {

        if ($id != null) {
            $this->db->where("staff_leave_request.staff_id", $id);
        }

        $query = $this->db->select('staff.name,staff.surname,staff.employee_id,staff_leave_request.*,leave_types.type')->join("staff", "staff.id = staff_leave_request.staff_id")->join("leave_types", "leave_types.id = staff_leave_request.leave_type_id")->join("staff_roles", "staff.id = staff_roles.staff_id")->where("staff.is_active", "1")->where("staff_leave_request.hod", "approve")->or_where("staff_roles.role_id !=", '2')->order_by("staff_leave_request.id", "desc")->get("staff_leave_request");
        // echo $query;
        return $query->result_array();
    }
    public function staff_leave_requestnew($id = null)
    {

        if ($id != null) {
            $this->db->where("staff_leave_request.staff_id", $id);
        }

        $query = $this->db->select('staff.name,staff.surname,staff.employee_id,staff_leave_request.*,leave_types.type')->join("staff", "staff.id = staff_leave_request.staff_id")->join("leave_types", "leave_types.id = staff_leave_request.leave_type_id")->join("staff_roles", "staff.id = staff_roles.staff_id")->where("staff.is_active", "1")->order_by("staff_leave_request.id", "desc")->get("staff_leave_request");
        // echo $query;
        return $query->result_array();
    }

    public function staff_leave_requesthod($id)
    {

        $query = $this->db->select('staff.name,staff.surname,staff.employee_id,staff_leave_request.*,leave_types.type')->join("staff", "staff.id = staff_leave_request.staff_id")->join("leave_types", "leave_types.id = staff_leave_request.leave_type_id")->join("staff_roles", "staff.id = staff_roles.staff_id")->where("staff.is_active", "1")->where("staff.is_active", "1")->where("staff.department", $id)->where("staff_roles.role_id", '2')->order_by("staff_leave_request.id", "desc")->get("staff_leave_request");

        return $query->result_array();
    }
    public function staff_leave_super($id)
    {

        $query = $this->db->select('staff.name,staff.surname,staff.employee_id,staff_leave_request.*,leave_types.type')->join("staff", "staff.id = staff_leave_request.staff_id")->join("leave_types", "leave_types.id = staff_leave_request.leave_type_id")->join("staff_roles", "staff.id = staff_roles.staff_id")->where("staff.is_active", "1")->where("staff.is_active", "1")->where("staff.department", $id)->where("staff_roles.role_id", '2')->order_by("staff_leave_request.id", "desc")->get("staff_leave_request");

        return $query->result_array();
    }


    public function user_leave_request($id = null)
    {


        $query = $this->db->select('staff.name, staff.surname, staff.employee_id, staff_leave_request.*, leave_types.type, assigned_staff.name as assigned_staff_name,assigned_staff.surname as assigned_staff_surname')
        ->join("staff", "staff.id = staff_leave_request.staff_id")  
        ->join("leave_types", "leave_types.id = staff_leave_request.leave_type_id")  
        ->join("staff as assigned_staff", "assigned_staff.id = staff_leave_request.assigned_staff", "left")  
        ->where("staff.is_active", "1")  
        ->where("staff.id", $id)  
        ->order_by("staff_leave_request.id", "desc")  
        ->get("staff_leave_request");
    
// echo $this->db->last_query();exit;
        return $query->result_array();
    }
    public function allotedLeaveType($id)
    {

        $query = $this->db->select('staff_leave_details.*,leave_types.type,leave_types.id as typeid')->where(array('staff_id' => $id))->join("leave_types", "staff_leave_details.leave_type_id = leave_types.id")->group_by("leave_types.id")->get("staff_leave_details");
        // echo $this->db->last_query();exit;
        return $query->result_array();
    }

    public function countLeavesData($staff_id, $leave_type_id)
    {

        $query1 = $this->db->select('sum(leave_days) as approve_leave')->where(array('staff_id' => $staff_id, 'status' => 'approve', 'leave_type_id' => $leave_type_id))->get("staff_leave_request");
        return $query1->row_array();
    }

    public function changeLeaveStatus($data, $staff_id)
    {


        $this->db->where("id", $staff_id)->update("staff_leave_request", $data);
        // echo $this->db->last_query();exit;
    }
    public function changeLeaveStatushod($data, $staff_id)
    {


        $this->db->where("id", $staff_id)->update("staff_leave_request", $data);
    }

    public function changeLeaveStatussuperviser($data, $staff_id)
    {


        $this->db->where("id", $staff_id)->update("superviser", $data);
    }





    public function getLeaveSummary()
    {

        $query = $this->db->select('*')->get("staff");

        return $query->result_array();
    }

    function addLeaveRequest($data)
    {

        if (isset ($data['id'])) {

            $this->db->where("id", $data["id"]);
            $this->db->update("staff_leave_request", $data);
        } else {

            $this->db->insert("staff_leave_request", $data);
            // echo $this->db->last_query();exit;
        }
    }

    /*?> public function allotedleave($data, $staff_id) {


          $this->db->where("id", $staff_id)->update("staff_leave_request", $data);
      }<?php */

    function getStafLeaveCC()
    {
        $result = $this->db->select('staff_leave_request.*,staff.name,staff.surname,leave_types.type')->join('staff', 'staff.id=staff_leave_request.staff_id')->join('leave_types', 'leave_types.id=staff_leave_request.leave_type_id')->where('status', "pending")->or_where('status', "1")->or_where('status', "2")->or_where('status', "3")->or_where('status', "approve")->order_by('id', "desc")->get('staff_leave_request')->result_array();
        return $result;

    }
    function getStafLeaveHod()
    {
        $result = $this->db->select('staff_leave_request.*,staff.name,staff.surname,leave_types.type')->join('staff', 'staff.id=staff_leave_request.staff_id')->join('leave_types', 'leave_types.id=staff_leave_request.leave_type_id')->where('status', "1")->or_where('status', "2")->or_where('status', "3")->or_where('status', "approve")->order_by('id', "desc")->get('staff_leave_request')->result_array();

        return $result;

    }

    function getStafLeaveugpg()
    {
        $result = $this->db->select('staff_leave_request.*,staff.name,staff.surname,leave_types.type')->join('staff', 'staff.id=staff_leave_request.staff_id')->join('leave_types', 'leave_types.id=staff_leave_request.leave_type_id')->where('status', "2")->or_where('status', "3")->or_where('status', "approve")->order_by('id', "desc")->get('staff_leave_request')->result_array();

        return $result;
    }

    function getStafLeaveprincipal()
    {
        $result = $this->db->select('staff_leave_request.*,staff.name,staff.surname,leave_types.type')->join('staff', 'staff.id=staff_leave_request.staff_id')->join('leave_types', 'leave_types.id=staff_leave_request.leave_type_id')->where('status', "3")->or_where('status', "approve")->or_where('status', "5")->order_by('id', "desc")->get('staff_leave_request')->result_array();

        return $result;
    }

    function getStafLeaveAdmin()
    {
        $result = $this->db->select('staff_leave_request.*,staff.name,staff.surname,leave_types.type')->join('staff', 'staff.id=staff_leave_request.staff_id')->join('leave_types', 'leave_types.id=staff_leave_request.leave_type_id')->where('status', "1")->order_by('id', "desc")->get('staff_leave_request')->result_array();

        return $result;
    }
    
    function getStafLeaveforprincipal()
    {
        $result = $this->db->select('staff_leave_request.*,staff.name,staff.surname,leave_types.type')->join('staff', 'staff.id=staff_leave_request.staff_id')->join('leave_types', 'leave_types.id=staff_leave_request.leave_type_id')->where('status', "2")->or_where('status', "0")->or_where('status', "approve")->or_where('status', "5")->order_by('id', "desc")->get('staff_leave_request')->result_array();
        // echo $this->db->last_query();exit;
        return $result;

    }
    function getStafLeavefordirector()
    {
        $result = $this->db->select('staff_leave_request.*,staff.name,staff.surname,leave_types.type')->join('staff', 'staff.id=staff_leave_request.staff_id')->join('leave_types', 'leave_types.id=staff_leave_request.leave_type_id')->where('status', "3")->or_where('status', "approve")->or_where('status', "5")->order_by('id', "desc")->get('staff_leave_request')->result_array();
        // echo $this->db->last_query();exit;
        return $result;

    }

}

?>