<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kako_back_theme extends DV_Controller 
{

	function __construct()
	{
		parent::__construct();
	}

	function index($params)
	{
	    $this->theme->set_full("<link href='http://fonts.googleapis.com/css?family=Comfortaa:700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>");		
		$this->theme->set_theme_css('kako_theme', 'v');
		$this->theme->set_theme_css('kako_theme', 'main');
        $this->theme->set_theme_css('kako_theme', 'style_back');

		$this->load->view('kako_theme/kako_back_theme');
	}

	
}


?>