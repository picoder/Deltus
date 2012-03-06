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
	
	public function user_crud()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('users');
		$crud->fields('username', 'email', 'activated', 'banned', 'last_login', 'created', 'modified');
		echo $crud->render();
	}



}

//End
