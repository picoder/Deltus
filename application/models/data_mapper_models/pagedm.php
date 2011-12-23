<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagedm extends DataMapper {

	var $table = 'pages';
	
	var $has_many = array('gallerydm', 'pagecategorydm');
	
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

}

/* End of file pagedm.php */
/* Location: ./application/models/data_mapper_models/pagedm.php */
