<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Division_builder
{
	public $CI;
	
	public $contents;
	public $widgets;
	
	public $layout;
	
	private $_url;
	
	public function __construct()
	{
		$this->CI = & get_instance();
	}
	
	public function set_dv_url($url)
	{
		$this->_url = $url;
	}
	
	function get_dv_url()
	{
		return $this->_url;
	}
	
	function get_division($url)
	{
		$d = new Divisiondm();
		return $d->where('url', $url)->get();
		
	}
	
	function separate_functions($string)
	{
		$functions = explode('|-|', $string);
		$new_funcs = array();
		foreach($functions as $func)
		{
			if($func != '')
			{
				$new_funcs[] = $func;
			}
		}
		return $new_funcs;
	}
	
	function build_function($func)
	{
		$function = explode('->', $func);
		return $function[0];
	}
	
	function build_params($command)
	{
		$pos = strpos($command, '&');
		// we delete checkers and lang info
		$func = substr($command, 0, $pos);
		$function = explode('->', $func);
		$params = explode('-|', $function[1]);
		$new_params = array();
		foreach($params as $param)
		{
			if($param != '')
			{
				$new_params[] = $param;
			}
		}
		return $new_params;
	}
	
	function get_lang($command)
	{
		$pos_start = strpos($command, '->lang[') + 7;
		$length = strpos($command, ']', $pos_start) - $pos_start;
		return substr($command, $pos_start, $length);
	}
	
	function get_checkers($command)
	{
		$pos_start = strpos($command, '&checkers[') + 10;
		$length = strpos($command, ']', $pos_start) - $pos_start;
		return substr($command, $pos_start, $length);
	}
	
	function find_checkers($data)
	{
		if($data == '')
		{
			return TRUE;	
		}
		$types = explode(';', $data);
		array_pop($types);
		$checkers = array();
		$i = 0;
		foreach($types as $type)
		{
			$pos = strpos($type, ':');
			$checkers[$i]['type'] = substr($type, 0, $pos);
			$compares = substr($type, $pos + 1);
			$compares_array = explode(',', $compares);
			// we must declare and define at once because some checkers could have no params
			$checkers[$i]['params'] = array();
			foreach($compares_array as $comp)
			{
				$checkers[$i]['params'][] = $comp; 	
			}
			$i++;
		}	
		
		$this->CI->load->library('division/checker');
		
		foreach($checkers as $checker) // each cheecker must give us access
		{
			if( ! $this->CI->checker->$checker['type']($checker['params']))
			{ 
				return FALSE;
			}
		}
		return TRUE; //after all checkers passed given conditions
		
			
	}
	
	function set_position($command, $surface)
	{
		$pos_start = strpos($command, '->box[') + 6;
		$length = strpos($command, ']', $pos_start) - $pos_start;
		$position = substr($command, $pos_start, $length);
		$keys = explode(':', $position);
		$this->layout[$keys[0]][intval($keys[1])] = $surface;
		$this->layout[$keys[0]][intval($keys[1])]['loading_order'] = $this->_set_loading_order($command);
	}
	
	// if loading_order == 0 it means that there is no need to set order, it is not important param for this function in context of loading
	// By default all surfaces have this param equal to 0
	private function _set_loading_order($command)
	{
		$pos_start = strpos($command, '->loading_order[') + 16;
		$length = strpos($command, ']', $pos_start) - $pos_start;
		return intval(substr($command, $pos_start, $length));
	}

}

/* End of file division_builder.php */
/* Location: ./modules/division/libraries/division_builder.php */