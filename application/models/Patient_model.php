<?php
class Patient_model extends CI_Model {

    public function insert_patient($data) {
        $this->db->insert('patients', $data);
        return $this->db->insert_id();
    }

    public function create_visit($patient_id, $department_id, $doctor_id, $symptoms) {
        $visit = array(
            'patient_id' => $patient_id,
            'department_id' => $department_id,
            'doctor_id' => $doctor_id,
            'symptoms' => $symptoms
        );
        $this->db->insert('patient_visits', $visit);
    }

    public function get_departments() {
        return $this->db->get('departments')->result();
    }
}
