<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class So_widget extends DV_Controller {

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
			$this->short_descriptions();
			break;
			default:
			$this->short_descriptions();
			break;
		}		
	}
	
	public function short_descriptions()
	{
		$this->load->library('simple_offer/so_widgets_lib');
		$items_array = $this->so_widgets_lib->newest(array('num_of_items' => 6));
		$this->load->view('simple_offer/widgets/newest', array('items_array' => $items_array));	
	}
	
	public function so_slideshow()
	{
		$this->load->library('simple_offer/so_widgets_lib');
		$items_array = $this->so_widgets_lib->newest(array('num_of_items' => 2));
		$this->load->view('simple_offer/widgets/so_slideshow', array('items_array' => $items_array));	
	}
	
}

