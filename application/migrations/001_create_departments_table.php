<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_departments_table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('departments');

        $this->db->insert_batch('departments', [
            [
                'id' => 1,
                'name' => 'Liver & Gastro'
            ],
            [
                'id' => 2,
                'name' => 'General Medicine'
            ],
            [
                'id' => 3,
                'name' => 'Pediatrics'
            ],
            [
                'id' => 4,
                'name' => 'Orthopedics'
            ],
            [
                'id' => 5,
                'name' => 'Dermatology'
            ]
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('departments');
    }
}
