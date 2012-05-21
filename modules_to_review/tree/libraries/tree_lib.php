<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tree_lib
{
	public $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function select_tree()
	{
		$this->CI->load->view('tree/select_tree');	
	}
	
	public function menu_tree()
	{
			
	}
}
