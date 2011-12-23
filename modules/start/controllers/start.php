<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Start extends DV_Controller {

	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		// Setting permissions
		switch($this->uri->segment($this->method_seg()))
		{
			case 'something-do':
			$this->set_permission('CONTENT.START.START.SDO');
			break;
			default:
			// access without permission
			break;
		}
		
		// Checking permissions
		if($this->check_permission('permissions/permissions','start/start/no_access'))
		{
			// Additional steps if no permission
			return;
		}
		
		// Running methods (if we have right permission)
		switch($this->uri->segment($this->method_seg()))
		{
			case 'something-do':
			$this->something_do();
			break;
			default:
			$this->remapped();
			break;
		}
			
	}
	
	public function something_do()
	{
		$this->load->view('welcome_message');
		echo $this->uri->segment(1).' | '.$this->uri->segment(2).' | '.$this->uri->segment(3);
		echo '<br>';
		echo $this->uri->rsegment(1).' | '.$this->uri->rsegment(2).' | '.$this->uri->rsegment(3);
	}
	
	public function remapped()
	{
		echo 'remapped';
	}
	
	public function no_access()
	{
		echo 'No access';
	}
}

/* End of file start.php */
/* Location: ./modules/start/controllers/start.php */