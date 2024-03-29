<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Remove_latitude_column extends CI_Migration
{
    private $table = 'site';

    public function up()
    {
        $data = $this->set_attributes();
        foreach ($data as $key => $value) {
            if ($this->db->field_exists($value['column_name'], $this->table)) {
                $this->dbforge->drop_column($this->table, $value['column_name']);
            }
        }
    }

    public function down()
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

    private function set_attributes()
    {
        $data[] = array(
            'column_name' => 'latitude',
            'type' => 'VARCHAR',
            'constraint' => 100,
            'null' => true,
            'default' => null,
            'after' => null,
        );

        $data[] = array(
            'column_name' => 'longitude',
            'type' => 'VARCHAR',
            'constraint' => 100,
            'null' => true,
            'default' => null,
            'after' => null,
        );

        $data[] = array(
            'column_name' => 'nama',
            'type' => 'VARCHAR',
            'constraint' => 250,
            'null' => true,
            'default' => null,
            'after' => null,
        );

        $data[] = array(
            'column_name' => 'nama_router',
            'type' => 'VARCHAR',
            'constraint' => 250,
            'null' => true,
            'default' => null,
            'after' => null,
        );
        return $data;
    }
}
