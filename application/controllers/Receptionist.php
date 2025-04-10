<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receptionist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Patient_model');
        // $this->load->helper(array('form', 'url'));
        $this->load->model('Notification_model');
        $this->load->library('pusher_lib');

        // if ($this->session->userdata('role') !== 'receptionist') {
        //     redirect('login');
        // }
    }
    public function index() { 
        $data['title'] = 'Receptionist Dashboard';
        $data['page_title'] = 'Welcome, Receptionist';

        // Load receptionist dashboard view
        $data['page'] = 'receptionist/dashboard';
        $this->load->view('receptionist/layout', $data);
    }

    public function register_patient() {
        //$this->Notification_model->add('New patient registered: Tapas');
        if ($this->input->post()) {
            $data = array(
                'name' => $this->input->post('name'),
                'age' => $this->input->post('age'),
                'gender' => $this->input->post('gender'),
                'contact' => $this->input->post('contact'),
                'address' => $this->input->post('address')
            );

            $symptoms = $this->input->post('symptoms');
            $department_id = $this->input->post('dept_id');
            $doctor_id = $this->input->post('doctor_id');

            $patient_id = $this->Patient_model->insert_patient($data);
            $this->Patient_model->create_visit($patient_id, $department_id, $doctor_id, $symptoms);

            $data['message'] = 'New patient registered!';
            $this->pusher_lib->trigger('clinic-channel', 'new-notification', $data);

            $this->session->set_flashdata('success', 'Patient registered successfully.');

            redirect('receptionist/register_patient');
        }

        $data['departments'] = $this->Patient_model->get_departments();
        $data['page'] = 'receptionist/register_patient';
        $this->load->view('receptionist/layout', $data);
    }
    
}
