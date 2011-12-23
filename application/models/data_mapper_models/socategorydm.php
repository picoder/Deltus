<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Socategorydm extends DataMapper {

	var $table = 'socategories';
	
	var $has_many = array('simpleofferdm');
	
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

}

/* End of file pagedm.php */
/* Location: ./application/models/data_mapper_models/pagedm.php */
