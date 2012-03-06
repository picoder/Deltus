<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_crud extends DV_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('crud/grocery_CRUD');	
	}
	
	protected function _output($output = null)
	{
		$this->load->view('tank_auth/user_crud_user_crud.php',$output);	
	}
	
	public function index()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('users');
		$crud->fields('username', 'email', 'activated', 'banned', 'last_login', 'created', 'modified');
		$output =  $crud->render();
		$this->_output($output);
	}



}

//End
