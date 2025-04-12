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
    
        $data['patient'] = $this->Patient_model->get_patient_by_id($patient_id);
    
        // Get all visits of the patient
        $visits = $this->Doctor_model->get_patient_visits($patient_id);
    
        // Attach prescriptions and tests to each visit
        foreach ($visits as &$visit) {
            $visit->prescriptions = $this->Doctor_model->get_prescriptions_by_visit($visit->id);
            $visit->tests = $this->Doctor_model->get_tests_by_visit($visit->id);
        }
    
        $data['visits'] = $visits;
        $data['title'] = 'Patient Details';
        $data['page_title'] = 'Patient History by Visit';
    
        $data['page'] = 'doctor/view_patient';
        $this->load->view('doctor/layout', $data);
    }
    public function prescribe($patient_id) {
        $this->load->model('Doctor_model');
        $this->load->model('Patient_model');
    
        // Get latest visit for this patient (or ask doctor to select from visits)
        $visit = $this->Doctor_model->get_latest_visit($patient_id);
    
        if ($this->input->post()) {
            $prescription = [
                'visit_id' => $visit->id,
                'diagnosis' => $this->input->post('diagnosis'),
                'medicines' => $this->input->post('medicines'),
                'date' => date('Y-m-d'),
            ];
            $this->Doctor_model->add_prescription($prescription);
    
            // Optional: Add selected tests
            $tests = $this->input->post('tests');
            if (!empty($tests)) {
                foreach ($tests as $test_id) {
                    $this->Doctor_model->add_test($visit->id, $test_id);
                }
            }
    
            $this->session->set_flashdata('success', 'Prescription saved.');
            redirect('doctor/view_patient/' . $patient_id);
        }
    
        $data['patient'] = $this->Patient_model->get_patient_by_id($patient_id);
        $data['visit'] = $visit;
        $data['tests'] = $this->Doctor_model->get_all_tests(); // for dropdown

        $data['page'] = 'doctor/prescribe';
        $this->load->view('doctor/layout', $data);
    }
    
    
    
    
}
