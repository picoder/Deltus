<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_lib
{
	public $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
		echo 'Logged in id: ' . $this->CI->tank_auth->get_user_id();
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
		# check if user want to delete himself
		if($id == $this->CI->tank_auth->get_user_id())
		{
			return -11;
		}
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
	
	### edit ####
	
	public function get_many($page, $per_page, $field, $asc, $filters)
	{
		$u = new Userdm();
		
		# DEBUG print_r($filters);
		if( ! empty($filters))
		{
			# DEBUG var_dump($filters);
			foreach($filters as $filter => $val)
			{
				switch($filter)
				{
					case 'filter_status':
					if($val[0] != 'off')
					{
						# DEBUG echo 'H: '.$val[0].br();
						$u->where('banned', (int)($val[0]));
					}
					break;		
				}
			}
		}
		
		# DEBUG echo 'query field: '.($field);
		$users =  $u->order_by($field, $asc)->get_paged($page, $per_page);
		
		$r = new Roledm();
		foreach($users as $user)
		{
			$r->where_related($user)->get();
			$user->assigned_roles = $r->name;	
			$r->clear();
		}
		return $users;
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
			}
		}
		
		return $filter_string;
	}
	
	public function delete_many($ids)
	{
		$u = new Userdm();
		$u->where_in('id', $ids)->get();
		
		# check if user want to delete himself
		foreach($ids as $id)
		{
			if($id == $this->CI->tank_auth->get_user_id())
			{
				return -11;
			}
		}
		
		if($u->delete_all())
		{
			return DV_Controller::SUCCESS_PAGE;
		}
		else
		{
			return DV_Controller::FAIL_PAGE;;
		}
	}

}

	