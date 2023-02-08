<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_district extends CI_Migration
{
    private $table = 'reg_districts';

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'VARCHAR',
                'constraint' => 8,
                // 'unsigned' => true,
                // 'auto_increment' => true
            ),
            'regency_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'last_update' => array(
                'type' => 'DATETIME',
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
