<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role_lib
{
	public $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	# TODO: Move to tank_auth_lib
	public function get_user_roles($user_id)
	{
		$r = new Roledm;
		$roles = array();
		foreach($r->where_related_userdm('id', $user_id)->get() as $role)
		{
			$roles[] = $role->name;
		}
		return $roles;
	}
	
	public function delete($id)
	{
		$r = new Roledm();
		$r->where('id', $id)->get();
		if($r->result_count() < 1)
		{
			return -1;
		}
		else
		{
			# Cannot delete group with assigned users
			if($this->_count_related_users($r) > 0)
			{
				return -2;
			}
			else
			{
				if($r->delete())
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
		}
	}
	
	public function edit($page, $per_page, $field, $asc)
	{
		$r = new Roledm();
		$roles =  $r->order_by($field, $asc)->get_paged($page, $per_page);
		foreach($roles as $role)
		{
			$role->assigned_users_count = $this->_count_related_users($role);	
		}
		return $roles;
	}
	
	public function delete_many($ids)
	{
		$r = new Roledm();
		$r->where_in('id', $ids)->get();
		foreach ($r->all as $role)
		{
			if($this->_count_related_users($role) > 0)
			{
				return -2;
			}
		}

		if($r->delete_all())
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	# Specialized methods
	
	private function _count_related_users($group)
	{
		return $group->userdm->count();
	}
	
}

/* End of file role_lib.php */
/* Location: ./modules/role/libraries/role_lib.php */