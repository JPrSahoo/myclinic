<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_patient_visits_table extends CI_Migration {

    public function up()
    {
        // Create the table without visit_date
        $this->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
            ],
            'patient_id' => [
                'type'     => 'INT',
                'unsigned' => TRUE,
            ],
            'department_id' => [
                'type'     => 'INT',
                'unsigned' => TRUE,
            ],
            'doctor_id' => [
                'type'     => 'INT',
                'unsigned' => TRUE,
            ],
            'symptoms' => [
                'type' => 'TEXT',
            ],
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('patient_visits');

        // Add visit_date with default CURRENT_TIMESTAMP using raw query
        $this->db->query("ALTER TABLE `patient_visits` ADD `visit_date` DATETIME DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->dbforge->drop_table('patient_visits');
    }
}
