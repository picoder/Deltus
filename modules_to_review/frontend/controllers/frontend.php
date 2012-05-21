<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends DV_Controller 
{
	public function __construct()
    {
		parent::__construct(); # we must call it to run paren condtructor - it won't run default
    }

	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		$this->division_builder->set_cur_seg();
		$this->load->config('frontend/frontend');
		$this->_set_frontend($this->uri->segment($this->division_builder->get_cur_seg()));
	}
	
	private function _set_frontend($option)
	{
		# Setting permissions
		switch($option) 
		{
			case $this->config->item('page_page_url'):
			$this->set_permission('SITE.ALL.ALL.ALL');
			break;
			case $this->config->item('so_so_url'):
			$this->set_permission('SITE.ALL.ALL.ALL');
			break;
			default:
			$this->set_permission('SITE.ALL.ALL.ALL');
			break;
		}
		
		# Checking permissions
		if($this->check_permission('permissions/permissions','start/start/no_access'))
		{
			# Additional steps if no permission
			return;
		}
		
		# Running methods (if we have right permission)
		switch($option)
		{
			case $this->config->item('page_page_url'):
			echo modules::run('page/page/index');
			break;
			case $this->config->item('so_so_url'):
			echo modules::run('simple_offer/simple_offer/index');
			break;
			case $this->config->item('test_url'):
			echo '<h1>test frontend</h1>';
			# TEST: echo modules::run('simple_offer/content/index');
			break;	
			default:	
			echo modules::run('page/page/index');
			break;
		}
		
	}
	
}
