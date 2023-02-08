<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Xpole_model extends CI_Model
{
    private $table = 'xpoles';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_condition($where = [])
    {
        $this->db->order_by('site_id');
        $query = $this->db->get_where($this->table, $where);
        return $query->result_array();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function show_table($where)
    {
        $this->db->select('x.id id,s.nama_kontrak nama_site, x.status status, company, x.last_update,notes');
        $this->db->from($this->table.' x');
        $this->db->join('site s', 's.id = x.site_id', 'left');
        $this->db->join('users u', 'u.id = s.user_id', 'left');
        $this->db->order_by('x.last_update', 'DESC');
        
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        return $this->db->get()->result_array();
    }

    // open
    public function show_table_open($where)
    {
        $this->db->select('x.id id,s.nama_kontrak nama_site, x.status status, company, x.last_update,notes');
        $this->db->from($this->table.' x');
        $this->db->where('x.status', 'open');
        $this->db->join('site s', 's.id = x.site_id', 'left');
        $this->db->join('users u', 'u.id = s.user_id', 'left');
        $this->db->order_by('x.last_update', 'DESC');
        
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        return $this->db->get()->result_array();
    }


     // approve
     public function show_table_approve($where)
     {
         $this->db->select('x.id id,s.nama_kontrak nama_site, x.status status, company, x.last_update,notes');
         $this->db->from($this->table.' x');
         $this->db->where('x.status', 'approve');
         $this->db->join('site s', 's.id = x.site_id', 'left');
         $this->db->join('users u', 'u.id = s.user_id', 'left');
         $this->db->order_by('x.last_update', 'DESC');
         
         foreach ($where as $key => $value) {
             $this->db->where($key, $value);
         }
         return $this->db->get()->result_array();
     }


    public function get_where($where = [])
    {
        $this->db->select('x.*,s.nama_kontrak nama_site,t.nama nama_teknisi,telepon');
        $this->db->from('xpoles x');
        $this->db->join('site s', 's.id = x.site_id', 'left');
        $this->db->join('teknisi t', 't.id = x.teknisi_id', 'left');
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get();
        return $query->result_array();
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
