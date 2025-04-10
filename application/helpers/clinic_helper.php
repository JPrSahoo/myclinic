<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_departments')) {
    function get_departments() {
        $CI =& get_instance();
        $CI->load->model('Department_model');
        return $CI->Department_model->get_departments();
    }
}

if (!function_exists('get_doctors')) {
    function get_doctors() {
        $CI =& get_instance();
        $CI->load->model('User_model');
        return $CI->User_model->get_all_doctors();
    }
}

if (!function_exists('get_doctors_by_department')) {
    function get_doctors_by_department($department_id) {
        $CI =& get_instance();
        $CI->load->model('User_model');
        return $CI->User_model->get_doctors_by_department($department_id);
    }
}
