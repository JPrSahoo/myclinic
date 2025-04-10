<?php
require_once(APPPATH . 'third_party/vendor/autoload.php');


use Pusher\Pusher;

class Pusher_lib {
    protected $pusher;

    public function __construct() {
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );
        $this->pusher = new Pusher(
            '1fc4423c6cd58353dd58',
            'e6cc2e864d23c6236504',
            '1972766',
            $options
        );
    }

    public function trigger($channel, $event, $data) {
        $this->pusher->trigger($channel, $event, $data);
    }
}
