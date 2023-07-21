<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('dashboard_model');

    }




    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'query' => $this->setup_query(),
            'content' => 'template/v_dashboard',
            'nav_link' => 'dashboard',
            
        ];
        $data['jml_teknisi'] = $this->dashboard_model->GetTeknisi();
        $data['jml_users'] = $this->dashboard_model->GetUsers();
        $data['jml_vendor'] = $this->dashboard_model->GetVendor();
        $data['jml_pic_vendor'] = $this->dashboard_model->GetPIC();
        //chart baris satu
        $data['jml_approve'] = $this->dashboard_model->GetApprove();
        $data['jml_open'] = $this->dashboard_model->GetOpen();
        $data['jml_site'] = $this->dashboard_model->GetSite();
        $data['jml_belum_xpole'] = $this->dashboard_model->GetBelumXpole();

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
            }
             elseif ($value['status'] == 'approve') {
                $query[$key]['class'] = 'bg-success';
                $query[$key]['icon'] = 'fas fa-solid fa-check';
            } elseif ($value['status'] == 'open') {
                $query[$key]['class'] = 'bg-warning';
                $query[$key]['icon'] = 'fas fa-solid fa-lock-open';
            }
        }
        return $query;
    }
}
