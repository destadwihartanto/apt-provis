<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_group_model extends CI_Model
{
    private $table = 'users_groups';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_condition($where = [])
    {
        $this->db->select('user_id, group_id, ug.id id, company');
        $this->db->from($this->table . ' ug');
        $this->db->join('users u', 'u.id = ug.user_id', 'left');
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
}
