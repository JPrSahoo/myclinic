<?php
class Notification_model extends CI_Model {

    public function get_latest() {
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('notifications', 1);
        return $query->row();
    }
    public function get_new_after($last_id) {
        $this->db->where('id >', $last_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('notifications', 1); // Get only the first new one
        return $query->row();
    }

    public function get_unseen() {
        $this->db->where('seen', 0);
        $this->db->order_by('created_at', 'ASC');
        $query = $this->db->get('notifications', 1); // get the oldest unseen one
        return $query->row();
    }
    
    public function mark_as_seen($id) {
        $this->db->where('id', $id);
        $this->db->update('notifications', ['seen' => 1, 'seen_at' => date('Y-m-d H:i:s')]);
    }
    
    

    public function add($message) {
        $data = [
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('notifications', $data);
    }
}
