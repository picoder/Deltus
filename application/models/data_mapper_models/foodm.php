<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Foodm extends DataMapper {

	public $table = 'foos';
	
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

}

/* End of file foodm.php */
/* Location: ./modules/start/models/foodm.php */
