<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Back extends DV_Controller 
{
    public function __construct()
    {
        parent::__construct(); # we must call it to run parent constructor - it won't run default

        $this -> load -> config('back/back'); # First loading default module configs
    }
    
    public function _remap($method)
    {
        $this -> index();
    }
    
    public function index()
    {
        $this->load->library('auth/tank_auth');
        
        if($this->tank_auth->is_logged_in(FALSE)) # later we can do that as a main condition for all modules with authorization
        {
            redirect($this->config->item('back.send_again'));
        }
        
        if( ! $this->tank_auth->is_logged_in()) # later we can do that as a condition in permission function
        {
            redirect($this->config->item('back.not_logged_in'));
        }
        
        $this->load->library('role/role_lib');
        $user_roles = array();
        $user_roles = $this->role_lib->get_user_roles($this->tank_auth->get_user_id());
        if(empty($user_roles)) # for secure (in production all users have roles assigned)
        {
            die('System is not prepared. You have no role assigned. You must logout!');
        }
        if(count($user_roles) > 1)
        {
            die('System is not prepared. In present system developing level there is not any mechanism for user with more than 1 role.');
        }
        else # when we have only one role
        {
            $this->_set_backend($user_roles[0]);
        }
    }

    protected function _set_backend($user_role)
    {
        switch($user_role)
        {
            case 'administrator':
                $this->_administrator();
                break;
            case 'editor':
                $this->_editor();
                break;
        }
    }
    
    protected function _administrator()
    {
        $this -> division_builder -> set_cur_seg();
        
        switch($this->uri->segment($this->division_builder->get_cur_seg()))
        {
            case $this->config->item('back.back.users.url') :
                $this -> set_permission('BACK.BACK.USERS');
                break;
                
            case $this->config->item('back.back.roles.url') :
                $this -> set_permission('BACK.BACK.ROLES');
                break;

            default :
                $this -> set_permission('BACK.BACK.USERS');
                break;
        }

        $this -> main_permission();
        
        switch($this->uri->segment($this->division_builder->get_cur_seg()))
        {
            case $this->config->item('back.back.users.url') :
                $this -> division_builder -> set_path($this -> config -> item('back.back.users.url'));
                echo modules::run('auth/user_crud/index');
                break;
                
           case $this->config->item('back.back.roles.url') :
                $this -> division_builder -> set_path($this -> config -> item('back.back.roles.url'));     
                echo modules::run('role/role_crud/index');
                break;

            default :
                $this -> division_builder -> set_path($this -> config -> item('back.back.users.url'));
                echo modules::run('auth/user_crud/index');
                break;
        }
    }
    
    protected function _editor()
    {
        
    }
}