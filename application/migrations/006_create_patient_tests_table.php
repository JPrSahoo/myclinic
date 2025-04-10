<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_patient_tests_table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
            ],
            'visit_id' => [
                'type'     => 'INT',
                'unsigned' => TRUE,
            ],
            'test_id' => [
                'type'       => 'INT',
                'unsigned' => TRUE,
                'null'     => FALSE,
            ],
            'result' => [
                'type' => 'TEXT',
            ],
            'status' => [
                'type'    => "ENUM('pending','completed')",
                'default' => 'pending',
                'null'    => FALSE,
            ],
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('patient_tests');
    }

    public function down()
    {
        $this->dbforge->drop_table('patient_tests');
    }
}
