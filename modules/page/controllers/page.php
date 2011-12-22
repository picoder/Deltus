<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends DV_Controller {

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
		$this->load->config('page/page');
		// Setting permissions
		switch($this->uri->segment(3))
		{
			case $this->config->item('list_pages_by_category_url'):
			// access without permission
			$this->set_permission('SITE.ALL.ALL.ALL');
			break;
			case $this->config->item('show_page_url'):
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
		switch($this->uri->segment(3))
		{
			case $this->config->item('list_pages_by_category_url'):
			switch($category = $this->uri->segment(4))
			{
				case '':
				$this->list_pages_by_category();
				break;
				default:
				$this->list_pages_by_category($category);
			}
			break;
			case $this->config->item('show_page_url'):
			$link;
			switch($this->uri->segment(4))
			{
				default:
				$link = $this->uri->segment(4);
			}
			$this->show_page($link);
			break;
			default:
			$link = 'o-firmie';
			$this->show_page($link);
			break;
		}
			
	}
	
	public function show_page($link)
	{
		$this->load->library('page/page_public_lib');
		$item_array = $this->page_public_lib->get_item($link);
		$this->load->view('page/public/show_page', $item_array);	
	}
	
	public function list_pages_by_category($category = FALSE)
	{
		$this->load->library('page/page_public_lib');
		$items = array();
		switch($category)
		{
			// inluding all categories
			case FALSE:
			$items = $this->page_public_lib->get_all_items();
			break;
			
			default:
			// $category set as a name
			echo $category;
		}
		$this->load->view('page/public/list_pages_by_category', array('items' => $items));
		
	}

}

