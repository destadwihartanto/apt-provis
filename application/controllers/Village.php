<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Village extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
    }

    public function show_dropdown()
    {
        $district_id = $this->input->post('district_id');
        $data = [
            'type' => 'village_id',
            'query' => $this->village_model->get_by_condition(['district_id' => $district_id]),
        ];
        $this->load->view('dropdown/v_administration', $data);
    }

    public function index()
    {
    }
}
