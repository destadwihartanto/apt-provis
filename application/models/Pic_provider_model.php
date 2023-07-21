<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pic_provider_model extends CI_Model
{
    private $table = 'pic_provider';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_condition($where = [])
    {
        $this->db->order_by('nama');
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


    public function delete($id)
    {
        $this->db->delete($this->table, array('id' => $id));
    }
}
