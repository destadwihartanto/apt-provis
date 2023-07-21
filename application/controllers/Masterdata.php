<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterdata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
    }

    public function index()
    {
        $where = [];
        if (!$this->ion_auth->is_admin()) {
            $where = ['user_id' => $this->ion_auth->get_user_id()];
        }

        $data = [
            'title' => 'List PIC',
            'nav_link' => 'pic_penyedia',
            'content' => 'master/index_pic_penyedia',
            'query' => $this->pic_provider_model->get_by_condition($where),
            'rows' => $this->SetTableRows(),
        ];
        $this->load->view('template/layout', $data);
    }

    private function SetTableRows()
    {
        $rows = [
            'Nama',
            'Telepon',
            'Status',
            'Aksi'
        ];
        return $rows;
    }

    public function create()

    {
        $this->form_validation->set_rules($this->SetValidations());
        if ($this->form_validation->run() == false) {
            $customers = $this->user_group_model->get_by_condition(['group_id !=' => 1]); // show only member & NOC
            $data = [
                'title' => 'Tambah Data pic penyedia',
                'nav_link' => 'master',
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'customers' => $customers,
                'content' => 'master/create_pic_penyedia',
            ];
            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            $post['last_update'] = date('Y-m-d H:i:s');
            $post['active'] = 1;

            $this->pic_provider_model->save($post);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data pic berhasil ditambah');
            redirect('masterdata/index');
        }
    }

    private function SetValidations()
    {
        $config = [
            array(
                'field' => 'nama',
                'label' => 'Nama Teknisi',
                'rules' => 'required|min_length[3]',
            ),
            array(
                'field' => 'telephone',
                'label' => 'Nomor telephone',
                'rules' => 'required|min_length[3]'
            ),
        ];

        return $config;
    }

    public function delete($encode_id = null)
    {
        $query = $this->get_detail($encode_id);
        $check = check_before_update($query['user_id']);
        if ($check === false) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Anda Tidak Punya Hak Akses');
            redirect('masterdata/index', 'refresh');
        }

        $this->pic_provider_model->delete($query['id']);
        $this->session->set_flashdata('alert_icon', 'success');
        $this->session->set_flashdata('alert_message', 'Data pic Berhasil Dihapus');
        redirect('masterdata/index', 'refresh');
    }

    private function get_detail($encode_id = null)
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

        $query = $this->pic_provider_model->get_by_condition($encode_id = null);

        // $query = $this->pic_provider_model->get_by_condition([base64_decode($encode_id)]);
        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data pic tidak ditemukan');
            redirect('masterdata/index');
        } else {
            return $query[0];
        }
    }
    //nama_program

    public function nama_program()
    {
        $where = [];
        if (!$this->ion_auth->is_admin()) {
            $where = ['user_id' => $this->ion_auth->get_user_id()];
        }

        $data = [
            'title' => 'List Nama Program',
            'nav_link' => 'nama_program',
            'content' => 'master/index_nama_program',
            'query' => $this->program_model->get_by_condition($where),
            'rows' => $this->Tables_program(),
        ];
        $this->load->view('template/layout', $data);
    }

    private function Tables_program()
    {
        $rows = [
            'Nama',
            'Status',
            'Aksi'
        ];
        return $rows;
    }

    public function create_program()

    {
        $this->form_validation->set_rules($this->SetValidations_program());
        if ($this->form_validation->run() == false) {
            $customers = $this->user_group_model->get_by_condition(['group_id !=' => 1]); // show only member & NOC
            $data = [
                'title' => 'Tambah Data Program',
                'nav_link' => 'master',
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'customers' => $customers,
                'content' => 'master/create_program',
            ];
            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            $post['last_update'] = date('Y-m-d H:i:s');
            $post['active'] = 1;

            $this->program_model->save($post);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data Program berhasil ditambah');
            redirect('masterdata/nama_program');
        }
    }

    private function SetValidations_program()
    {
        $config = [
            array(
                'field' => 'nama',
                'label' => 'Nama Program',
                'rules' => 'required|min_length[3]',
            ),
        ];

        return $config;
    }

    public function delete_program($encode_id = null)
    {
        $query = $this->get_detail_program($encode_id);
        $check = check_before_update($query['user_id']);
        if ($check === false) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Anda Tidak Punya Hak Akses');
            redirect('masterdata/nama_program', 'refresh');
        }

        $this->program_model->delete_program($query['id']);
        $this->session->set_flashdata('alert_icon', 'success');
        $this->session->set_flashdata('alert_message', 'Data Program Berhasil Dihapus');
        redirect('masterdata/nama_program', 'refresh');
    }


    //penyedia_lc

    public function penyedia_lc()
    {
        $where = [];
        if (!$this->ion_auth->is_admin()) {
            $where = ['user_id' => $this->ion_auth->get_user_id()];
        }

        $data = [
            'title' => 'List Provider',
            'nav_link' => 'penyedia_lc',
            'content' => 'master/index_penyedia_lc',
            'query' => $this->penyedia_model->get_by_condition($where),
            'rows' => $this->Tables_penyedia_lc(),
        ];
        $this->load->view('template/layout', $data);
    }

    private function Tables_penyedia_lc()
    {
        $rows = [
            'Nama',
            'Aksi'
        ];
        return $rows;
    }

    public function create_penyedia()

    {
        $this->form_validation->set_rules($this->SetValidations_penyedia());
        if ($this->form_validation->run() == false) {
            $customers = $this->user_group_model->get_by_condition(['group_id !=' => 1]); // show only member & NOC
            $data = [
                'title' => 'Tambah Data Penyedia',
                'nav_link' => 'master',
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'customers' => $customers,
                'content' => 'master/create_penyedia_lc',
            ];
            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();

            $this->penyedia_model->save($post);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data Program berhasil ditambah');
            redirect('masterdata/penyedia_lc');
        }
    }

    private function SetValidations_penyedia()
    {
        $config = [
            array(
                'field' => 'nama',
                'label' => 'Nama Penyedia',
                'rules' => 'required|min_length[3]',
            ),
        ];

        return $config;
    }

    public function delete_penyedia($encode_id = null)
    {
        $query = $this->get_detail_penyedia($encode_id);
        $check = check_before_update($query['user_id']);
        if ($check === false) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Anda Tidak Punya Hak Akses');
            redirect('masterdata/penyedia_lc', 'refresh');
        }

        $this->penyedia_model->delete_penyedia($query['id']);
        $this->session->set_flashdata('alert_icon', 'success');
        $this->session->set_flashdata('alert_message', 'Data Penyedia LC Dihapus');
        redirect('masterdata/penyedia_lc', 'refresh');
    }

    private function get_detail_penyedia($encode_id = null)
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

        $query = $this->penyedia_model->get_by_condition($encode_id = null);

        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data Program tidak ditemukan');
            redirect('masterdata/penyedia_lc');
        } else {
            return $query[0];
        }
    }

    // listrik

    public function listrik()
    {
        $where = [];
        if (!$this->ion_auth->is_admin()) {
            $where = ['user_id' => $this->ion_auth->get_user_id()];
        }

        $data = [
            'title' => 'List Listrik',
            'nav_link' => 'listrik',
            'content' => 'master/index_listrik',
            'query' => $this->source_power_model->get_by_condition($where),
            'rows' => $this->Tables_listrik(),
        ];
        $this->load->view('template/layout', $data);
    }

    private function Tables_listrik()
    {
        $rows = [
            'Nama',
            'Active',
            'Aksi'

        ];
        return $rows;
    }

    public function create_listrik()

    {
        $this->form_validation->set_rules($this->SetValidations_listrik());
        if ($this->form_validation->run() == false) {
            $customers = $this->user_group_model->get_by_condition(['group_id !=' => 1]); // show only member & NOC
            $data = [
                'title' => 'Tambah Source_power',
                'nav_link' => 'listrik',
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'customers' => $customers,
                'content' => 'master/create_listrik',
            ];
            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            $post['last_update'] = date('Y-m-d H:i:s');
            $post['active'] = 1;

            $this->source_power_model->save($post);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data ditambah');
            redirect('masterdata/listrik');
        }
    }

    private function SetValidations_listrik()
    {
        $config = [
            array(
                'field' => 'nama',
                'label' => 'Nama Source_power',
                'rules' => 'required|min_length[3]',
            ),
            array(
                'field' => 'active',
                'label' => 'active',
                'rules' => 'required',
            ),
        ];

        return $config;
    }

    public function delete_listrik($encode_id = null)
    {
        $query = $this->get_detail_listrik($encode_id);
        $check = check_before_update($query['user_id']);
        if ($check === false) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Anda Tidak Punya Hak Akses');
            redirect('masterdata/listrik', 'refresh');
        }

        $this->source_power_model->delete_listrik($query['id']);
        $this->session->set_flashdata('alert_icon', 'success');
        $this->session->set_flashdata('alert_message', 'Data Dihapus');
        redirect('masterdata/listrik', 'refresh');
    }

    private function get_detail_listrik($encode_id = null)
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

        $query = $this->source_power_model->get_by_condition($encode_id = null);

        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data Program tidak ditemukan');
            redirect('masterdata/penyedia_lc');
        } else {
            return $query[0];
        }
    }

    //OBS

    public function obs()
    {
        $where = [];
        if (!$this->ion_auth->is_admin()) {
            $where = ['user_id' => $this->ion_auth->get_user_id()];
        }

        $data = [
            'title' => 'List obs',
            'nav_link' => 'obs',
            'content' => 'master/index_obs',
            'query' => $this->operation_band_model->get_by_condition($where),
            'rows' => $this->Tables_obs(),
        ];
        $this->load->view('template/layout', $data);
    }

    private function Tables_obs()
    {
        $rows = [
            'Nama',
            'Status',
            'Aksi'
        ];
        return $rows;
    }

    public function create_obs()

    {
        $this->form_validation->set_rules($this->SetValidations_obs());
        if ($this->form_validation->run() == false) {
            $customers = $this->user_group_model->get_by_condition(['group_id !=' => 1]); // show only member & NOC
            $data = [
                'title' => 'Tambah OBS',
                'nav_link' => 'listrik',
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'customers' => $customers,
                'content' => 'master/create_obs',
            ];
            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            $post['last_update'] = date('Y-m-d H:i:s');
            $post['active'] = 1;

            $this->operation_band_model->save($post);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data ditambah');
            redirect('masterdata/obs');
        }
    }

    private function SetValidations_obs()
    {
        $config = [
            array(
                'field' => 'nama',
                'label' => 'Nama OBS',
                'rules' => 'required|min_length[3]',
            ),
        ];

        return $config;
    }

    public function delete_obs($encode_id = null)
    {
        $query = $this->get_detail_obs($encode_id);
        $check = check_before_update($query['user_id']);
        if ($check === false) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Anda Tidak Punya Hak Akses');
            redirect('masterdata/obs', 'refresh');
        }

        $this->operation_band_model->delete_obs($query['id']);
        $this->session->set_flashdata('alert_icon', 'success');
        $this->session->set_flashdata('alert_message', 'Data Dihapus');
        redirect('masterdata/obs', 'refresh');
    }

    private function get_detail_obs($encode_id = null)
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

        $query = $this->operation_band_model->get_by_condition($encode_id = null);

        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data Program tidak ditemukan');
            redirect('masterdata/penyedia_lc');
        } else {
            return $query[0];
        }
    }


    //BEAMS

    public function beams()
    {
        $where = [];
        if (!$this->ion_auth->is_admin()) {
            $where = ['user_id' => $this->ion_auth->get_user_id()];
        }

        $data = [
            'title' => 'List BEAMS',
            'nav_link' => 'beams',
            'content' => 'master/index_beams',
            'query' => $this->spotbeam_model->get_by_condition($where),
            'rows' => $this->Tables_beams(),
        ];
        $this->load->view('template/layout', $data);
    }

    private function Tables_beams()
    {
        $rows = [
            'Nama',
            'Status',
            'Aksi'
        ];
        return $rows;
    }

    public function create_beams()

    {
        $this->form_validation->set_rules($this->SetValidations_beams());
        if ($this->form_validation->run() == false) {
            $customers = $this->user_group_model->get_by_condition(['group_id !=' => 1]); // show only member & NOC
            $data = [
                'title' => 'Tambah Beams',
                'nav_link' => 'beams',
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'customers' => $customers,
                'content' => 'master/create_beams',
            ];
            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            $post['last_update'] = date('Y-m-d H:i:s');
            $post['active'] = 1;

            $this->spotbeam_model->save($post);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data ditambah');
            redirect('masterdata/beams');
        }
    }

    private function SetValidations_beams()
    {
        $config = [
            array(
                'field' => 'nama',
                'label' => 'Nama Beams',
                'rules' => 'required|min_length[3]',
            ),
        ];

        return $config;
    }

    public function delete_beams($encode_id = null)
    {
        $query = $this->get_detail_beams($encode_id);
        $check = check_before_update($query['user_id']);
        if ($check === false) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Anda Tidak Punya Hak Akses');
            redirect('masterdata/beams', 'refresh');
        }

        $this->spotbeam_model->delete_beams($query['id']);
        $this->session->set_flashdata('alert_icon', 'success');
        $this->session->set_flashdata('alert_message', 'Data Dihapus');
        redirect('masterdata/beams', 'refresh');
    }

    private function get_detail_beams($encode_id = null)
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

        $query = $this->spotbeam_model->get_by_condition($encode_id = null);

        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data Program tidak ditemukan');
            redirect('masterdata/beams');
        } else {
            return $query[0];
        }
    }
    //satelite

    public function satelit()
    {
        $where = [];
        if (!$this->ion_auth->is_admin()) {
            $where = ['user_id' => $this->ion_auth->get_user_id()];
        }

        $data = [
            'title' => 'List satelit',
            'nav_link' => 'satelit',
            'content' => 'master/index_satelit',
            'query' => $this->satelit_model->get_by_condition($where),
            'rows' => $this->Tables_satelit(),
        ];
        $this->load->view('template/layout', $data);
    }

    private function Tables_satelit()
    {
        $rows = [
            'Nama',
            'Status',
            'Aksi'
        ];
        return $rows;
    }

    public function create_satelit()

    {
        $this->form_validation->set_rules($this->SetValidations_satelit());
        if ($this->form_validation->run() == false) {
            $customers = $this->user_group_model->get_by_condition(['group_id !=' => 1]); // show only member & NOC
            $data = [
                'title' => 'Tambah Satelite',
                'nav_link' => 'satelite',
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'customers' => $customers,
                'content' => 'master/create_satelit',
            ];
            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            $post['last_update'] = date('Y-m-d H:i:s');
            $post['active'] = 1;

            $this->satelit_model->save($post);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data ditambah');
            redirect('masterdata/satelit');
        }
    }

    private function SetValidations_satelit()
    {
        $config = [
            array(
                'field' => 'nama',
                'label' => 'Nama Beams',
                'rules' => 'required|min_length[3]',
            ),
        ];

        return $config;
    }

    public function delete_satelit($encode_id = null)
    {
        $query = $this->get_detail_satelit($encode_id);
        $check = check_before_update($query['user_id']);
        if ($check === false) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Anda Tidak Punya Hak Akses');
            redirect('masterdata/satelit', 'refresh');
        }

        $this->satelit_model->delete_satelit($query['id']);
        $this->session->set_flashdata('alert_icon', 'success');
        $this->session->set_flashdata('alert_message', 'Data Dihapus');
        redirect('masterdata/satelit', 'refresh');
    }

    private function get_detail_satelit($encode_id = null)
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

        $query = $this->satelit_model->get_by_condition($encode_id = null);

        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data Program tidak ditemukan');
            redirect('masterdata/satelit');
        } else {
            return $query[0];
        }
    }
    // dish

    public function dish()
    {
        $where = [];
        if (!$this->ion_auth->is_admin()) {
            $where = ['user_id' => $this->ion_auth->get_user_id()];
        }

        $data = [
            'title' => 'List dish',
            'nav_link' => 'dish',
            'content' => 'master/index_dish',
            'query' => $this->dish_model->get_by_condition($where),
            'rows' => $this->Tables_dish(),
        ];
        $this->load->view('template/layout', $data);
    }

    private function Tables_dish()
    {
        $rows = [
            'Nama',
            'Status',
            'Aksi'
        ];
        return $rows;
    }

    public function create_dish()

    {
        $this->form_validation->set_rules($this->SetValidations_dish());
        if ($this->form_validation->run() == false) {
            $customers = $this->user_group_model->get_by_condition(['group_id !=' => 1]); // show only member & NOC
            $data = [
                'title' => 'Tambah Dish',
                'nav_link' => 'dish',
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'customers' => $customers,
                'content' => 'master/create_dish',
            ];
            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            $post['last_update'] = date('Y-m-d H:i:s');
            $post['active'] = 1;

            $this->dish_model->save($post);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data ditambah');
            redirect('masterdata/dish');
        }
    }

    private function SetValidations_dish()
    {
        $config = [
            array(
                'field' => 'nama',
                'label' => 'Nama Beams',
                'rules' => 'required|min_length[3]',
            ),
        ];

        return $config;
    }

    public function delete_dish($encode_id = null)
    {
        $query = $this->get_detail_dish($encode_id);
        $check = check_before_update($query['user_id']);
        if ($check === false) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Anda Tidak Punya Hak Akses');
            redirect('masterdata/dish', 'refresh');
        }

        $this->dish_model->delete_dish($query['id']);
        $this->session->set_flashdata('alert_icon', 'success');
        $this->session->set_flashdata('alert_message', 'Data Dihapus');
        redirect('masterdata/dish', 'refresh');
    }

    private function get_detail_dish($encode_id = null)
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

        $query = $this->dish_model->get_by_condition($encode_id = null);

        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data Program tidak ditemukan');
            redirect('masterdata/dish');
        } else {
            return $query[0];
        }
    }

    //update lc
    private function get_detail_pic($encode_id = null)
    {
        $query = $this->pic_provider_model->get_by_condition(['id' => base64_decode($encode_id)]);
        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data tidak ditemukan');
            redirect('masterdata/index/');
        } else {
            return $query[0];
        }
    }

    public function update_pic_penyedia($id = null)
    {
        $this->form_validation->set_rules($this->SetValidations());
        $query = $this->get_detail_pic($id);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Update PIC LC',
                'nav_link' => 'pic_penyedia',
                'csrf' => get_csrf_nonce(),
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'id' => $id,
                'query' => $query,
                'content' => 'master/update_pic_penyedia',
            ];

            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            if (valid_csrf_nonce() === false || $id != $post['id']) {
                $this->session->set_flashdata('alert_icon', 'warning');
                $this->session->set_flashdata('alert_message', 'Request site tidak valid');
                redirect('masterdata/index/' . base64_encode($id), 'refresh');
            }
            $save = [
                'nama' => $post['nama'],
                'telephone' => $post['telephone'],
                'active' => $post['active'],
                'last_update' => date('Y-m-d H:i:s'),
            ];
            $this->pic_provider_model->update($query['id'], $save);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data berhasil diupdate');
            redirect('masterdata/index');
        }
    }

    private function get_program($encode_id = null)
    {
        $query = $this->program_model->get_by_condition(['id' => base64_decode($encode_id)]);
        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data tidak ditemukan');
            redirect('masterdata/index/');
        } else {
            return $query[0];
        }
    }

    public function update_program($id = null)
    {
        $this->form_validation->set_rules($this->SetValidations_program());
        $query = $this->get_program($id);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Update program',
                'nav_link' => 'nama_program',
                'csrf' => get_csrf_nonce(),
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'id' => $id,
                'query' => $query,
                'content' => 'master/update_program',
            ];

            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            if (valid_csrf_nonce() === false || $id != $post['id']) {
                $this->session->set_flashdata('alert_icon', 'warning');
                $this->session->set_flashdata('alert_message', 'Request site tidak valid');
                redirect('masterdata/update_program/' . base64_encode($id), 'refresh');
            }
            $save = [
                'nama' => $post['nama'],
                'active' => $post['active'],
                'last_update' => date('Y-m-d H:i:s')
            ];
            $this->program_model->update($query['id'], $save);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data berhasil diupdate');
            redirect('masterdata/nama_program');
        }
    }

    //penyedia_lc
    private function get_penyedia($encode_id = null)
    {
        $query = $this->penyedia_model->get_by_condition(['id' => base64_decode($encode_id)]);
        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data tidak ditemukan');
            redirect('masterdata/index/');
        } else {
            return $query[0];
        }
    }

    public function update_penyedia($id = null)
    {
        $this->form_validation->set_rules($this->SetValidations_penyedia());
        $query = $this->get_penyedia($id);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Update Penyedia LC',
                'nav_link' => 'penyedia_lc',
                'csrf' => get_csrf_nonce(),
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'id' => $id,
                'query' => $query,
                'content' => 'master/update_penyedia',
            ];

            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            if (valid_csrf_nonce() === false || $id != $post['id']) {
                $this->session->set_flashdata('alert_icon', 'warning');
                $this->session->set_flashdata('alert_message', 'Request site tidak valid');
                redirect('masterdata/update_penyedia/' . base64_encode($id), 'refresh');
            }
            $save = [
                'nama' => $post['nama']
            ];
            $this->penyedia_model->update($query['id'], $save);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data berhasil diupdate');
            redirect('masterdata/penyedia_lc');
        }
    }


    //penyedia_lc
    private function get_listrik($encode_id = null)
    {
        $query = $this->source_power_model->get_by_condition(['id' => base64_decode($encode_id)]);
        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data tidak ditemukan');
            redirect('masterdata/listrik/');
        } else {
            return $query[0];
        }
    }

    public function update_listrik($id = null)
    {
        $this->form_validation->set_rules($this->SetValidations_listrik());
        $query = $this->get_listrik($id);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Update source_power_model',
                'nav_link' => 'listrik',
                'csrf' => get_csrf_nonce(),
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'id' => $id,
                'query' => $query,
                'content' => 'master/update_listrik',
            ];

            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            if (valid_csrf_nonce() === false || $id != $post['id']) {
                $this->session->set_flashdata('alert_icon', 'warning');
                $this->session->set_flashdata('alert_message', 'Request site tidak valid');
                redirect('masterdata/update_listrik/' . base64_encode($id), 'refresh');
            }
            $save = [
                'nama' => $post['nama'],
                'active' => $post['active']
            ];
            $this->source_power_model->update($query['id'], $save);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data berhasil diupdate');
            redirect('masterdata/listrik');
        }
    }

    //obs

    private function get_obs($encode_id = null)
    {
        $query = $this->operation_band_model->get_by_condition(['id' => base64_decode($encode_id)]);
        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data tidak ditemukan');
            redirect('masterdata/index/');
        } else {
            return $query[0];
        }
    }

    public function update_obs($id = null)
    {
        $this->form_validation->set_rules($this->SetValidations_obs());
        $query = $this->get_obs($id);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Update Obs',
                'nav_link' => 'obs',
                'csrf' => get_csrf_nonce(),
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'id' => $id,
                'query' => $query,
                'content' => 'master/update_obs',
            ];

            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            if (valid_csrf_nonce() === false || $id != $post['id']) {
                $this->session->set_flashdata('alert_icon', 'warning');
                $this->session->set_flashdata('alert_message', 'Request site tidak valid');
                redirect('masterdata/update_obs/' . base64_encode($id), 'refresh');
            }
            $save = [
                'nama' => $post['nama'],
                'active' => $post['active']
            ];
            $this->operation_band_model->update($query['id'], $save);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data berhasil diupdate');
            redirect('masterdata/obs');
        }
    }

    //update beams

    private function get_beams($encode_id = null)
    {
        $query = $this->spotbeam_model->get_by_condition(['id' => base64_decode($encode_id)]);
        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data tidak ditemukan');
            redirect('masterdata/beams/');
        } else {
            return $query[0];
        }
    }


    public function update_beams($id = null)
    {
        $this->form_validation->set_rules($this->SetValidations_beams());
        $query = $this->get_beams($id);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Update Beams',
                'nav_link' => 'beams',
                'csrf' => get_csrf_nonce(),
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'id' => $id,
                'query' => $query,
                'content' => 'master/update_beams',
            ];

            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            if (valid_csrf_nonce() === false || $id != $post['id']) {
                $this->session->set_flashdata('alert_icon', 'warning');
                $this->session->set_flashdata('alert_message', 'Request site tidak valid');
                redirect('masterdata/index/' . base64_encode($id), 'refresh');
            }
            $save = [
                'nama' => $post['nama'],
                'active' => $post['active'],
                'last_update' => date('Y-m-d H:i:s'),
            ];
            $this->spotbeam_model->update($query['id'], $save);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data berhasil diupdate');
            redirect('masterdata/beams');
        }
    }

    //satelite update

    private function get_update_satelite($encode_id = null)
    {
        $query = $this->satelit_model->get_by_condition(['id' => base64_decode($encode_id)]);
        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data tidak ditemukan');
            redirect('masterdata/index/');
        } else {
            return $query[0];
        }
    }

    public function update_satelite($id = null)
    {
        $this->form_validation->set_rules($this->SetValidations_satelit());
        $query = $this->get_update_satelite($id);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Update Satelite',
                'nav_link' => 'satelit',
                'csrf' => get_csrf_nonce(),
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'id' => $id,
                'query' => $query,
                'content' => 'master/update_satelit',
            ];

            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            if (valid_csrf_nonce() === false || $id != $post['id']) {
                $this->session->set_flashdata('alert_icon', 'warning');
                $this->session->set_flashdata('alert_message', 'Request site tidak valid');
                redirect('masterdata/update_penyedia/' . base64_encode($id), 'refresh');
            }
            $save = [
                'nama' => $post['nama'],
                'active' => $post['active'],
                'last_update' => date('Y-m-d H:i:s'),
            ];
            $this->satelit_model->update($query['id'], $save);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data berhasil diupdate');
            redirect('masterdata/satelit');
        }
    }


    //satelite dish

    private function get_dish($encode_id = null)
    {
        $query = $this->dish_model->get_by_condition(['id' => base64_decode($encode_id)]);
        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data tidak ditemukan');
            redirect('masterdata/index/');
        } else {
            return $query[0];
        }
    }

    public function update_dish($id = null)
    {
        $this->form_validation->set_rules($this->SetValidations_dish());
        $query = $this->get_dish($id);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Update Dish',
                'nav_link' => 'dish',
                'csrf' => get_csrf_nonce(),
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'id' => $id,
                'query' => $query,
                'content' => 'master/update_dish',
            ];

            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            if (valid_csrf_nonce() === false || $id != $post['id']) {
                $this->session->set_flashdata('alert_icon', 'warning');
                $this->session->set_flashdata('alert_message', 'Request site tidak valid');
                redirect('masterdata/update_penyedia/' . base64_encode($id), 'refresh');
            }
            $save = [
                'nama' => $post['nama'],
                'active' => $post['active'],
                'last_update' => date('Y-m-d H:i:s'),
            ];
            $this->dish_model->update($query['id'], $save);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data berhasil diupdate');
            redirect('masterdata/dish');
        }
    }
}
