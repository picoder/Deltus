<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_lib
{
	public $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function get_user_roles($user_id, $isId = FALSE)
	{
		$r = new Roledm;
		$roles = array();
		foreach($r->where_related_userdm('id', $user_id)->get() as $role)
		{
			if( ! $isId)
			{
				$roles[] = $role->name;
			}
			else
			{
				$roles[] = $role->id;
			}
				
		}
		return $roles;
	}
}

	