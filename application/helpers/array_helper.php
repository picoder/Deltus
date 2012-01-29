<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('array_to_object'))
{
	function array_to_object($array) {
		if(!is_array($array)) {
			return $array;
		}
		
		$object = new stdClass();
		if (is_array($array) && count($array) > 0) {
		  foreach ($array as $name=>$value) {
			 $name = strtolower(trim($name));
			 if (!empty($name)) {
				$object->$name = array_to_object($value);
			 }
		  }
		  return $object;
		}
		else {
		  return FALSE;
		}
	}
}

if ( ! function_exists('d_array_filter'))
{
	function d_array_filter($array, $callback_func) 
	{
		function delete_empty($val)
		{
			return $val != '';
		}
		
		# it preserves index names
		return array_filter($array, $callback_func);
	}
}


?>