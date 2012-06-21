<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kako_auth_theme extends DV_Controller 
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
        $this->theme->set_theme_css('kako_theme', 'style_auth');
        
        // We must use set_full beacuse there are relative urls in css file
        $this->theme->set_full("<link href='".base_url()."extends/idealforms/css/jquery.idealforms.css'  rel='stylesheet' type='text/css'>");
        
        $this->theme->set_theme_js('kako_theme', 'jquery-1.7.2.min', '', 'body');
        
        $this->theme->set_ext_js('idealforms', 'js/min/jquery.idealforms.min', 'body');
		
		$this->load->view('kako_theme/kako_auth_theme');
	}

	
}


?>