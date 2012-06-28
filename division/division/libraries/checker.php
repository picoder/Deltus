<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* checker return TRUE if we have access */

class Checker
{
	public $CI;
	
	public function __construct()
	{
		$this->CI = & get_instance();
	}
	
	# $access type:bool 
	public function check_full_access($access)
	{
		return $access;	
	}
	
	
	# $access type:array 
	public function check_full_access_special($access)
	{
		switch($access[0])
		{
			case 't':
			return TRUE;
			break;
			default:
			return FALSE;
		}
	}
	
	
	# $allowed_roles type:array 
	public function check_role($allowed_roles)
	{
		$this->CI->load->library('auth/tank_auth');
		$this->CI->load->library('role/role_lib');
		if( ! $this->CI->tank_auth->is_logged_in()) return FALSE;
		$user_id = $this->CI->tank_auth->get_user_id();
		foreach($this->CI->role_lib->get_user_roles($user_id) as $role)
		{
			foreach($allowed_roles as $allowed_role)
			{
				if($role == $allowed_role) 
				{
					
					return TRUE;	
				}
			}
		}
		return FALSE;
	}
}

/* End of file checker.php */
/* Location: ./modules/division/libraries/checker.php */