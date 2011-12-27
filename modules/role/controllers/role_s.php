<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role_s extends DV_Controller { //settings

	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		// Setting permissions
		$this->set_permission('CONTENT.ROLE.SETTINGS.ALL'); // we repeat for safe
		
		// Checking permissions
		if($this->check_permission('permissions/permissions','start/start/no_access'))
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
