<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_public_lib
{
	public $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function get_item($link)
	{
		$item = new Pagedm();
		$item->where('link', $link)->get();
		// get item libraries
		$g = $item->gallerydm->get();
		return array('item' => $item, 'item_galleries' => $g);
	}
	
	public function get_items($ids)
	{
		$items = new Pagedm();
		$items->where_in('id', $ids)->get();
		return $items; 	
	}
	
	public function get_all_items()
	{
		$items = new Pagedm();
		$items->get();
		return $items; 	
	}

}
