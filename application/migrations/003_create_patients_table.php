<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_patients_table extends CI_Migration {

    public function up()
    {
        // Create table without 'registered_at'
        $this->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'age' => [
                'type' => 'INT',
            ],
            'gender' => [
                'type' => "ENUM('male','female','other')",
                'null' => FALSE,
            ],
            'contact' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'address' => [
                'type' => 'TEXT',
            ],
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('patients');

        // Add 'registered_at' with raw SQL (supports CURRENT_TIMESTAMP)
        $this->db->query("ALTER TABLE `patients` ADD `registered_at` DATETIME DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->dbforge->drop_table('patients');
    }
}
