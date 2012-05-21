<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends DV_Controller 
{
	public function __construct()
    {
		parent::__construct(); # we must call it to run paren condtructor - it won't run default
    }

	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		$this->division_builder->set_cur_seg(); 
		$this->load->library('tank_auth/tank_auth');
		$this->load->library('role/role_lib');
		$this->load->config('backend/backend');
		
		$user_roles = array();
		$user_roles = $this->role_lib->get_user_roles($this->tank_auth->get_user_id());
		//$user_roles = array('administrator'); // hack for a moment!!!!!!!!!!!
		// Each user has at leat one role!
		
		if(empty($user_roles)) 
		{
			$this->_login_backend();
		}
		// Setting permissions
		
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
			echo modules::run('tank_auth/tank_auth_backend/index');
			break;
			default:
			echo modules::run('tank_auth/tank_auth_backend/index');
		}
		
	}
	
	private function _set_backend($backend_role)
	{
		
		// Setting permissions
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case $this->config->item('roles_content_url'):
			$this->set_permission('CONTENT.ROLE.CONTENT.ALL');
			break;
			
			case $this->config->item('roles_settings_url'):
			$this->set_permission('CONTENT.ROLE.SETTINGS.ALL');
			break;
			
			case $this->config->item('simple_offer_content_url'):
			
			break;
			
			case $this->config->item('gallery_content_url'):
			
			break;
			
			case $this->config->item('page_content_url'):
			
			break;
			
			case 'auth':
			
			break;
			default:
			$this->set_permission('CONTENT.ROLE.CONTENT.ALL');
			break;
		}
		
		// Checking permissions
		if($this->check_permission('permissions/permissions','start/start/no_access'))
		{
			// Additional steps if no permission
			return;
		}
		
		// Running methods (if we have right permission)
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case $this->config->item('roles_content_url'):
			echo modules::run('role/content/index');
			break;
			case $this->config->item('roles_settings_url'):
			echo modules::run('role/settings/index');
			break;
			case $this->config->item('simple_offer_content_url'):
			echo modules::run('simple_offer/content/index');
			break;
			case $this->config->item('gallery_content_url'):
			echo modules::run('gallery/content/index');
			break;
			case $this->config->item('page_content_url'):
			echo modules::run('page/content/index');
			break;
			
			case 'auth':
			echo modules::run('tank_auth/tank_auth_backend/index');
			break;
			
			case $this->config->item('test_url'):
			$this->load->helper('form');
			print_r($this->input->post('categories'));
			$this->load->library('tree/tree_lib');
			$this->tree_lib->select_tree();
			break;
			
			default:
			echo modules::run('simple_offer/content/index');
			break;
		}
		
	}
	
}

/* End of file backend.php */
/* Location: ./modules/backend/controllers/backend.php */