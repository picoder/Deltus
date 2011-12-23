<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simpleofferdm extends DataMapper {

	var $table = 'simpleoffers';
	
	var $has_many = array('gallerydm', 'socategorydm');
	
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

}

/* End of file simpleofferdm.php */
/* Location: ./application/models/data_mapper_models/simpleofferdm.php */
