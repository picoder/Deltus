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
	
	public function get_many($page, $per_page, $field, $asc, $filters)
	{
		$r = new Roledm();
		if( ! empty($filters))
		{
			foreach($filters as $filter => $val)
			{
				switch($filter)
				{
					case 'checkbox_filter':
					foreach($val as $status)
					{
						$r->or_where('status', $status);	
					}
					break;
					
					case 'filter_status':
					$r->where('status', (int)($val));
					break;		
				}
			}
		}
		$roles =  $r->order_by($field, $asc)->get_paged($page, $per_page);
		foreach($roles as $role)
		{
			$role->assigned_users_count = $this->_count_related_users($role);	
		}
		return $roles;
	}
	
	public function generate_filters($filters = 'role_status::0#1-variable:1', $other_filters = array())
	{
		$temp_filters = array();
		if(is_array($filters))
		{
			# array mode
			foreach($filters as $filter => $val)
			{
				switch($filter)
				{
					case 'filter_status':
					$temp_filters = array_merge($temp_filters, array('filter_status' => $val));
					break; 	
				}
			}	
		}
		else
		{
			# string mode
			$filter_groups = explode('-f-', $filters);
			$filter_groups = d_array_filter($filter_groups, 'delete_empty');
			
			foreach($filter_groups as $group)
			{
				$vals = explode('-v-', $group);
				$filter_index = array_shift($vals);	
				if(count($vals) == 1)
				{
					$vals = $vals[0];	
				}
				$temp_filters[$filter_index] = $vals;
			}	
		}
		# if there is any collision in post filters and url(get) filters - post filters win and overwrite url filters
		return array_merge($other_filters, $temp_filters);
		# return array('filter_status' => array(1));	
	}
	
	# array from $_POST
	public function generate_filter_string($filters) 
	{
		$filter_string = '';
		foreach($filters as $filter => $val)
		{
			
			switch($filter)
			{
				case 'filter_status':
				$filter_string .= '-f-filter_status';
				switch($val)
				{
					case 0:
					$filter_string .= '-v-0';
					break;
					case 1:
					$filter_string .= '-v-1';
					break;	
				}
				break;	
			}
		}
		
		return $filter_string;
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