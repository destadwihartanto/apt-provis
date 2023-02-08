<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (! function_exists('check_login')) {
    function check_login()
    {
        $ci=& get_instance();
        if (!$ci->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        return true;
    }
}
