<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_c extends DV_Controller
{

	public function __construct()
	{
		parent::__construct();
		# we must call it to run paren condtructor - it won't run default

		# Using language settings
		$this -> load -> language('user_c');

		# Setting configs
		$this -> load -> config('tank_auth/user');
		$this -> load -> config('tank_auth/division_clutch');
	}

	public function _remap($method)
	{
		$this -> index();
	}

	public function index()
	{
		$this -> division_builder -> set_cur_seg();

		# Setting permissions
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case $this->config->item('add_user_url') :
				$this -> set_permission('MODULE.USER.CONTENT.ADD');
				break;

			case $this->config->item('update_user_url') :
				$this -> set_permission('MODULE.USER.CONTENT.UPDATE');
				break;

			case $this->config->item('change_pass_url') :
				$this -> set_permission('MODULE.USER.CONTENT.CHANGE_PASSWORD');
				break;
				
			case $this->config->item('change_username_url') :
				$this -> set_permission('MODULE.USER.CONTENT.CHANGE_USERNAME');
				break;
				
			case $this->config->item('change_email_url') :
				$this -> set_permission('MODULE.USER.CONTENT.CHANGE_EMAIL');
				break;

			case $this->config->item('delete_user_url') :
				$this -> set_permission('MODULE.USER.CONTENT.DELETE');
				break;

			case $this->config->item('edit_user_url') :
				$this -> set_permission('MODULE.USER.CONTENT.EDIT');
				break;

			default :
				break;
		}

		# Checking permissions
		if ($this -> check_permission('permissions/permissions', 'permissions/permissions/default_no_permission'))
		{
			# Additional steps if no permission
			return;
		}

		# Running methods (if we have right permission)
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case $this->config->item('add_user_url') :
				$this -> division_builder -> set_path($this -> config -> item('add_user_url'));
				$this -> add();
				break;

			case $this->config->item('update_user_url') :
				$this -> division_builder -> set_path($this -> config -> item('update_user_url'));
				$id = intval($this -> uri -> segment($this -> division_builder -> get_cur_seg() + 1));
				if ($id <= 0)
				{
					$this -> _no_page();
				}
				else
				{
					$this -> update($id);
				}
				break;

			case $this->config->item('change_pass_url') :
				$this -> division_builder -> set_path($this -> config -> item('change_pass_url'));
				$id = intval($this -> uri -> segment($this -> division_builder -> get_cur_seg() + 1));
				if ($id <= 0)
				{
					$this -> _no_page();
				}
				else
				{
					$this -> change_pass($id);
				}
				break;
				break;
				
			case $this->config->item('change_username_url') :
				$this -> division_builder -> set_path($this -> config -> item('change_username_url'));
				$id = intval($this -> uri -> segment($this -> division_builder -> get_cur_seg() + 1));
				if ($id <= 0)
				{
					$this -> _no_page();
				}
				else
				{
					$this -> change_username($id);
				}
				break;
				break;
				
			case $this->config->item('change_email_url') :
				$this -> division_builder -> set_path($this -> config -> item('change_email_url'));
				$id = intval($this -> uri -> segment($this -> division_builder -> get_cur_seg() + 1));
				if ($id <= 0)
				{
					$this -> _no_page();
				}
				else
				{
					$this -> change_email($id);
				}
				break;
				break;

			case $this->config->item('delete_user_url') :
				$this -> division_builder -> set_path($this -> config -> item('delete_user_url'));
				$id = intval($this -> uri -> segment($this -> division_builder -> get_cur_seg() + 1));
				if ($id <= 0)
				{
					$this -> _no_page();
				}
				else
				{
					$this -> delete($id);
				}
				break;

			case $this->config->item('edit_user_url') :
				$this -> division_builder -> set_path($this -> config -> item('edit_user_url'));
				$page_url = intval($this -> uri -> segment($this -> division_builder -> get_cur_seg() + 1));
				$field_url = $this -> uri -> segment($this -> division_builder -> get_cur_seg() + 2);
				$asc_url = $this -> uri -> segment($this -> division_builder -> get_cur_seg() + 3);
				$filter_url = $this -> uri -> segment($this -> division_builder -> get_cur_seg() + 4);

				$this -> edit($page_url, $field_url, $asc_url, $filter_url);
				break;

			default :
				$this -> _no_page();
				break;
		}

	}

	public function add()
	{
		$this -> load -> helper(array('form'));
		$use_username = $this -> config -> item('use_username', 'tank_auth');

		if (!$this -> input -> post('user_c_add_user_submit'))
		{
			# echo 'no_post data';
			$this -> load -> library('role/role_lib');
			$this -> load -> view('tank_auth/user_c_add', array('roles' => $this -> role_lib -> get_all()));
		}
		else
		{
			$this -> load -> library('form_validation');
			$this -> form_validation -> set_rules('user_name', $this -> lang -> line('user_c_add_role_name'), 'required|min_length[4]');

			if (!$this -> form_validation -> run())
			{
				$this -> load -> view('tank_auth/user_c_add');
				$this -> load -> library('role/role_lib');
				$this -> load -> view('tank_auth/user_c_add', array('roles' => $this -> role_lib -> get_all()));
			}
			else
			{
				$this -> load -> library('tank_auth/tank_auth');

				$username = $this -> input -> post('user_name');
				$email = $this -> input -> post('user_email');
				$password = $this -> input -> post('user_pass');
				$banned = intval($this -> input -> post('user_status'));
				$created = date('c');
				$modified = date('c');
				$roles = $this -> input -> post('roles');

				if (!is_null($data = $this -> tank_auth -> create_user($use_username ? $username : '', $email, $password, $email_activation = FALSE)))# automatic user activation
				{
					unset($data['password']);
					// Clear password (just for any case)
					
					$this -> load -> library('tank_auth/user_lib');
					switch($this->user_lib->save_r_role_user($data['user_id'], $roles))
					{
						case DV_Controller::SUCCESS_PAGE:
							$this -> _success_page();
							break;
						case DV_Controller::FAIL_PAGE:
							$this -> _fail_page();
							break;
					}
				}
				else
				{
					$errors = $this -> tank_auth -> get_error_message();
					print_r($errors);
					$this -> _fail_page();
				}
			}
		}
	}

	# without password and role
	public function update($id)
	{
		$this -> load -> helper(array('form'));
		$use_username = $this -> config -> item('use_username', 'tank_auth');
		
		$u = new Userdm();
		$u -> where('id', $id) -> get();
		
		$this -> load -> library('tank_auth/user_lib');
		$user_roles = $this->user_lib->get_user_roles($id, TRUE);
		
		if ( ! $this -> input -> post('user_c_update_user_submit'))
		{
			
			if ($u -> result_count() < 1)
			{
				$this -> _no_db_result();
			}
			else
			{
				$this -> load -> library('role/role_lib');
				$this -> load -> view('tank_auth/user_c_update', array('u' => $u, 'roles' => $this -> role_lib -> get_all(), 'user_roles' => $user_roles[0])); # user_roles[0] - for now user can have only one role
			}
		}
		else
		{
			$this -> load -> library('form_validation');
			$this -> load -> library('tank_auth/tank_auth');
			$this -> load -> model('tank_auth/users');
			$this->form_validation->set_rules('user_status', $this->lang->line('user_c_update_user_status'), 'required');

			if ( ! $this -> form_validation -> run())
			{
				echo 'form_validation error';
				$this -> load -> library('role/role_lib');
				$this -> load -> view('tank_auth/user_c_update', array('u' => $u, 'roles' => $this -> role_lib -> get_all(), 'user_roles' => $user_roles[0]));
			}
			else
			{

				# admin cannot change username and email wchich are unique for each user with update panel. He must ex. first delete user and create new.
				# $u->username = $this->input->post('user_name');
				# $u->email = $this->input->post('user_email');

				$u -> banned = intval($this -> input -> post('user_status'));
				$u -> modified = date('c');
				$roles = $this -> input -> post('roles');
				
				$r = new Roledm();
				$r -> where('id', $user_roles[0]) -> get();
				$u->delete($r);
				$r->clear();
				$r -> where('id', $roles) -> get();

				if ($u -> save($r))
				{
					$this -> _success_page();
				}
				else
				{
					$this -> _fail_page();
				}
			}
		}

	}

	public function change_pass($id)
	{
		$this -> load -> helper(array('form'));
		
		if ( ! $this -> input -> post('user_c_change_pass_submit'))
		{
			$this -> load -> view('tank_auth/user_c_change_pass');
		}
		else
		{
			$this -> load -> library('form_validation');
			$this -> form_validation -> set_rules('new_password', $this -> lang -> line('user_c_change_pass_new_password'), 'required');
			
			if ( ! $this -> form_validation -> run())
			{
				$this -> load -> view('tank_auth/user_c_change_pass');
				echo 'validation';
			}
			else
			{
				$this -> load -> model('tank_auth/users');
				$this -> load -> library('tank_auth/tank_auth');
				

				$new_pass_key = md5(rand() . microtime());

				$this -> users -> set_password_key($id, $new_pass_key);

				$password = $this -> input -> post('new_password');
				
				if (!is_null($data = $this -> tank_auth -> reset_password($id, $new_pass_key, $password)))
				{
					$this -> _success_page();
				}
				else 
				{
					$this -> _fail_page();
				}
			}
		}
	}
	
	public function change_username($id)
	{
		$this -> load -> helper(array('form'));
		$u = new Userdm();
		$u->where('id', $id)->get();
		
		
		if ( ! $this -> input -> post('user_c_change_username_submit'))
		{
			$this -> load -> view('tank_auth/user_c_change_username', array('current_username' => $u->username));
			
		}
		else 
		{
			$this -> load -> library('form_validation');	
			$this -> form_validation -> set_rules('new_username', $this -> lang -> line('user_c_change_username_new_username'), 'required');
			
			if ( ! $this -> form_validation -> run())
			{
				$this -> load -> view('tank_auth/user_c_change_username', array('current_username' => $u->username));
				echo 'validation';
			}
			else
			{
				$u->username = $this -> input -> post('new_username');
				if ($u -> save($r))
				{
					$this -> _success_page();
				}
				else
				{
					$this -> _fail_page();
				}
			}
		}
	}

	public function change_email($id)
	{
		$this -> load -> helper(array('form'));
		$u = new Userdm();
		$u->where('id', $id)->get();
		
		
		if ( ! $this -> input -> post('user_c_change_email_submit'))
		{
			$this -> load -> view('tank_auth/user_c_change_email', array('current_email' => $u->email));
			
		}
		else 
		{
			$this -> load -> library('form_validation');	
			$this -> form_validation -> set_rules('new_email', $this -> lang -> line('user_c_change_email_new_email'), 'required');
			
			if ( ! $this -> form_validation -> run())
			{
				$this -> load -> view('tank_auth/user_c_change_email', array('current_email' => $u->email));
				echo 'validation';
			}
			else
			{
				$u->email = $this -> input -> post('new_email');
				if ($u -> save($r))
				{
					$this -> _success_page();
				}
				else
				{
					$this -> _fail_page();
				}
			}
		}
	}

	public function delete($id)
	{
		$this -> load -> library('tank_auth/user_lib');
		
		switch($this->user_lib->delete($id))
		{
			case DV_Controller::NO_IN_DB :
				$this -> _no_db_result();
				break;
			case DV_Controller::FAIL_PAGE :
				$this -> _fail_page();
				break;
			case DV_Controller::SUCCESS_PAGE :
				$this -> _success_page();
				break;
			default :
				$this -> _fail_page();
				break;
		}
	}

	public function edit($page_url, $field_url, $asc_url, $filter_url)
	{

		$page;
		$field;
		$asc;

		if ($page_url < 0)
		{
			$this -> _no_page();
			return;
		}
		else
		{
			if ($page_url == 0)
			{
				$page = 1;
			}
			else
			{
				$page = $page_url;
			}
		}

		switch($field_url)
		{
			case $this->config->item('edit_role_url_name') :
				$field = 'name';
				break;

			case $this->config->item('edit_role_url_description') :
				$field = 'description';
				break;

			case $this->config->item('edit_role_url_status') :
				$field = 'status';
				break;

			case $this->config->item('edit_role_url_created') :
				$field = 'created';
				break;

			case $this->config->item('edit_role_url_modified') :
				$field = 'modified';
				break;

			# for join and special fields
			# special fields are constructed in-fly - they haven't relational field in database
			case $this->config->item('edit_role_url_users') :
				$field = 'userdm_count';
				break;

			default :
				$field = 'name';
				$field_url = $this -> config -> item('edit_role_url_name');
				break;
		}

		switch($asc_url)
		{
			case $this->config->item('edit_role_url_asc') :
				$asc = 'asc';
				break;

			case $this->config->item('edit_role_url_desc') :
				$asc = 'desc';
				break;

			default :
				$asc = 'asc';
				$asc_url = $this -> config -> item('edit_role_url_asc');
				break;
		}

		$this -> load -> helper(array(
			'form',
			'array'
		));
		$this -> load -> library('role/role_lib');
		$url = $this -> division_builder -> get_path();
		array_pop($url);
		$url = implode('/', $url) . '/';

		$filters = array();
		if ($filter_url != '')
		{
			$filters = $this -> role_lib -> generate_filters($filter_url);
		}

		if ($this -> input -> post('filter'))
		{
			$filters = $this -> role_lib -> generate_filters($this -> input -> post(), $filters);
			$filter_url = $this -> role_lib -> generate_filter_string($filters);
		}

		# DEBUG
		echo('Filter_url: ' . $filter_url . br());

		if (!$this -> input -> post('validation_submit'))
		{
			$this -> load -> view('role/role_c_edit', array(
				'items' => $this -> role_lib -> get_many($page, $this -> config -> item('edit_role_per_page'), $field, $asc, $filters),
				'role_edit_base_url' => $url,
				'role_edit_filter_url' => $filter_url,
				'role_edit_field_url' => $field_url,
				'role_edit_asc_url' => $asc_url,
			));

		}
		else
		{
			$this -> load -> library('form_validation');
			$this -> form_validation -> set_rules('role_delete', $this -> lang -> line('role_edit_form_role_delete'), 'xss_clean');

			if (!$this -> form_validation -> run())
			{
				$this -> load -> view('role/role_c_edit_fail', array(
					'items' => $this -> role_lib -> get_many($page, $this -> config -> item('edit_role_per_page'), $field, $asc, $filters),
					'role_edit_base_url' => $url,
					'role_edit_filter_url' => $filter_url,
					'role_edit_field_url' => $field_url,
					'role_edit_asc_url' => $asc_url,
				));
			}
			else
			{
				switch($this->role_lib->delete_many($this->input->post('role_delete')))
				{
					case -2 :
						$this -> _fail_page($this -> lang -> line('role_content_delete_user_exist'));
						break;
					case 0 :
						$this -> _fail_page();
						break;
					case 1 :
						$this -> _success_page();
						break;
					default :
						$this -> _fail_page();
						break;
				}
			}
		}
	}

}

//End
