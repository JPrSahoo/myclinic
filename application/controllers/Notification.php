<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Notification_model');
    }

    public function stream() {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
    
        $notification = $this->Notification_model->get_unseen();
    
        if ($notification) {
            // Mark it as seen so it won’t be sent again
            $this->Notification_model->mark_as_seen($notification->id);
            echo "data: " . json_encode($notification) . "\n\n";
        } else {
            echo "data: \n\n";
        }
    
        ob_flush();
        flush();
    }
    
    
}
