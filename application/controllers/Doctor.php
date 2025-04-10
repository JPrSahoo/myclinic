<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

    public function dashboard(){
        $data['title'] = 'Doctor Dashboard';
        $data['page_title'] = 'Welcome, Doctor';

        $data['page'] = 'doctor/dashboard';
        $this->load->view('doctor/layout', $data);
    }

    public function get_doctors_by_department() {
        $dept_id = $this->input->post('dept_id');
        //call clinic helper
        $doctors = get_doctors_by_department($dept_id); 
        echo json_encode($doctors);
    }
    
}
