<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Default_theme extends DV_Controller 
{

	function __construct()
	{
		parent::__construct();
	}

	function index($params)
	{		
		$this->matchbook->title('My test');
		$this->matchbook->theme_path('themes/default_theme/');
		$this->matchbook->add_stylesheet('style');
		//$this->load->view('default_theme/default_theme');
		//$this->load->view('default_theme/tinymce_test.php');
		$this->load->view('default_theme/my_test.php');
	}

	
}

/* End of file default_theme.php */
/* Location: ./themes/default_theme/controllers/default_theme.php */

?>