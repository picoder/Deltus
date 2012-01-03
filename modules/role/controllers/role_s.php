<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role_s extends DV_Controller { //settings

public function __construct()
    {
		parent::__construct(); # we must call it to run paren condtructor - it won't run default	
		
		# Setting configs
		$this->load->config('role/role');
    }

	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		// Setting permissions
		$this->set_permission('MODULE.ROLE.SETTINGS.ALL'); // we repeat for safe
		
		// Checking permissions
		if($this->check_permission('permissions/permissions','permissions/permissions/default_no_permission'))
		{
			// Additional steps if no permission
			return;
		}
		
		// Running methods (if we have right permission)
		$this->_settings_form();
		
	}
	
	private function _settings_form()
	{
		echo 'Settings form';	
	}
	
}
