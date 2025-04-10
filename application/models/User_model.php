<?php
class User_model extends CI_Model {

    public function check_login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        $user = $query->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }
    public function get_all_doctors() {
        return $this->db->get_where('users', ['role' => 'doctor'])->result();
    } 
    public function get_doctors_by_department($dept_id) {
        return $this->db
                    ->where('role', 'doctor')
                    ->where('department_id', $dept_id)
                    ->get('users')
                    ->result();
    }
       
}
