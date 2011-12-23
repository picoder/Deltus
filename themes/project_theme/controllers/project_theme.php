<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_theme extends DV_Controller 
{

	function __construct()
	{
		parent::__construct();
	}

	function index($params)
	{		
		$this->matchbook->title('Project theme');
		$this->matchbook->theme_path('themes/project_theme/');
		$this->matchbook->add_stylesheet('v');
		$this->matchbook->add_stylesheet('base');
		$this->matchbook->add_stylesheet('style');
		$this->matchbook->add_ajaxfilemanager();
		$this->matchbook->add_head_snippet('project_theme/parts/ajaxfilemanager_init_head');
		$this->matchbook->add_head_snippet('project_theme/parts/plupload_head');
		$this->load->view('project_theme/project_theme');
	}

	
}

/* End of file project_theme.php */
/* Location: ./themes/project_theme/controllers/project_theme.php */

?>