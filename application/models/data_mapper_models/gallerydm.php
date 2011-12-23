<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallerydm extends DataMapper {

	var $table = 'galleries';
	
	var $has_many = array('simpleofferdm', 'pagedm');
	
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

}

/* End of file gallerydm.php */
/* Location: ./application/models/data_mapper_models/gallerydm.php */
