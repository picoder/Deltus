<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# Example of normal module. This is content class so it contains functionality for administrators
# But this is test lab module which contains the idea of Deltus
class Content extends DV_Controller {
	
	public function __construct()
    {
		parent::__construct(); # we must call it to run parent condtructor - it won't run default
    }

	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		
		$this->load->config('lab/lab');
		
		# Setting permissions
		switch($this->uri->segment(3))
		{
			case $this->config->item('lab_test_url'):
			$this->set_permission('MODULE.LAB.CONTENT.INDEX');
			break;
			
			default:
			$this->set_permission('MODULE.LAB.CONTENT.INDEX');
			break;
		}
		
		# Checking permissions
		if($this->check_permission('permissions/permissions','start/start/no_access'))
		{
			# Additional steps if no permission
			return;
		}
		
		# Running methods (if we have right permission)
		switch($this->uri->segment(3))
		{
			case $this->config->item('lab_test_url'):
			#one way of routing
			echo modules::run('lab/content/test_dv_configs');
			break;
			
			case 'soca':
			echo modules::run('simple_offer/socategory/socategory/index');
			break;
			
			case 'so-list':
			echo modules::run('simple_offer/simple_offer/index');
			break;
			
			case 'empty':
			#second way of routing
			$this->test_load_dv_configs();
			break;
			
			default:
			echo modules::run('lab/content/test_dv_configs');
			break;
		}
		
	}
	
	# Test of injection of Codeigniter Config array by Division
	public function test_dv_configs()
	{
		# if we even set config item(one or two indexed) it not works because Deltus division has other self config data which are more important than static data from config files or that setted in fly
		
		# setted in fly (is more important than static data from config files
		$this->config->set_item('test_config_index', 'test_value set in fly in config one dimesnion');
		echo br();
		echo 'Test config (one dimension config from division): '.$this->config->item('test_config_index');
		echo br();
		echo 'Test config (two dimesnions config from division: '.$this->config->item('second_index', 'first_index');
		echo br();
		
		# we set now config two dimesnion data in fly
		$this->config->set_item('test_2d_first_index', 'set 2D index in fly', 'test_2d_second_index');
		echo 'Test 2d config setted in fly: '.$this->config->item('test_2d_first_index', 'test_2d_second_index');
		
		# 
	}
	
	public function test_load_dv_configs()
	{
		
	}
}
	
	