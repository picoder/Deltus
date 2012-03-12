<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# Example of router module 
# Also testing module
class Lab extends DV_Controller {

	public function __construct()
    {
		parent::__construct(); # we must call it to run paren condtructor - it won't run default
		
		# First loading default module configs
		$this->load->config('lab/lab');
    }
	
	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		$this->division_builder->set_cur_seg();

		
		# For admin modules we must load tank_auth and role module
		# $this->load->module('tank_auth/tank_auth_backend'); # to load parameters in constructor
		$this->load->library('tank_auth/tank_auth');
		$this->load->library('role/role_lib');
		
        //echo $this->tank_auth->get_user_id().br();
        
		# Role determine next steps. For admin  modules we can choose backend admin panel
		$user_roles = array();
		$user_roles = $this->role_lib->get_user_roles($this->tank_auth->get_user_id());
		
		if(empty($user_roles)) 
		{
			# die('You have no role assigned');
			echo 'No role'.br();
			$this->_login_backend();
		}
		
		if(count($user_roles) > 1)
		{
			$this->_choose_backend($user_roles);
		}
		elseif(count($user_roles) == 1)
		{
			$this->_set_backend($user_roles[0]);
		}
		
	}
	
	private function _login_backend()
	{
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case 'auth':
			$this->division_builder->set_path('auth');
			echo modules::run('tank_auth/tank_auth_backend/index');
			break;
            # in case of problems with tank_auth and deltus logic
            case 'logout':
                $this->tank_auth->logout();
			default:
			$this->division_builder->set_path('auth');
			echo modules::run('tank_auth/tank_auth_backend/index');
		}	
	}
	
	# function _set_backend contains setting, checking permissions and routing based on these permissions
	# in none admin modules actions of setting, checking permissions and routing based on these permissions will be in index function
	private function _set_backend($backend_role)
	{
		
		# Setting permissions
		switch($this->uri->segment($this->division_builder->get_cur_seg())) 
		{
			case $this->config->item('lab_content_url'):
			# this we will find in permission module
			$this->set_permission('MODULE.LAB.LAB.INDEX');
			break;
			
			default:
			$this->set_permission('MODULE.LAB.LAB.INDEX');
			break;
		}
		
		# Checking permissions
		if($this->check_permission('permissions/permissions','permissions/permissions/default_no_permission'))
		{
			# Additional steps if no permission
			return;
		}
		
		# Running methods (if we have right permission)
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case $this->config->item('lab_content_url'):
			$this->division_builder->set_path($this->config->item('lab_content_url'));
			echo modules::run('lab/lab_c/index');
			break;
			
			case 'auth':
			echo modules::run('tank_auth/tank_auth_backend/index');
			break;
			
			default:
			$this->division_builder->set_path($this->config->item('lab_content_url'));
			echo modules::run('lab/lab_c/index');
			break;
		}
		
	}
	
	# Test of injection of Codeigniter Config array by Division
	public function test_dv_configs()
	{
		$this->config->set_item('test_index', 'test_value');
		echo $this->config->item('test_index');
		echo '<br>';
		echo $this->config->item('first_index', 'second_index');
		echo $this->config->item('second_index', 'first_index');
	}

}

