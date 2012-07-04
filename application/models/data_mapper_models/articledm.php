<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articledm extends DataMapper {

	var $table = 'articles';
	
	var $has_many = array('articlecatdm');
	
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

}


