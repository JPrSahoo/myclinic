<?php
class Doctor_model extends CI_Model {
    // public function get_patient_visits($patient_id) {
    //     return $this->db->get_where('patient_visits', ['patient_id' => $patient_id])->result();
    // }

    public function get_patient_visits($patient_id) {
        $this->db->select('v.*, d.name as department_name');
        $this->db->from('patient_visits v');
        $this->db->join('departments d', 'd.id = v.department_id', 'left');
        $this->db->where('v.patient_id', $patient_id);
        return $this->db->get()->result();
    }
    
    
    public function get_patient_prescriptions($patient_id) {
        $this->db->select('p.*');
        $this->db->from('prescriptions p');
        $this->db->join('patient_visits v', 'v.id = p.visit_id');
        $this->db->where('v.patient_id', $patient_id);
        return $this->db->get()->result();
    }
    
    
    public function get_patient_tests($patient_id) {
        $this->db->select('t.*, tm.name as test_name');
        $this->db->from('patient_tests t');
        $this->db->join('patient_visits v', 'v.id = t.visit_id');
        $this->db->join('test_master tm', 'tm.id = t.test_id', 'left');
        $this->db->where('v.patient_id', $patient_id);
        return $this->db->get()->result();
    }
    
}