<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_user_table extends CI_Migration
{
    private $table = 'user';

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'role' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'last_update' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
            'active' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => true,
                'default' => 1,
            ),
        ));
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table($this->table, true);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->table);
    }
}
