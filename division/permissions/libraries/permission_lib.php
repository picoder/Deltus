<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permission_lib
{
    public $CI;

    public function __construct()
    {
        $this -> CI = &get_instance();
    }
    
    public function check_no_check($bool)
    {
        log_message('error', 'check_no_ckeck works');
        return FALSE;
    }
    
    public function check_no_access($bool)
    {
        log_message('error', 'check_no_access works');
        return 'division/division/no_dv_permission';
    }

    public function check_is_logged_in($bool)
    {
        $this -> CI -> load -> library('tank_auth/tank_auth');
        if ($this -> CI -> tank_auth -> is_logged_in())
        {
            return FALSE;
        }
        else
        {
            return 'division/division/no_dv_permission';
        }
    }

    # $allowed_roles type:array
    public function check_role($allowed_roles)
    {
        $this -> CI -> load -> library('tank_auth/tank_auth');
        $this -> CI -> load -> library('role/role_lib');
        if (!$this -> CI -> tank_auth -> is_logged_in())
        {
            /*
             * How to display what func wants out of division

             echo modules::run('permissions/permissions/future');
             exit();
             return TRUE;
             * */

            return 'division/division/no_dv_permission';
        }
        $user_id = $this -> CI -> tank_auth -> get_user_id();
        foreach ($this->CI->role_lib->get_user_roles($user_id) as $role)
        {
            foreach ($allowed_roles as $allowed_role)
            {
                if ($role == $allowed_role)
                {

                    return FALSE;
                }
            }
        }
        return 'division/division/no_dv_permission';
    }

}
