<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth/tank_auth'); // For HMVC
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('tank_auth/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$this->load->view('tank_auth/welcome', $data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */