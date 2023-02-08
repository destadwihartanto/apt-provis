<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Xpole extends CI_Controller
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
            'title' => 'List Crosspole',
            'nav_link' => 'xpole',
            'query' => $this->xpole_model->show_table($where),
            'content' => 'xpole/v_index',
            'is_admin' => $this->ion_auth->is_admin() || is_noc(),
            'rows' => ['Nama Site', 'Company', 'Status', 'Last Update', 'Notes', 'Aksi']
        ];
        $this->load->view('template/layout', $data);
    }

    // open
    public function open()
    {
        $where = [];
        if (!$this->ion_auth->is_admin() && !is_noc()) {
            $where = ['u.id' => $this->ion_auth->get_user_id()];
        }

        $data = [
            'title' => 'List Crosspole',
            'nav_link' => 'xpole',
            'query' => $this->xpole_model->show_table_open($where),
            'content' => 'xpole/v_open',
            'is_admin' => $this->ion_auth->is_admin() || is_noc(),
            'rows' => ['Nama Site', 'Company', 'Status', 'Last Update', 'Notes', 'Aksi']
        ];
        $this->load->view('template/layout', $data);
    }

    // approve
    // open
    public function disetujui()
    {
        $where = [];
        if (!$this->ion_auth->is_admin() && !is_noc()) {
            $where = ['u.id' => $this->ion_auth->get_user_id()];
        }

        $data = [
            'title' => 'List Crosspole',
            'nav_link' => 'xpole',
            'query' => $this->xpole_model->show_table_approve($where),
            'content' => 'xpole/v_disetujui',
            'is_admin' => $this->ion_auth->is_admin() || is_noc(),
            'rows' => ['Nama Site', 'Company', 'Status', 'Last Update', 'Notes', 'Aksi']
        ];
        $this->load->view('template/layout', $data);
    }

    


    public function create()
    {
        $this->form_validation->set_rules($this->SetValidations());
        if ($this->form_validation->run() == false) {
            $sites = $this->site_model->get_by_condition();
            $technicians = $this->teknisi_model->get_by_condition();
            $is_admin = $this->ion_auth->is_admin() || is_noc();
            if (!$is_admin) {
                $query = $this->ion_auth->user()->row_array();
                $sites = $this->site_model->get_by_condition(['user_id' => $this->ion_auth->get_user_id()]);
                $where = ['user_id' => $this->ion_auth->get_user_id()];
                $technicians = $this->teknisi_model->get_by_condition($where);
            }

            $data = [
                'title' => 'Request Xpole',
                'nav_link' => 'xpole',
                'sites' => $sites,
                'technicians' => $technicians,
                'user_id' => $query['user_id'] ?? false,
                'company' => $query['company'] ?? false,
                'companies' => $this->ion_auth_model->users(2)->result_array(), // show only member
                'content' => $is_admin ? 'xpole/v_create_by_admin' : 'xpole/v_create_by_user',
            ];
            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            $post['last_update'] = date('Y-m-d H:i:s');

            // file upload
            foreach ($_FILES as $key => $value) {
                $upload = $this->do_upload($key);
                if (!isset($upload['file_name'])) {
                    $this->session->set_flashdata('upload_error', $upload);
                    redirect('xpole/create');
                }
                $post[$key] = $upload['file_name'];
            }
            unset($post['user_id']);
            $this->check_before_insert($post['site_id']);
            $this->xpole_model->save($post);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data Xpole berhasil ditambah');
            redirect('xpole/index');
        }
    }

    private function SetValidations()
    {
        $config = [
            array(
                'field' => 'site_id',
                'label' => 'Lokasi',
                // 'rules' => 'required|integer',
                'rules' => 'required|is_unique[site.sid]'

            ),
            array(
                'field' => 'teknisi_id',
                'label' => 'Teknisi',
                'rules' => 'required|integer',
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required'
            ),
            array(
                'category' => 'text',
                'field' => 'notes',
                'label' => 'Notes'
                // 'rules' => 'required'
            ),

        ];

        return $config;
    }

    public function do_upload($form_name)
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 3000;
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($form_name)) {
            $data = $this->upload->display_errors();
        } else {
            $data = $this->upload->data();
        }
        return $data;
    }

    public function update($id = null)
    {
        $query = $this->find($id);
        $this->check_before_update($query['site_id']);
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('teknisi_id', 'Teknisi', 'required');
        // $this->form_validation->set_rules('cpi', 'CPI', 'required');
        // $this->form_validation->set_rules('c2n', 'C to N', 'required');
        // $this->form_validation->set_rules('asi', 'ASI', 'required');
        if ($this->form_validation->run() == false) {
            $technicians = $this->teknisi_model->get_by_condition();
            $is_admin = $this->ion_auth->is_admin() || is_noc();
            if (!$is_admin) {
                $where = ['user_id' => $this->ion_auth->get_user_id()];
                $technicians = $this->teknisi_model->get_by_condition($where);
            }

            $data = [
                'nav_link' => 'xpole',
                'title' => 'Update Xpole',
                'id' => $id,
                'is_admin' => $is_admin,
                'query' => $query,
                'attachment' => $this->SetupAttachment() ,
                'teknisi' => $technicians,
                'content' => 'xpole/v_update',
            ];
            $this->load->view('template/layout', $data);
        } else {
            $post = $this->input->post();
            $post['last_update'] = date('Y-m-d H:i:s');
            foreach ($_FILES as $key => $value) {
                $upload = $this->do_upload($key);
                if (!isset($upload['file_name'])) {
                    $this->session->set_flashdata('upload_error', $upload);
                    redirect('xpole/update/' . $id);
                }
                $post[$key] = $upload['file_name'];
            }
            if ($post['status'] == 'approve') {
                $post['approved_at'] = date('Y-m-d H:i:s');
            }
            $this->xpole_model->update($query['id'], $post);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Xpole Berhasil di Update');
            redirect('xpole/detail/' . $id);
        }
    }


    public function detail($id = null)
    {
        $data = [
            'nav_link' => 'xpole',
            'title' => 'Detail',
            'query' => $this->find($id),
            'content' => 'xpole/v_detail',
        ];
        $this->load->view('template/layout', $data);
    }

    private function SetupAttachment()
    {
        $data = [
            'Parameter Modem #1' => 'url_img_first_modem',
            'Parameter Modem #2' => 'url_img_second_modem',
            'Hasil Crosspole' => 'url_img_xpole',
            'Hasil Speedtest' => 'url_img_speedtest',
            'Ethernet' => 'url_img_ethernet',
            'Plang Instansi' => 'url_img_plang',
            'Antena' => 'url_img_antenna',
        ];
        return $data;
    }

    private function find($id = null)
    {
        $data = $this->xpole_model->get_where(['x.id' => base64_decode($id)]);
        if (count($data) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data tidak ditemukan');
            redirect('xpole/index');
        } else {
            return $data[0];
        }
    }

    public function hapus_attachment($id = null, $type = null)
    {
        $data = $this->find($id);
        $where = [$type => null];
        $this->xpole_model->update($data['id'], $where);
        $path = FCPATH  . '/uploads/' . $data[$type];
        unlink($path);
        $this->session->set_flashdata('alert_icon', 'success');
        $this->session->set_flashdata('alert_message', 'Lampiran berhasil dihapus');
        redirect('xpole/update/' . $id);
    }

    public function delete($id = null)
    {
        $data = $this->find($id);
        $this->check_before_update(base64_decode($id));
        $images = $this->SetupAttachment();
        foreach ($images as $key => $value) {
            if ($data[$value] != null) {
                $path = FCPATH  . '/uploads/' . $data[$value];
                unlink($path);
            }
        }
        $this->xpole_model->delete($data['id']);
        $this->session->set_flashdata('alert_icon', 'success');
        $this->session->set_flashdata('alert_message', 'Data Xpole berhasil dihapus');
        redirect('xpole/index');
    }

    private function check_before_insert($site_id)
    {
        $where = ['site_id' => $site_id, 'status' => 'open'];
        $query = $this->xpole_model->get_by_condition($where);
        if (count($query) == 0) {
            return true;
        } else {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data Xpole sudah ada');
            redirect('xpole/create');
        }
    }

    private function check_before_update($site_id)
    {
        // hanya admin dan pemilik site
        if ($this->ion_auth->is_admin() || is_noc()) {
            return true;
        }
        $where = ['site_id' => $site_id, 's.user_id' => $this->ion_auth->get_user_id()];
        $query = $this->xpole_model->get_where($where);
        if (count($query) > 0) {
            return true;
        }
        $this->session->set_flashdata('alert_icon', 'warning');
        $this->session->set_flashdata('alert_message', 'Anda tidak punya hak akses');
        redirect('xpole/index');
    }

    public function approve($encode_id = null)
    {
        if (!$this->ion_auth->is_admin() && !is_noc()) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Anda tidak punya hak akses');
            redirect('xpole/index');
        }
        $data = $this->find($encode_id);
        $post = ['status' => 'approve'];
        $this->xpole_model->update($data['id'], $post);
        $this->session->set_flashdata('alert_icon', 'success');
        $this->session->set_flashdata('alert_message', 'Xpole Approved');
        redirect('xpole/index');
    }
}
