<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roledm extends DataMapper {

	var $table = 'roles';
	 
	var $has_many = array('userdm');
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

}

/* End of file roledm.php */
/* Location: ./application/models/data_mapper_models/roledm.php */
