<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_prescriptions_table extends CI_Migration {

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
            'medicine_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'dosage' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'instructions' => [
                'type' => 'TEXT',
            ],
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('prescriptions');
    }

    public function down()
    {
        $this->dbforge->drop_table('prescriptions');
    }
}
