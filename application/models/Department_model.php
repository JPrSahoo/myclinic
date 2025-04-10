<?php
class Department_model extends CI_Model {
    public function get_departments() {
        return $this->db->get('departments')->result();
    }
}