<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_lib
{
	public $CI;
	
	
	public function __construct()
	{
		$this->CI =& get_instance();
		define('DELETE_EDIT_ONLY', 0); // we can use define only in constructor
		define('FULL', 1);
	}

	
	public function create_form_item($object, $mode)
	{
		$item = '<div class="v_f v item">';
		
		switch($mode)
		{
			case DELETE_EDIT_ONLY:
			$item .= '<div class="l left_1">'.$object->order.'. <label for="object_'.$object->id.'"/>'.$object->label.'</label></div>';
			$item .= '<div class="l left_2">'.anchor('/panel-administracyjny/page-content/update/'.$object->id.'/', 'Edytuj stronę').'</div>';
			$item .= '<div class="l left_3">'.anchor('/panel-administracyjny/page-content/delete/'.$object->id.'/', 'Usuń stronę').'</div>';
			$item .= '<div class="e o"><div class="last_col_inner"><input type="checkbox" name="items_checked[]" value="'.$object->id.'" id="object_'.$object->id.'"/></div></div>';
			break;
			case FULL:
			
			break;
			
		}
		
		$item .= '</div>';
		return $item;
	}
	
	public function items($ids)
	{
		$objects;
		$items = '<div class="v v_f table_edit_header">
		<div class="l left_1">Nazwa</div><div class="l left_2"></div><div class="l left_3"></div><div class="e o t_right">Usuń</div>
		</div>';
		if(is_array($ids))
		{
			$objects = $this->get_objects($ids);
		}
		switch($ids)
		{
			case 'all':
			$objects = $this->get_all_objects();
			break;
			default:	
			$objects = $this->get_all_objects();
		}
		if($objects->result_count() === 0)
		{
			return FALSE;
		}
		
		$i = 1;
		foreach($objects as $object)
		{
			$object->order = $i;
			$items .= $this->create_form_item($object, DELETE_EDIT_ONLY);	
			$i++;
		}
		return $items;
	}
	
	public function get_objects($ids)
	{
		$objects = new Pagedm();
		$objects->where_in('id', $ids)->get();
		return $objects; 	
	}
	
	public function get_all_objects()
	{
		$objects = new Pagedm();
		$objects->get();
		return $objects; 	
	}
	
	public function delete_object($id)
	{
		$object = new Pagedm();
		$object->where('id', $id)->get();
		$object->delete(); // it deletes also with its relations
	}
}

/* End of file page_lib.php */
/* Location: ./modules/page/libraries/page_lib.php */