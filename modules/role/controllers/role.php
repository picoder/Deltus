<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends DV_Controller {

	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		// Setting permissions
		$this->set_permission('CONTENT.ROLE.ROLE.ALL'); // we repeat for safe
		
		// Checking permissions
		if($this->check_permission('permissions/permissions','start/start/no_access'))
		{
			// Additional steps if no permission
			return;
		}
		
		// Running methods (if we have right permission)
		$this->future();
		
	}
	
	public function future()
	{
		echo 'Role role';	
	}
	
}

/* End of file settings.php */
/* Location: ./modules/role/controllers/settings.php */