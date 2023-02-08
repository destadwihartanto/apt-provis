<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->form_validation->set_error_delimiters(
            $this->config->item('error_start_delimiter', 'ion_auth'),
            $this->config->item('error_end_delimiter', 'ion_auth'),
        );
        $this->lang->load('auth');
    }

    public function index()
    {
        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Anda tidak memiliki hak akses');
            redirect('site/index', 'refresh');
        }

        $users = $this->ion_auth->users()->result_array();
        foreach ($users as $k => $user) {
            $users[$k]['groups'] = $this->ion_auth->get_users_groups($user['id'])->result_array();
        }

        $data = [
            'title' => 'List User',
            'nav_link' => 'user',
            'treeview' => 'user_list',
            'content' => 'user/v_list',
            'query' => $users,
            'rows' => $this->SetTableRows(),
        ];
        $this->load->view('template/layout', $data);
    }

    private function SetTableRows()
    {
        $rows = [
            'Username',
            'Company',
            'First Name',
            'Last Name',
            'Email',
            'Groups',
            'Aksi',
        ];
        return $rows;
    }

    public function create()
    {
        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Anda tidak memiliki hak akses');
            redirect('user/index', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $input[] = [
                'label' => 'First Name',
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            ];

            $input[] = [
                'label' => 'Last Name',
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            ];
            $input[] = [
                'label' => 'Username',
                'name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            ];
            $input[] = [
                'label' => 'Email',
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'value' => $this->form_validation->set_value('email'),
            ];
            $input[] = [
                'label' => 'Company Name',
                'name' => 'company',
                'id' => 'company',
                'type' => 'text',
                'value' => $this->form_validation->set_value('company'),
            ];
            $input[] = [
                'label' => 'Phone Number',
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'value' => $this->form_validation->set_value('phone'),
            ];
            $input[] = [
                'label' => 'Password',
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password'),
            ];
            $input[] = [
                'label' => 'Confirm Password',
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            ];

            $data = [
                'title' => 'Tambah User',
                'nav_link' => 'user',
                'error_message' => $error_message,
                'content' => 'user/v_create',
                'params' => $input,
                'csrf' => get_csrf_nonce(),
                'groups' => $this->ion_auth->groups()->result_array(),
            ];

            $this->load->view('template/layout', $data);
        } else {
            if (valid_csrf_nonce() === false) {
                $this->session->set_flashdata('alert_icon', 'warning');
                $this->session->set_flashdata('alert_message', 'Request site tidak valid');
                redirect('user/create', 'refresh');
            }

            $save = [
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
                'username' => $this->input->post('username'),
                'password' => $this->ion_auth_model->hash_password($this->input->post('password')),
                'active' => 1,
                'email' => strtolower($this->input->post('email')),
            ];
            $user_id = $this->user_model->save($save);
            $this->insert_group(['group_id' => $this->input->post('group_id'), 'user_id' => $user_id]);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data User Berhasil Ditambah');
            redirect('user/index', 'refresh');
        }
    }

    public function delete($id = null)
    {
        $data = check_before_update(base64_decode($id));
        if (count($data) == 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Data tidak ditemukan');
            redirect('user/index');
        } else {
            $this->user_model->delete($data['id']);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data User Berhasil Dihapus');
            redirect('user/index');
            return $data[0];
        }
    }

    public function update($id = null)
    {
        $user = check_before_update(base64_decode($id));
        if ($user == false) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Anda Tidak Punya Hak Akses');
            redirect('user/index');
        }

        // update the password if it was posted
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
        }

        $this->form_validation->set_rules($this->set_validation_user());
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Update User',
                'id' => $id,
                'nav_link' => 'user',
                'treeview' => 'user_list',
                'content' => 'user/v_update',
                'params' => $this->set_validation_user($user),
                'csrf' => get_csrf_nonce(),
                'groups' => $this->ion_auth->groups()->result_array(),
                'current_groups' => $this->ion_auth->get_users_groups(base64_decode($id))->result_array()[0] ?? false,
            ];
            $this->load->view('template/layout', $data);
        } else {
            $this->email_check(['email' => $this->input->post('email'), 'user_id' => base64_decode($id)]);
            if (valid_csrf_nonce() === false || $id != $this->input->post('id')) {
                $this->session->set_flashdata('alert_icon', 'warning');
                $this->session->set_flashdata('alert_message', 'Request site tidak valid');
                redirect('user/update/' . base64_encode($id), 'refresh');
            }

            $post = $this->input->post();
            $user = $this->user_group_model->get_by_condition(['user_id' => base64_decode($id)]);
            $this->user_group_model->update($user[0]['id'],['group_id' => $post['group_id'], 'updated_at' => date('Y-m-d H:i:s')]);
            $save = [
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
                'username' => $this->input->post('username'),
                'email' => strtolower($this->input->post('email')),
            ];

             // update the password if it was posted
             if ($this->input->post('password')) {
                $save['password'] = $this->ion_auth_model->hash_password($this->input->post('password'));
            }

            $this->user_model->update(base64_decode($id), $save);
            $this->session->set_flashdata('alert_icon', 'success');
            $this->session->set_flashdata('alert_message', 'Data User Berhasil Update');
            redirect('user/index', 'refresh');
        }
    }

    private function insert_group($data = [])
    {
        $check = $this->user_group_model->get_by_condition($data);
        if (count($check) == 0) {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->user_group_model->save($data);
        } else {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->user_group_model->update($check[0]['id'],$data);
        }
        return true;
    }

    private function email_check($params = [])
    {
        $where = ['email' => $params['email'], 'id !=' => $params['user_id']];
        $data = $this->user_model->get_by_condition($where);

        if (count($data) > 0) {
            $this->session->set_flashdata('alert_icon', 'warning');
            $this->session->set_flashdata('alert_message', 'Email sudah dipakai');
            redirect('user/update/' . base64_encode($params['user_id']), 'refresh');
        } else {
            return true;
        }
    }

    private function set_validation_user($data = [])
    {
        // validate form input

        $config = [
            array(
                'field' => 'first_name',
                'id' => 'first_name',
                'label' => 'First Name',
                'rules' => 'trim|required',
                'type'  => 'text',
                'value' => $data['first_name'] ?? null,
            ),
            array(
                'field' => 'last_name',
                'id' => 'last_name',
                'label' => 'Last Name',
                'rules' => 'trim|required',
                'type'  => 'text',
                'value' => $data['last_name'] ?? null,
            ),
            array(
                'field' => 'username',
                'id' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required',
                'type'  => 'text',
                'value' => $data['username'] ?? null,
            ),
            array(
                'field' => 'email',
                'id' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email',
                'type'  => 'text',
                'value' => $data['email'] ?? null,
            ),
            array(
                'field' => 'company',
                'id' => 'company',
                'label' => 'Company Name',
                'rules' => 'trim|required',
                'type'  => 'text',
                'value' => $data['company'] ?? null,
            ),
            array(
                'field' => 'phone',
                'id' => 'phone',
                'label' => 'Phone Number',
                'rules' => 'trim|required',
                'type'  => 'text',
                'value' => $data['phone'] ?? null,
            ),
            // array(
            //     'field' => 'password',
            //     'label' => 'Password',
            //     'rules' => 'required|min_length[5]|matches[password_confirm]',
            //     'type'  => 'password',
            //     'value' => null,
            // ),
            // array(
            //     'field' => 'password_confirm',
            //     'label' => 'Confirm Password',
            //     'rules' => 'required',
            //     'type'  => 'password',
            //     'value' => null,
            // ),
        ];

        return $config;
    }
}
