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
    public function get_prescriptions_by_visit($visit_id) {
        return $this->db->get_where('prescriptions', ['visit_id' => $visit_id])->result();
    }
    
    public function get_tests_by_visit($visit_id) {
        $this->db->select('pt.*, tm.name as test_name');
        $this->db->from('patient_tests pt');
        $this->db->join('test_master tm', 'tm.id = pt.test_id', 'left');
        $this->db->where('pt.visit_id', $visit_id);
        return $this->db->get()->result();
    }
    public function get_latest_visit($patient_id) {
        $this->db->where('patient_id', $patient_id);
        $this->db->order_by('visit_date', 'DESC');
        $this->db->limit(1);
        return $this->db->get('patient_visits')->row();
    }
    
    public function add_prescription($data) {
        return $this->db->insert('prescriptions', $data);
    }
    
    public function add_test($visit_id, $test_id) {
        return $this->db->insert('patient_tests', [
            'visit_id' => $visit_id,
            'test_id' => $test_id,
            'test_date' => date('Y-m-d')
        ]);
    }
    
    public function get_all_tests() {
        return $this->db->get('test_master')->result();
    }
    
    
}