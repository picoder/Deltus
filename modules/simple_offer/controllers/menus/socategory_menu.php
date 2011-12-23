<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Socategory_menu extends DV_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		$default = TRUE;
		switch($default)
		{
			case TRUE:
			$this->set_permission('SITE.ALL.ALL.ALL');
			
			break;
			default:
			$this->set_permission('SITE.ALL.ALL.ALL');
			break;
		}
		
		// Checking permissions
		if($this->check_permission('permissions/permissions','start/start/no_access'))
		{
			// Additional steps if no permission
			return;
		}
		
		// Running methods (if we have right permission)
		switch($default)
		{
			case TRUE:
			$this->socas_menu();
			break;
			default:
			$this->socas_menu();
			break;
		}		
	}
	
	public function socas_menu()
	{
		$this->load->view('simple_offer/menus/socas_menu');	
	}
	
	
}

