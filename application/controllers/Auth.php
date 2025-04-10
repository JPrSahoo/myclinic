<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
    }

    public function login() {
        if ($this->session->userdata('logged_in')) {
            $this->_redirect_by_role($this->session->userdata('role'));
        }

        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password'); 
            //$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT); 


            $user = $this->User_model->check_login($username, $password); 

            if ($user) {
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role,
                    'logged_in' => TRUE
                ]);
                $this->_redirect_by_role($user->role);
            } else {
                $data['error'] = "Invalid username or password.";
            }
        }

        $this->load->view('auth/login', isset($data) ? $data : NULL);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    private function _redirect_by_role($role) {
        switch ($role) {
            case 'receptionist': redirect('receptionist'); break;
            case 'doctor':       redirect('doctor'); break;
            case 'lab':          redirect('lab'); break;
            case 'pharmacy':     redirect('pharmacy'); break;
            case 'admin':        redirect('admin'); break;
            default:             redirect('login');
        }
    }
}
