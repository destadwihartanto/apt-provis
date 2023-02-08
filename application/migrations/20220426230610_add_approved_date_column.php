<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_approved_date_column extends CI_Migration
{
    private $table = 'xpoles';

    public function up()
    {
        $data = $this->set_attributes();
        foreach ($data as $key => $value) {
            if (! $this->db->field_exists($value['column_name'], $this->table)) {
                $fields = array($value['column_name'] => array(
                    'type' => $value['type'],
                    'constraint' => $value['constraint'],
                    'null' => $value['null'],
                    'default' => $value['default'],
                    'after' => $value['after'],
                ));
                $this->dbforge->add_column($this->table, $fields);
            }
        }
    }

    public function down()
    {
        $data = $this->set_attributes();
        foreach ($data as $key => $value) {
            if ($this->db->field_exists($value['column_name'], $this->table)) {
                $this->dbforge->drop_column($this->table, $value['column_name']);
            }
        }
    }

    private function set_attributes()
    {
        $data[] = array(
            'column_name' => 'approved_at',
            'type' => 'DATETIME',
            'constraint' => null,
            'null' => true,
            'default' => null,
            'after' => null,
        );
        return $data;
    }
}
