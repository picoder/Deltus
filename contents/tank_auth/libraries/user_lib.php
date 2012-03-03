<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_lib
{
	public $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function get_user_roles($user_id, $is_id_used = FALSE)
	{
		$r = new Roledm;
		$roles = array();
		foreach($r->where_related_userdm('id', $user_id)->get() as $role)
		{
			if( ! $is_id_used)
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
	
	public function save_r_role_user($user_id, $role_ids)
	{
		if(is_array($role_ids)) # prepare for situdation when user can have more than one role
		{
			
		}
		else 
		{
			$r = new Roledm();
			$r -> where('id', $role_ids) -> get();
			$u = new Userdm();
			$u -> where('id', $user_id) -> get();
			$u -> save($r);

			if ($u -> save($r))
			{
				return DV_Controller::SUCCESS_PAGE;
			}
			else
			{
				return DV_Controller::FAIL_PAGE;
			}
}
	}
	
	public function delete($id)
	{
		$u = new Userdm();
		$u->where('id', $id)->get();
		echo $u->username;
		if($u->result_count() < 1)
		{
			return DV_Controller::NO_IN_DB;
		}
		else
		{
			$r = new Roledm();
			$r->where_related($u)->get();
			if($u->delete($r) AND $u->delete())
			{
				return DV_Controller::SUCCESS_PAGE;
			}
			else
			{
				return DV_Controller::FAIL_PAGE;
			}
		}
	}
}

	