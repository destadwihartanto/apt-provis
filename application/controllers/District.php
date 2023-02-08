<?php
defined('BASEPATH') or exit('No direct script access allowed');

class District extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
    }

    public function show_dropdown()
    {
        $regency_id = $this->input->post('regency_id');
        $data = [
            'type' => 'district_id',
            'query' => $this->district_model->get_by_condition(['regency_id' => $regency_id]),
        ];
        $this->load->view('dropdown/v_administration', $data);
    }
}
