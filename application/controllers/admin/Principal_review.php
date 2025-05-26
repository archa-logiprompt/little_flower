<?php

class principal_review extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        $this->load->model('hr_model');
        $this->config->load("mailsms");
        $this->config->load("payroll");
        $this->load->library('mailsmsconf');
        $this->config_attendance = $this->config->item('attendence');
        $this->staff_attendance = $this->config->item('staffattendance');
        $this->payment_mode = $this->config->item('payment_mode');
        $this->load->model("payroll_model");
        $this->load->model("staff_model");
        $this->load->model('staffattendancemodel');
        $this->load->model('accounts/Journal_Model', 'journal');
         $this->load->model('review_model');

        $this->payroll_status = $this->config->item('payroll_status');
    }


    public function index()
    {
        // var_dump("hi");exit;
        $data["staff_id"] = "";
        $data["name"] = "";
        $admin = $this->session->userdata('admin');
      
       if ($admin['centre_id']==1)
       {
             $staff_list=$this->db->select('staff.*,staff_designation.id as did,staff_designation.designation')->from('staff')->join('staff_designation','staff_designation.id =staff.designation ')->where('staff.centre_id',$admin['centre_id'])->get()->result_array();
             $data['staff_list']=$staff_list;
            //  var_dump($data['staff_list']);exit;


           $this->load->view("layout/header", $data);
           $this->load->view("admin/principal_review/form", $data);
           $this->load->view("layout/footer", $data);

       }

    }
    public function review_form($id)
    {
        $data["staff_id"] = "";
        $data["name"] = "";
        $admin = $this->session->userdata('admin');
        $staff_list=$this->db->select('staff.*,staff_designation.id as did,staff_designation.designation')->from('staff')->join('staff_designation','staff_designation.id =staff.designation ')->where('staff.id',$id)->get()->row_array();
        $data['staff_list']=$staff_list;
        // var_dump(  $data['staff_list']);exit;
        $this->load->view("layout/header", $data);
           $this->load->view("admin/principal_review/principal_review_form", $data);
           $this->load->view("layout/footer", $data);
    }
    
   public function save_review()
{
    // Load the model handling DB operations
 $admin = $this->session->userdata('admin');
    $staff_id = $this->input->post('staff_id');
    $criteria_scores = $this->input->post('criteria');

    if (!empty($staff_id) && !empty($criteria_scores)) {
        foreach ($criteria_scores as $criteria_index => $score) {
            $data = array(
                'staff_id'       => $staff_id,
                'criteria_index' => $criteria_index,
                'score'          => $score,
                'reviewed_by'    =>  $admin['id'] , 
                
                'review_date'    => date('Y-m-d H:i:s'),
            );

            // var_dump($data);exit;
            // Save each criteria score
            $this->review_model->save_review_score($data);
        }
         $this->db->where('id', $staff_id);
        $this->db->update('staff', ['status' => 'reviewed_by_principal']);

        $this->session->set_flashdata('msg', 'Review submitted successfully!');
    } else {
        $this->session->set_flashdata('msg', 'Invalid review submission.');
    }

    redirect('admin/principal_review');
}

public function principal_review_report()
{
   
   
        if (!$this->rbac->hasPrivilege('staff_attendance_report', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/principal_review/principal_review_report');
      

        $staff_list = $this->staff_model->getstafflist();
        $data['staff_list'] =  $staff_list;

        $data['title'] = 'Attendance Report';
        $search = $this->input->post('search');
      if ($search == 'search') {
    $this->form_validation->set_rules('staff', 'Staff Name', 'trim|required|xss_clean');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('layout/header', $data);
        $this->load->view('admin/principal_review/report', $data);
        $this->load->view('layout/footer', $data);
    } else {
        $staff = $this->input->post('staff');

       $staffDetails = $this->db->select('staff_reviews.*, staff.id AS sid, staff.name, staff.surname')
    ->from('staff_reviews')
    ->join('staff', 'staff.id = staff_reviews.staff_id')
    
    ->where('staff_reviews.staff_id', $staff)
    ->get()->result_array();


        // echo $this->db->last_query(); exit;

        $data['staffDetails'] = $staffDetails;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/principal_review/report', $data);
        $this->load->view('layout/footer', $data);
    }
} else {
    // Show default view if not searching

    $this->load->view('layout/header', $data);
    $this->load->view('admin/principal_review/report', $data);
    $this->load->view('layout/footer', $data);
}
}


}
?>