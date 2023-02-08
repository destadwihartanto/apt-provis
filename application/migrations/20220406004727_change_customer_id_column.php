<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Change_customer_id_column extends CI_Migration
{
    private $table = 'site';

    public function up()
    {
        $fields = array('customer_id' => array('name' => 'user_id','type' => 'INT',),
    );
        $this->dbforge->modify_column($this->table, $fields);
    }

    public function down()
    {
        $fields = array(
            'user_id' => array(
                    'name' => 'customer_id',
                    'type' => 'INT',
            ),
    );
        $this->dbforge->modify_column($this->table, $fields);
    }
}
