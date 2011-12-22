<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends DV_Controller {

	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		// Setting permissions
		switch($this->uri->segment(3))
		{
			case 'list':
			$this->set_permission('CONTENT.ROLE.CONTENT.LIST');
			break;
			case 'edit':
			$this->set_permission('CONTENT.ROLE.CONTENT.EDIT');
			break;
			default:
			$this->set_permission('CONTENT.ROLE.CONTENT.LIST');
			break;
		}
		
		// Checking permissions
		if($this->check_permission('permissions/permissions','start/start/no_access'))
		{
			// Additional steps if no permission
			return;
		}
		
		// Running methods (if we have right permission)
		switch($this->uri->segment(3))
		{
			case 'list':
			$this->_list_roles();
			break;
			case 'edit':
			$this->_edit_roles();
			break;
			default:
			$this->_list_roles();
			break;
		}
		
	}
	
	private function _list_roles()
	{
		echo 'Private list roles';
	}
	
	private function _edit_roles()
	{
		echo 'Private edit roles';
	}
	
}

/* End of file content.php */
/* Location: ./modules/role/controllers/content.php */