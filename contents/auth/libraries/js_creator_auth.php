<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Js_creator_auth
{
	public $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
    
    public function test()
    {
        header("content-type: application/x-javascript");
        $serverIP=$_SERVER['REMOTE_ADDR'];
        echo "document.write(\"Your IP address is: <b>" . $serverIP . "</b>\")";
    }
	
	
}

	