<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard_model extends CI_Model
{

    public function GetApprove()
	{
		$this->db->select('*');
		$this->db->from('xpoles');
		$this->db->where('status', 'approve');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

    public function GetOpen()
	{
		$this->db->select('*');
		$this->db->from('xpoles');
		$this->db->where('status', 'open');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

    public function GetBelumXpole()
	{
		$this->db->select('*');
		$this->db->from('site');
		$this->db->where('status', '');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}


    public function GetTeknisi()
	{
		// $this->db->select('*');
		// $this->db->from('teknisi');
		// $this->db->where('status_approval_kedua', 'Ditolak');
		$query = $this->db->get('teknisi');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

    public function GetUsers()
	{
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

    public function GetVendor()
	{
		$query = $this->db->get('vendor');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

    public function GetPIC()
	{
		$query = $this->db->get('pic_provider');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

    public function GetSite()
	{
		$query = $this->db->get('site');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}





}
