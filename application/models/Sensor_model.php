<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sensor_model extends CI_Model
{
    private $table = 'sensors';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_condition($where = [])
    {
        $this->db->order_by('name');
        $query = $this->db->get_where($this->table, $where);
        return $query->result_array();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id = 0, $data = [])
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function get_all()
    {
        $query = $this->db->select('s.id id,s.name name, graphite_name, t.name type, oid, s.name created_date, IF(s.active = 1,"Active","Inactive") status, DATE_FORMAT(s.last_update, "%d %M %Y %H:%i") AS last_update')
        ->from("sensors s")
        ->join('types t', 't.id = s.type_id', 'left')
        ->order_by("name")
        ->get();
        return $query->result_array();
    }

    public function get_sensors($where = [])
    {
        $this->db->order_by('name');
        $query = $this->db->get_where($this->table, $where);
        $sql = $query->result_array();
        $data = [];
        foreach ($sql as $key) {
            $data[] = $key['graphite_name'];
        }
        return $data;
    }
}
