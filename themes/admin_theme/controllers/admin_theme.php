<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_theme extends DV_Controller 
{

	function __construct()
	{
		parent::__construct();
	}

	function index($params)
	{		
		$this->matchbook->title('Panel administracyjny');
		$this->matchbook->theme_path('themes/admin_theme/');
		$this->matchbook->add_stylesheet('v');
		$this->matchbook->add_stylesheet('base');
		$this->matchbook->add_stylesheet('style');
		
		$this->matchbook->add_script('jquery-1.6.4.min');
		
		$this->load->view('admin_theme/admin_theme');
	}

	
}

/* End of file admin_theme.php */
/* Location: ./themes/admin_theme/controllers/admin_theme.php */

?>