<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'query' => $this->setup_query(),
            'content' => 'template/v_dashboard',
            'nav_link' => 'dashboard',
        ];
        $this->load->view('template/layout', $data);
    }

    private function setup_query()
    {
       $query = $this->site_model->dashboard();
       foreach ($query as $key => $value) {
            if ($value['status'] == NULL) {
                $query[$key]['status'] = 'Belum Xpole';
                $query[$key]['class'] = 'bg-danger';
                $query[$key]['icon'] = 'fas fa-solid fa-list';
            } elseif ($value['status'] == 'approve') {
                $query[$key]['status'] = 'Approve';
                $query[$key]['class'] = 'bg-success';
                $query[$key]['icon'] = 'fas fa-solid fa-check';
                
               
            } elseif ($value['status'] == 'open') {
                $query[$key]['status'] = 'Open';
                $query[$key]['class'] = 'bg-warning';
                $query[$key]['icon'] = 'fas fa-solid fa-lock-open';
                
            }
       }
       return $query;
    }
}
