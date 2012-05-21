<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simple_offer extends DV_Controller {

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
		$this->division_builder->set_cur_seg();
		
		$this->load->config('simple_offer/simple_offer');
		// Setting permissions
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case $this->config->item('list_so_by_category_url'):
			// access without permission
			$this->set_permission('SITE.ALL.ALL.ALL');
			break;
			case $this->config->item('show_so_url'):
			// access without permission
			$this->set_permission('SITE.ALL.ALL.ALL');
			break;
			default:
			// access without permission
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
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case $this->config->item('list_so_by_category_url'):
			switch($category = $this->uri->segment($this->division_builder->get_cur_seg() + 1))
			{
				case '':
				$this->list_so_by_category();
				break;
				default:
				$this->list_so_by_category($category);
			}
			break;
			case $this->config->item('show_so_url'):
			$link;
			switch($this->uri->segment($this->division_builder->get_cur_seg()))
			{
				default:
				$link = $this->uri->segment($this->division_builder->get_cur_seg());
			}
			$this->show_so($link);
			break;
			default:
			$this->_no_page();
			break;
		}
			
	}
	
	public function show_so($link)
	{
		$this->load->library('simple_offer/so_public_lib');
		$item_array = array();
		$item_array = $this->so_public_lib->get_item($link);
		if((isset($item_array['item']->id)))
		{
			$this->load->view('simple_offer/public/show_so', $item_array);	
		}
		else
		{
			$this->_no_page();	
		}
	}
	
	public function list_so_by_category($category = FALSE)
	{
		$this->load->library('simple_offer/so_public_lib');
		$items = array();
		switch($category)
		{
			// inluding all categories
			case FALSE:
			$items = $this->so_public_lib->get_all_items();
			break;
			
			default:
			// $category set as a name
			echo $category;
		}
		$this->load->view('simple_offer/public/list_so_by_category', array('items' => $items));
		
	}

}

