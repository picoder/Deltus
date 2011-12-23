<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userdm extends DataMapper {

	var $table = 'users';
	
	var $has_many = array('roledm', 'tempimagedm');
	
	
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

}

/* End of file userdm.php */
/* Location: ./application/models/data_mapper_models/userdm.php */
