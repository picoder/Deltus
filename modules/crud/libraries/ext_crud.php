<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'grocery_crud.php';

class ext_crud extends grocery_crud
{
/**
	 * 
	 * Constructor
	 * 
	 * @access	public
	 */
	public function __construct()
	{

	}		
	
	public function test()
	{
		echo 'ok';
	}
	
	public function edit_form($id)
	{
		echo 'ok';
	}
}