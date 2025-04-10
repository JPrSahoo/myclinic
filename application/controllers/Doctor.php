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
    public function all_patients() {
        $this->load->model('Patient_model');
        $data['patients'] = $this->Patient_model->get_all_patients();
    
        $data['title'] = 'All Patients';
        $data['page_title'] = 'Patient List';
    
        // Load view
        $data['page'] = 'doctor/patients';
        $this->load->view('doctor/layout', $data);
    }    
    public function view_patient($patient_id) {
        $this->load->model('Patient_model');
        $this->load->model('Doctor_model');
    
        // Fetch patient basic info
        $data['patient'] = $this->Patient_model->get_patient_by_id($patient_id);
    
        // Fetch visit history
        $data['visits'] = $this->Doctor_model->get_patient_visits($patient_id);
    
        // Fetch prescriptions
        $data['prescriptions'] = $this->Doctor_model->get_patient_prescriptions($patient_id);
    
        // Fetch tests (if applicable)
        $data['tests'] = $this->Doctor_model->get_patient_tests($patient_id);
    
        $data['title'] = 'Patient Details';
        $data['page_title'] = 'Patient Profile';
    
        $data['page'] = 'doctor/view_patient';
        $this->load->view('doctor/layout', $data);
    }
    
    
}
