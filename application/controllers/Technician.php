<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Technician extends CI_Controller
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
            'title' => 'List Teknisi',
            'nav_link' => 'technician',
            'content' => 'technician/v_index',
            'query' => $this->teknisi_model->get_by_condition($where),
            'rows' => $this->SetTableRows(),
        ];
        $this->load->view('template/layout', $data);
    }

    private function SetTableRows()
    {
        $rows = [
            'Nama',
            'Telepon',
            'Company',
            'Aksi'
        ];
        return $rows;
    }

    public function show_dropdown()
    {
        $user_id = $this->input->post('user_id');
        $data = [
            'type' => 'teknisi_id',
            'query' => $this->teknisi_model->get_by_condition(['user_id' => $user_id]),
        ];
        $this->load->view('dropdown/v_technician', $data);
    }

    public function create()
    
    {
        $this->form_validation->set_rules($this->SetValidations());
        if ($this->form_validation->run() == false) {
            $customers = $this->user_group_model->get_by_condition(['group_id !=' => 1]); // show only member & NOC
            $data = [
                'title' => 'Tambah Data Teknisi',
                'nav_link' => 'technician',
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'customers' => $customers,
                'content' => 'technician/v_create',
            ];
            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            $post['last_update'] = date('Y-m-d H:i:s');
            $post['active'] = 1;

            $this->teknisi_model->save($post);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data Teknisi berhasil ditambah');
            redirect('technician/index');
        }
    }

    private function SetValidations()
    {
        $config = [
            array(
                'field' => 'user_id',
                'label' => 'User',
                'rules' => 'required|integer',
            ),
            array(
                'field' => 'nama',
                'label' => 'Nama Teknisi',
                'rules' => 'required|min_length[3]',
                // 'rules' => 'required|is_unique[nama]'
            ),
            array(
                'field' => 'telepon',
                'label' => 'Nomor Telepon',
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
            redirect('technician/index', 'refresh');
        }

        $this->teknisi_model->delete($query['id']);
        $this->session->set_flashdata('alert_icon', 'success');
        $this->session->set_flashdata('alert_message', 'Data Teknisi Berhasil Dihapus');
        redirect('technician/index', 'refresh');
    }

    private function get_detail($encode_id = null)
    {
        $query = $this->teknisi_model->get_by_condition(['t.id' => base64_decode($encode_id)]);
        if (count($query) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data Teknisi tidak ditemukan');
            redirect('technician/index');
        } else {
            return $query[0];
        }
    }

    public function update($id = null)
    {
        $this->form_validation->set_rules($this->SetValidations());
        $query = $this->get_detail($id);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Update Data Teknisi',
                'nav_link' => 'technician',
                'csrf' => get_csrf_nonce(),
                'company' => $this->ion_auth->user()->row_array()['company'] ?? false,
                'user_id' => $this->ion_auth->user()->row_array()['id'] ?? false,
                'customers' => $this->user_group_model->get_by_condition(['group_id !=' => 1]),
                'id' => $id,
                'query' => $query,
                'content' => 'technician/v_update',
            ];

            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            if (valid_csrf_nonce() === false || $id != $post['id']) {
                $this->session->set_flashdata('alert_icon', 'warning');
                $this->session->set_flashdata('alert_message', 'Request site tidak valid');
                redirect('technician/update/' . base64_encode($id), 'refresh');
            }
            $save = [
                'user_id' => $post['user_id'],
                'nama' => $post['nama'],
                'telepon' => $post['telepon'],
                'last_update' => date('Y-m-d H:i:s'),
            ];
            $this->teknisi_model->update($query['id'], $save);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data Teknisi berhasil diupdate');
            redirect('technician/index');
        }
    }
}
