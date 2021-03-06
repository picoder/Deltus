<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ttp_theme extends DV_Controller 
{

	function __construct()
	{
		parent::__construct();
	}

	function index($params)
	{		
		$this->theme->set_theme_css('ttp_theme', 'v');
		$this->theme->set_theme_css('ttp_theme', 'base');
		$this->theme->set_theme_css('ttp_theme', 'style');
		$this->theme->set_theme_css('ttp_theme', 'orbit');
		
		
		$this->theme->set_theme_js('ttp_theme', 'jquery-1.6.4.min');
		$this->theme->set_theme_js('ttp_theme', 'jquery.easing.1.3');
		$this->theme->set_theme_js('ttp_theme', 'smile');
		$this->theme->set_theme_js('ttp_theme', 'jquery.orbit-1.2.3.min');
		
		$this->theme->set_full("<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>");
		$this->theme->set_full("<link href='http://fonts.googleapis.com/css?family=Marck+Script&subset=latin-ext' rel='stylesheet' type='text/css'>");
		
		$this->theme->set_full("<script type='text/javascript'>
			$(window).load(function() {
				$('#featured').orbit({timer:true, captions:true, advanceSpeed:5000, animationSpeed:800, animation: 'fade', captionAnimationSpeed:800, captionAnimation: 'slideOpen', pauseOnHover: false});
			});
		</script>");
		
		$this->load->view('ttp_theme/ttp_theme');
	}

	
}


?>