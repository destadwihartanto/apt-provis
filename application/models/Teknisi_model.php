<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Teknisi_model extends CI_Model
{
    private $table = 'teknisi';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_condition($where = [])
    {
        $this->db->select('t.id id,t.nama technician_name, IF(t.active=1, "Active", "Inactive") active, company, telepon, u.id user_id');
        $this->db->from($this->table . ' t');
        $this->db->join('users u', 'u.id = t.user_id', 'left');
        $this->db->order_by('technician_name', 'ASC');
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        return $this->db->get()->result_array();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id = null, $data = [])
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id = null)
    {
        $this->db->delete($this->table, array('id' => $id));
    }
}
