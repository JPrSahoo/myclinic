<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users_table extends CI_Migration {

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
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'mobile' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'role' => [
                'type' => "ENUM('admin','receptionist','doctor','lab','pharmacy')",
                'null' => FALSE,
            ],
            'department_id' => [
                'type'       => 'INT',
                'null'       => TRUE,
                'default'    => NULL
            ],
            'specialization' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');

        $this->db->query("ALTER TABLE `users` ADD `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP");

        // Insert multiple default users
        $this->db->insert_batch('users', [
            [
                'name' => 'jagadish prasad',
                'email' => 'jp@gmail.com',
                'username' => 'admin',
                'password' => password_hash('123456', PASSWORD_BCRYPT),
                'mobile' => '1234567898',
                'role'     => 'admin',
                'department_id' => NULL,
                'specialization' => NULL
            ],
            [
                'name' => 'Dr. Satyaprakshray Choudhury',
                'email' => 'choudhurysatyaprakshray@gmail.com',
                'username' => 'admin',
                'password' => password_hash('123456', PASSWORD_BCRYPT),
                'mobile' => '1234567898',
                'role'     => 'doctor',
                'department_id' => 1,
                'specialization' => 'Liver & Gastro'
            ],
            [
                'name' => 'Satyajit',
                'email' => 'xyz@gmail.com',
                'username' => 'receptionist',
                'password' => password_hash('123456', PASSWORD_BCRYPT),
                'mobile' => '1234567898',
                'role'     => 'receptionist',
                'department_id' => NULL,
                'specialization' => NULL
            ]
        ]);

    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}
