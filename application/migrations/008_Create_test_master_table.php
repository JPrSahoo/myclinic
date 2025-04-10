<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_test_master_table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => TRUE,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => FALSE,
                'default' => NULL // set manually later
            ],
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('test_master');

        // Set default CURRENT_TIMESTAMP for created_at
        $this->db->query("ALTER TABLE `test_master` MODIFY `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP");

        // Insert sample tests
        $this->db->insert_batch('test_master', [
            [
                'name' => 'Complete Blood Count (CBC)',
                'description' => 'Checks overall health and detects a variety of disorders.',
                'price' => 250.00,
            ],
            [
                'name' => 'Blood Sugar Test',
                'description' => 'Measures the amount of glucose in the blood.',
                'price' => 150.00,
            ],
            [
                'name' => 'X-Ray Chest',
                'description' => 'Imaging of the chest area to assess lung or heart conditions.',
                'price' => 500.00,
            ],
            [
                'name' => 'Urine Routine Test',
                'description' => 'Basic urine test for infections or kidney issues.',
                'price' => 120.00,
            ],
            [
                'name' => 'Lipid Profile',
                'description' => 'Measures total cholesterol, LDL, HDL, and triglycerides.',
                'price' => 600.00,
            ],
            [
                'name' => 'ECG',
                'description' => 'Electrocardiogram to check heart rhythm.',
                'price' => 300.00,
            ],
            [
                'name' => 'Thyroid Profile (T3, T4, TSH)',
                'description' => 'Evaluates thyroid gland function.',
                'price' => 700.00,
            ],
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('test_master');
    }
}
