<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_crud extends DV_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('crud/grocery_CRUD');
		$this->load->library('theme/theme');		
	}
	
	public function _remap($method)
	{
		$this -> index();
	}
	
	public function index()
	{
		$this -> division_builder -> set_cur_seg();
				
				switch($this->uri->segment($this->division_builder->get_cur_seg()))
				{
					case 'crud-edit' :
						# $this -> set_permission('TANK_AUTH.USER_CRUD.CRUD_EDIT');
						break;
					case 'crud-update-password' :
						
						break;
				}
				
				# Checking permissions
				if ($this -> check_permission('permissions/permissions', 'permissions/permissions/default_no_permission'))
				{
					# Additional steps if no permission
					return;
				}
				
				switch($this->uri->segment($this->division_builder->get_cur_seg()))
				{
					case 'crud-edit' : # grocery_crud use 'edit' as keyword
						$this -> division_builder -> set_path('crud-edit');
						$this->edit();
						break;
					case 'crud-update-password' :
						$this -> division_builder -> set_path('crud-update-password');
						$id = $this->uri->segment($this->division_builder->get_cur_seg() + 1);
						$this->update_password($id);
						break;
				}
		
	}
	
	protected function _output($output = null)
	{
		$this->load->view('tank_auth/user_crud_edit.php',$output);	
	}
	
	public function edit()
	{
		$url_array = $this -> division_builder -> get_path();
		array_pop($url_array);
		$url = implode('/', $url_array) . '/';
		
		$crud = new grocery_CRUD();
		$crud->set_table('users');
		$crud->columns('username', 'email', 'activated', 'banned', 'last_login', 'created', 'modified');
		$crud->add_fields('username', 'email', 'password', 'banned');
		$crud->edit_fields('username', 'email', 'banned');
		
		$crud->callback_before_insert(array($this,'hash_password'));
		$crud->add_action('Smileys', 'http://www.nulledtemplates.com/images/ActiveDen-Extendable-Photo-Gallery-Rip_-evia_2.png', $url.'crud-update-password');
		$output = $crud->render();
		$this->_output($output);
	}
	
	public function update_password($id)
	{
				$this->load->library('crud/ext_crud');
				$this->ext_crud->edit_form($id);
		
	}
	
	public function hash_password($post_array)
	{
		$this->load->library('tank_auth/tank_auth');
		$post_array['password'] = $this->tank_auth->use_hasher($post_array['password']);
    	return $post_array;
	}



}

//End
