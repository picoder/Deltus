<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events_test extends MX_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('events/events');
		Events::register('test_string', array($this, 'string_return'));
	}
	
	public function index()
	{
		var_dump(Events::trigger('test_string', 'test', 'string'));
	}
	
	public function string_return()
    {
        return 'I returned a string. Cakes and Pies!';
    }

}

