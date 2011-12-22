<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tempimagedm extends DataMapper {

	var $table = 'tempimages';
	
	var $has_one = array('userdm');
	
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

}

/* End of file tempimagedm.php */
/* Location: ./application/models/data_mapper_models/tempimagedm.php */
