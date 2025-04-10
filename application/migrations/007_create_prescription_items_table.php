<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_prescription_items_table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
            ],
            'prescription_id' => [
                'type'     => 'INT',
                'unsigned' => TRUE,
                'null'     => FALSE,
            ],
            'type' => [
                'type'    => "ENUM('medicine','test')",
                'null'    => FALSE,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => FALSE,
            ],
            'dosage' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => TRUE,
            ],
            'duration' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => TRUE,
            ],
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('prescription_items');
    }

    public function down()
    {
        $this->dbforge->drop_table('prescription_items');
    }
}
