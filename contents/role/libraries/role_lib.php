<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role_lib
{
	public $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function get_all()
	{
		$r = new Roledm;
		$roles = array();
		foreach($r->get() as $role)
		{
			$roles[$role->id] = $role->name;
		}
		return $roles;
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
    
    public function count_assigned_users($role_id)
    {
        $r = new Roledm();
        $r -> include_related_count('userdm') -> where('id', $role_id) -> get();
        return $r->userdm_count;
    }
	
	public function get_many($page, $per_page, $field, $asc, $filters)
	{
		$r = new Roledm();
		$r->include_related_count('userdm');
		# DEBUG print_r($filters);
		if( ! empty($filters))
		{
			# DEBUG var_dump($filters);
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
					if($val[0] != 'off')
					{
						# DEBUG echo 'H: '.$val[0].br();
						$r->where('status', (int)($val[0]));
					}
					break;
					
					case 'filter_users':
						switch ($val[0])
						{
							case 'off':
							# nothing to do	
							break;
								
							case 0:
							$r_help = new Roledm();
							$r_help->select('id')->include_related_count('userdm')->get();
							$ids = array();
							foreach($r_help as $role_help)
							{
								if($role_help->userdm_count == 0)
								{
									$ids[]=$role_help->id;
								}
								
							}
							$r->where_in('id', $ids);
							break;
							
							case 1:
							$r_help = new Roledm();
							$r_help->select('id')->include_related_count('userdm')->get();
							$ids = array();
							foreach($r_help as $role_help)
							{
								if($role_help->userdm_count > 0)
								{
									# DEBUG echo $role_help->id.br();
									$ids[]=$role_help->id;
								}
								
							}
							$r->where_in('id', $ids);
							break;
						}
					break;			
				}
			}
		}
		
		# DEBUG echo 'query field: '.($field);
		$roles =  $r->order_by($field, $asc)->get_paged($page, $per_page);
		
		foreach($roles as $role)
		{
			$role->assigned_users_count = $role->userdm_count;	
		}
		return $roles;
	}
	
	public function generate_filters($filters, $other_filters = array())
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
					$temp_filters = array_merge($temp_filters, array('filter_status' => array($val)));
					break;
					
					case 'filter_users':
					$temp_filters = array_merge($temp_filters, array('filter_users' => array($val)));
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
				switch($val[0])
				{
					case 'off':
					$filter_string .= '-v-off';
					break;
					case 0:
					$filter_string .= '-v-0';
					break;
					case 1:
					$filter_string .= '-v-1';
					break;	
				}
				break;	
				
				case 'filter_users':
				$filter_string .= '-f-filter_users';
				switch($val[0])
				{
					case 'off':
					$filter_string .= '-v-off';
					break;
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
	
}

/* End of file role_lib.php */
/* Location: ./modules/role/libraries/role_lib.php */