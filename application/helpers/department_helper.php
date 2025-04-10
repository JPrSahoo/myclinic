<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_departments')) {
    function get_departments() {
        $CI =& get_instance();
        $CI->load->model('Department_model'); 
        return $CI->Department_model->get_departments();
    }
}
