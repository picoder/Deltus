<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articlecatdm extends DataMapper {

	var $table = 'articlecats';
	
	var $has_many = array('articledm');
	
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

}


