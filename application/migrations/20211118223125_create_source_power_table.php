<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_source_power_table extends CI_Migration
{
    private $table = 'source_power';

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true
            ),
            'nama' => array(
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
