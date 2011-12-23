<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fool extends DataMapper { //changed name from foo to show that datamapper models autolad


	var $table = 'foos';
	
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

}

/* End of file foo.php */
/* Location: ./modules/start/models/foo.php */
