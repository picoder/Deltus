<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pati_theme extends DV_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->driver('minify');
	}

	function index($params)
	{		
		//$this->matchbook->title('Samochody z Niemiec | Auto-pati | Elbląg');
		//$this->matchbook->theme_path('themes/pati_theme/');
		//$this->matchbook->add_stylesheet('v');
		//$this->matchbook->add_stylesheet('base');
		//$this->matchbook->add_stylesheet('style');
		//$this->matchbook->add_stylesheet('pati');
		
		//$this->matchbook->add_script('jquery-1.6.4.min');
		
		$this->load->view('pati_theme/pati_theme');
	}

	
}

/* End of file admin_theme.php */
/* Location: ./themes/admin_theme/controllers/admin_theme.php */

?>