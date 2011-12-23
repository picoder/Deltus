<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dmtest extends DV_Controller {

	
	public function index()
	{
		
		$user = new Fool(2); // localization in modules/start/models!
		echo $user->name;
		$user = new Foodm(1);
		echo $user->name;
	}
	
	public function xrun()
	{
		$this->load->module('start/start');
		$this->start->index();
	}
	
	public function mrun()
	{
		$this->load->module('start/start');
		$this->start->something_do();
	}
	
	public function test_role()
	{
		$this->load->library('role/role_lib');
		$this->role_lib->get_user_roles(1);
			
	}
}

/* End of file start.php */
/* Location: ./modules/start/controllers/start.php */