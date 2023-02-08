<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_regency extends CI_Migration
{
    private $table = 'reg_regencies';

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'VARCHAR',
                'constraint' => 5,
                // 'unsigned' => true,
                // 'auto_increment' => true
            ),
            'province_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 8,
                'null' => true,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
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
