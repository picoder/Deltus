<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class DV_Controller extends MX_Controller 
{
	private $_permission;
	# if division active (If FALSE we can test frontend without division)
	# backend module is special
	# check $this->method_seg()
	private $_dv; 
	
	public function __construct() 
	{		
		parent::__construct();
		$this->load->helper(array('url', 'html'));
		
		/* default value form permission */
		$this->_permission = 'SITE.ALL.ALL.ALL';
		$this->_dv = FALSE; 
	}
	
	public function set_permission($permission)
	{
		$this->_permission = $permission;			
	}
	
	# arg permissions	path to config file with permissions
	
	public function check_permission($permissions, $default_action)
	{
		$this->load->config($permissions);	
		if( ! array_key_exists($this->_permission, $this->config->config))
		{
			# this permission is not set
			if($default_action)
			{
				echo modules::run($default_action);
			}
			return TRUE;	
		}
		$this->load->library('division/checker');
		foreach($this->config->item($this->_permission) as $checker => $condition)
		{
			if( ! $this->checker->$checker($condition))
			{
				# No permission
				if($default_action)
				{
					 echo modules::run($default_action);
				}
				return TRUE;
			}
		}
		# We have persmission to continue
		return FALSE;
	}
	
	
	public function method_seg() 
	{
		return $this->_dv ? 2 : 3;	
	}
	
	public function set_dv($flag)
	{
		$this->_dv = $flag;	
	}
	
	protected function _no_page()
	{
		$this->load->view('simple_offer/no_page');
	}
	
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */