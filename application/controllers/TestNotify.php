<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestNotify extends CI_Controller {

    public function index() {
        $this->load->library('pusher_lib');

        $data['message'] = '🛎️ A new patient has been registered!';
        $this->pusher_lib->trigger('clinic-channel', 'new-notification', $data);

        echo "Notification triggered.";
    }
}
