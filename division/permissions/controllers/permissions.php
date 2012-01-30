<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permissions extends DV_Controller {
	
	public function __construct()
    {
		parent::__construct(); # we must call it to run paren condtructor - it won't run default	
		
		# Using language settings
		$this->load->language('permissions');
		
		# Setting configs
		$this->load->config('permissions/permissions');
    }

	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		// Setting permissions
		$this->set_permission('CONTENT.ROLE.ROLE.ALL'); // we repeat for safe
		
		// Checking permissions
		if($this->check_permission('permissions/permissions','permissions/permissions/default_no_permission'))
		{
			// Additional steps if no permission
			return;
		}
		
		// Running methods (if we have right permission)
		$this->future();
		
	}
	
	public function future()
	{
		echo 'Permissions';	
	}
	
	public function default_no_permission()
	{
		$this->load->view('permissions/default_no_permission');
	}
	
}

