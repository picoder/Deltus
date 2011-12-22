<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simple_offer_lib
{
	public $CI;
	
	
	public function __construct()
	{
		$this->CI =& get_instance();
		define('DELETE_EDIT_ONLY', 0); // we can use define only in constructor
		define('FULL', 1);
	}

	
	public function create_so_form_item($so, $mode)
	{
		$item = '<div class="v_f v so">';
		
		switch($mode)
		{
			case DELETE_EDIT_ONLY:
			$item .= '<div class="l left_1">'.$so->order.'. <label for="so_'.$so->id.'"/>'.$so->label.'</label></div>';
			$item .= '<div class="l left_2">'.anchor('/panel-administracyjny/simple-offer-content/update/'.$so->id.'/', 'Edytuj ofertę').'</div>';
			$item .= '<div class="l left_3">'.anchor('/panel-administracyjny/simple-offer-content/delete/'.$so->id.'/', 'Usuń ofertę').'</div>';
			$item .= '<div class="e o"><input type="checkbox" name="so_items_checked[]" value="'.$so->id.'" id="so_'.$so->id.'"/></div>';
			break;
			case FULL:
			
			break;
			
		}
		
		$item .= '</div>';
		return $item;
	}
	
	public function so_items($so_ids)
	{
		$so_items = '<div class="v v_f table_edit_header">
		<div class="l left_1">Nazwa</div><div class="l left_2"></div><div class="l left_3"></div><div class="e o t_right">Usuń</div>
		</div>';
		$so_objects;
		if(is_array($so_ids))
		{
			$so_objects = $this->get_so_objects($so_ids);
		}
		switch($so_ids)
		{
			case 'all':
			$so_objects = $this->get_all_so_objects();
			break;
			default:	
			$so_objects = $this->get_all_so_objects();
			
		}
		if($so_objects->result_count() === 0)
		{
			return FALSE;
		}
		$i = 1;
		foreach($so_objects as $so)
		{
			$so->order = $i;
			$so_items .= $this->create_so_form_item($so, DELETE_EDIT_ONLY);	
			$i++;
		}
		return $so_items;
	}
	
	public function get_so_objects($so_ids)
	{
		$so_objects = new Simpleofferdm();
		$so_objects->where_in('id', $so_ids)->get();
		return $so_objects; 	
	}
	
	public function get_all_so_objects()
	{
		$so_objects = new Simpleofferdm();
		$so_objects->get();
		return $so_objects; 	
	}
	
	public function delete_so_object($id)
	{
		$so = new Simpleofferdm();
		$so->where('id', $id)->get();
		$so->delete(); // it deletes also with its relations
	}
}

/* End of file simple_offer_lib.php */
/* Location: ./modules/simple_offer/libraries/simple_offer_lib.php */