<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lab_theme extends DV_Controller 
{

	function __construct()
	{
		parent::__construct();
	}

	function index($params)
	{		
		$this->theme->set_theme_css('lab_theme', 'v');
		$this->theme->set_theme_css('lab_theme', 'base');
		$this->theme->set_theme_css('lab_theme', 'style');
		
		$this->load->view('lab_theme/lab_theme');
	}

	
}


?>