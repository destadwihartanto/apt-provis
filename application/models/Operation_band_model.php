<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Operation_band_model extends CI_Model
{
    private $table = 'operation_band';

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
}
