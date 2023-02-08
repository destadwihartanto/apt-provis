<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_xpole_table extends CI_Migration
{
    private $table = 'xpoles';

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true
            ),
            'site_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'penyedia_jasa_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'default' => null,
            ),
            'phone_number' => array(
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'default' => null,
            ),
            'url_img_first_modem' => array(
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'default' => null,
            ),
            'url_img_second_modem' => array(
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'default' => null,
            ),
            'url_img_xpole' => array(
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'default' => null,
            ),
            'url_img_speedtest' => array(
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'default' => null,
            ),
            'notes' => array(
                'type' => 'TEXT',
                'null' => true,
                'default' => null,
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
