<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
    }

    public function index()
    {
        $where = [];
        if (!$this->ion_auth->is_admin() && !is_noc()) {
            $where = ['u.id' => $this->ion_auth->get_user_id()];
        }

        $data = [
            'title' => 'List Lokasi',
            'query' => $this->site_model->show_table($where),
            'content' => 'site/v_index',
            'rows' => $this->SetTableRows(),
            'nav_link' => 'site',
        ];
        $this->load->view('template/layout', $data);
    }

    public function delete($encode_id = null)
    {
        $query = $this->get_detail($encode_id);
        $this->check_before_action($query['user_id']);
        $this->site_model->delete($query['id']);
        $this->session->set_flashdata('alert_icon', 'success');
        $this->session->set_flashdata('alert_message', 'Data Site Berhasil Dihapus');
        redirect('site/index', 'refresh');
    }

    public function detail($encode_id = null)
    {
        $data = [
            'title' => 'Detail Lokasi',
            'query' => $this->get_detail($encode_id),
            'content' => 'site/v_detail',
            'nav_link' => 'site',
        ];
        $this->load->view('template/layout', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules($this->SetParams());
        $this->form_validation->set_rules('village_id', 'Nama Desa', 'required');
        if ($this->form_validation->run() == false) {
            if (!$this->ion_auth->is_admin() && !is_noc()) {
                $query = $this->ion_auth->user()->row_array();
            }

            $data = [
                'title' => 'Tambah Lokasi',
                'content' => 'site/v_create',
                'is_admin' => $this->ion_auth->is_admin() || is_noc(),
                'company' => $query['company'] ?? false,
                'nav_link' => 'site',
                'provinces' => $this->province_model->get_by_condition(),
                'inputs' => $this->SetParams(),
            ];
            $this->load->view('template/layout', $data);
        } else {
            $data = $this->input->post();
            $data['created_at'] = date('Y-m-d H:i:s');
            unset($data['province_id'], $data['regency_id'], $data['district_id']);
            $this->site_model->save($data);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data site berhasil ditambah');
            redirect('site/index');
        }
    }

    public function update($encode_id = null)
    {
        $query = $this->get_detail($encode_id);
        $this->check_before_action($query['user_id']);
        $this->form_validation->set_rules($this->SetParams());
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Update Lokasi',
                'inputs' => $this->SetParams(),
                'content' => 'site/v_update',
                'nav_link' => 'site',
                'encode_id' => $encode_id,
                'query' => $query,
                'dropdown_status' => get_status_site(),
                'dropdown_users' => get_general_users(),
                'dropdown_providers' => $this->pic_provider_model->get_by_condition(['active' => 1]),
                'dropdown_vendors' => $this->vendor_model->get_by_condition(['active' => 1]),
                'dropdown_programs' => $this->program_model->get_by_condition(['active' => 1]),
                'dropdown_lc' => $this->penyedia_model->get_by_condition(),
                'dropdown_power' => $this->source_power_model->get_by_condition(['active' => 1]),
                'dropdown_band' => $this->operation_band_model->get_by_condition(['active' => 1]),
                'dropdown_beam' => $this->spotbeam_model->get_by_condition(['active' => 1]),
                'dropdown_satelit' => $this->satelit_model->get_by_condition(['active' => 1]),
                'dropdown_dish' => $this->dish_model->get_by_condition(['active' => 1]),
                'is_admin' => $this->ion_auth->is_admin() || is_noc(),
                'provinces' => $this->province_model->get_by_condition(),
                'regencies' => $this->regency_model->get_by_condition(['province_id' => $query['province_id']]),
                'districts' => $this->district_model->get_by_condition(['regency_id' => $query['regency_id']]),
                'villages' => $this->village_model->get_by_condition(['district_id' => $query['district_id']]),
            ];
            $this->load->view('template/layout', $data);
        } else {
            $data = $this->input->post();
            unset($data['province_id'], $data['regency_id'], $data['district_id']);
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($data['status'] == 'Registered') {
                $data['registered_at'] = date('Y-m-d H:i:s');
            }

            $this->site_model->update($query['id'], $data);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data site berhasil diubah');
            redirect('site/index');
        }
    }

    private function check_before_action($user_id = null)
    {
        $is_admin = $this->ion_auth->is_admin() || is_noc();
        $valid_user = $this->ion_auth->user()->row()->id == $user_id;

        if ($is_admin) {
            return true;
        }

        if (!$is_admin && $valid_user) {
            return true;
        }
        $this->session->set_flashdata('alert_icon', 'warning');
        $this->session->set_flashdata('alert_message', 'Anda Tidak Punya Hak Akses');
        redirect('site/index');
    }

    private function get_detail($encode_id = null)
    {
        $id = base64_decode($encode_id);
        $query = $this->site_model->get_detail(['s.id' => $id]);

        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data site tidak ditemukan');
            redirect('site/index');
        } else {
            return $query[0];
        }
    }

    private function SetTableRows()
    {
        $rows = [
           
            'Site ID',
            'Site Name',
            'Status Site',
            'Status Xpole',
            'Company',
            'Aksi',
        ];
        return $rows;
    }

    private function SetParams()
    {
        $config = [
            array(
                'category' => 'text',
                'field' => 'sid',
                'label' => 'Site ID',
                // 'rules' => 'required|is_unique[site.sid]'
                'rules' => 'required'
            ),
            array(
                'category' => 'text',
                'field' => 'nama_kontrak',
                'label' => 'Site Name',
                'rules' => 'required'
            ),
            array(
                'category' => 'dropdown_status',
                'field' => 'status',
                'label' => 'Status Site',
                'options' => get_status_site(),
                'rules' => 'required'
            ),
            array(
                'category' => 'dropdown_user',
                'field' => 'user_id',
                'label' => 'Nama Customer',
                'user_id' => $this->ion_auth->get_user_id(),
                'options' => $this->group_model->get_user_group(['group_id' => 2]), // tampilkan hanya general user
                'rules' => 'required|integer'
            ),
            array(
                'category' => 'text',
                'field' => 'ip_modem',
                'label' => 'IP Modem',
                // 'rules' => 'required|valid_ip'
            ),
            array(
                'category' => 'text',
                'field' => 'ip_mikrotik',
                'label' => 'IP Mikrotik',
                // 'rules' => 'required|valid_ip'
            ),
            array(
                'category' => 'text',
                'field' => 'ip_router',
                'label' => 'IP Router',
                // 'rules' => 'required|valid_ip'
            ),
            array(
                'category' => 'text',
                'field' => 'airmac_modem',
                'label' => 'Airmac Modem',
                // 'rules' => 'required',
            ),
            array(
                'category' => 'text',
                'field' => 'vlan_oam_mikrotik',
                'label' => 'VLAN Oam Mikrotik',
                // 'rules' => 'required',
            ),
            array(
                'category' => 'text',
                'field' => 'vlan_oam_nodeb',
                'label' => 'VLAN Oam e nodeB',
                // 'rules' => 'required',
            ),
            array(
                'category' => 'text',
                'field' => 'vlan_oam_cctv',
                'label' => 'VLAN Oam CCTV',
                // 'rules' => 'required',
            ),
            array(
                'category' => 'text',
                'field' => 'vlan_oam_power',
                'label' => 'VLAN Oam Power',
                // 'rules' => 'required',
            ),
            array(
                'category' => 'text',
                'field' => 'vlan_s1c',
                'label' => 'VLAN s1-C',
                // 'rules' => 'required',
            ),
            array(
                'category' => 'text',
                'field' => 'vlan_s1u',
                'label' => 'VLAN s1-U',
                // 'rules' => 'required',
            ),
            array(
                'category' => 'text',
                'field' => 'snmp_community',
                'label' => 'Community String SNMP Router dan AP',
                // 'rules' => 'required'
            ),
            array(
                'category' => 'text',
                'field' => 'batch',
                'label' => 'Batch',
                'rules' => 'required'
            ),
            array(
                'category' => 'text',
                'field' => 'nama_pic_lokasi',
                'label' => 'Nama PIC Lokasi',
                'rules' => 'required'
            ),
            array(
                'category' => 'text',
                'field' => 'telp_pic_lokasi',
                'label' => 'Telepon PIC Lokasi',
                'rules' => 'required'
            ),
            array(
                'category' => 'text',
                'field' => 'latitude',
                'label' => 'Latitude',
                'rules' => 'required'
            ),
            array(
                'category' => 'text',
                'field' => 'longitude',
                'label' => 'Longitude',
                'rules' => 'required'
            ),
            array(
                'category' => 'option',
                'options' => $this->pic_provider_model->get_by_condition(['active' => 1]),
                'field' => 'pic_penyedia_id',
                'label' => 'PIC Penyedia',
                'rules' => 'required',
            ),
            array(
                'category' => 'option',
                'options' => $this->vendor_model->get_by_condition(['active' => 1]),
                'field' => 'vendor_id',
                'label' => 'Nama Vendor',
                'rules' => 'required',
            ),
            array(
                'category' => 'option',
                'options' => $this->program_model->get_by_condition(['active' => 1]),
                'field' => 'program_id',
                'label' => 'Nama Program',
                'rules' => 'required',
            ),
            array(
                'category' => 'option',
                'options' => $this->penyedia_model->get_by_condition(),
                'field' => 'penyedia_lc_id',
                'label' => 'Penyedia LC',
                'rules' => 'required',
            ),
            array(
                'category' => 'option',
                'options' => $this->source_power_model->get_by_condition(['active' => 1]),
                'field' => 'source_power_id',
                'label' => 'Sumber Listrik Utama',
                'rules' => 'required',
            ),
            array(
                'category' => 'option',
                'options' => $this->operation_band_model->get_by_condition(['active' => 1]),
                'field' => 'operation_band_id',
                'label' => 'Operation Band VSAT',
                'rules' => 'required',
            ),
            array(
                'category' => 'option',
                'options' => $this->spotbeam_model->get_by_condition(['active' => 1]),
                'field' => 'spotbeam_id',
                'label' => 'Beam',
                'rules' => 'required',
            ),
            array(
                'category' => 'option',
                'options' => $this->satelit_model->get_by_condition(['active' => 1]),
                'field' => 'satelit_id',
                'label' => 'Satelit',
                'rules' => 'required',
            ),
            array(
                'category' => 'option',
                'options' => $this->dish_model->get_by_condition(['active' => 1]),
                'field' => 'dish_id',
                'label' => 'Dish',
                'rules' => 'required',
            ),
            array(
                'category' => 'date',
                'field' => 'operational_date',
                'label' => 'Tanggal Integrasi',
                'rules' => 'required',
            ),
        ];

        return $config;
    }

    public function show_dropdown()
    {
        $user_id = $this->input->post('user_id');
        $data = [
            'type' => 'user_id',
            'query' => $this->site_model->get_by_condition(['user_id' => $user_id]),
        ];
        $this->load->view('dropdown/v_site', $data);
    }
}
