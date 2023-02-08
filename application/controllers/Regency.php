<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Regency extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
    }


    public function show_dropdown()
    {
        $province_id = $this->input->post('province_id');
        $data = [
            'type' => 'regency_id',
            'query' => $this->regency_model->get_by_condition(['province_id' => $province_id]),
        ];
        $this->load->view('dropdown/v_administration', $data);
    }
}
