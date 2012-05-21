<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class So_widgets_lib
{
	public $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function newest($params = array())
	{
		$items = array();
		$so = new Simpleofferdm();
		$so->order_by('created', 'asc')->get(empty($params) ? 5 : $params['num_of_items']);
		
		// get item libraries
		foreach($so as $item)
		{
			$g = $item->gallerydm->get();
			//we get first gallery
			$items[] = array('item' => $item, 'item_gallery' => $g->id);
		}
		return $items;
	}

}
