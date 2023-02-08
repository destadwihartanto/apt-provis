<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Group_model extends CI_Model
{
    private $table = 'groups';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_group($where = [])
    {
        $this->db->select('company, user_id');
        $this->db->from('users_groups ug');
        $this->db->join('users u', 'u.id = ug.user_id', 'left');
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get();
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
}
