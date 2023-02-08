<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('get_operation_vsat')) {
    function get_operation_vsat()
    {
        $data = explode('|', OPERATION_VSAT);
        return $data;
    }
}

if (!function_exists('get_status_site')) {
    function get_status_site()
    {
        return ['Request', 'Registered'];
    }
}

if (!function_exists('get_status_xpole')) {
    function get_status_xpole()
    {
        return ['Open', 'Approve'];
    }
}

if (!function_exists('get_general_users')) {
    function get_general_users()
    {
        $ci = &get_instance();
        return $ci->group_model->get_user_group(['group_id' => 2]);
    }
}

if (!function_exists('get_csrf_nonce')) {
    function get_csrf_nonce()
    {
        $ci = &get_instance();
        $ci->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $ci->session->set_flashdata('csrfkey', $key);
        $ci->session->set_flashdata('csrfvalue', $value);

        return [$key => $value];
    }
}

if (!function_exists('valid_csrf_nonce')) {
    function valid_csrf_nonce()
    {
        $ci = &get_instance();
        $csrfkey = $ci->input->post($ci->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey === $ci->session->flashdata('csrfvalue')) {
            return true;
        }
        return false;
    }
}

if (!function_exists('check_before_update')) {
    function check_before_update($user_id = null)
    {
        $ci = &get_instance();
        $user = $ci->ion_auth->user($user_id)->row_array();

        if ((!$ci->ion_auth->is_admin() && !($ci->ion_auth->user()->row()->id == $user_id))) {
            return false;
        } else return $user;
    }
}

if (!function_exists('is_noc')) {
    function is_noc()
    {
        $ci = &get_instance();
        $id = $ci->ion_auth->get_user_id();
        $current_groups = $ci->ion_auth->get_users_groups($id)->result_array()[0];
        return $current_groups['id'] == GROUP_ID_NOC ? true : false ;
    }
}
