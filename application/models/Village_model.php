<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Village_model extends CI_Model
{
    private $table = 'reg_villages';

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
}
