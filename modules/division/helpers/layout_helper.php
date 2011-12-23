<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('create_surfaces'))
{
	function create_surfaces($surface_name)
	{
		$CI = &get_instance();
		$surfaces = '<!-- '.$surface_name.' -->';

		if(isset($CI->division_builder->layout[$surface_name]))
		{
			foreach($CI->division_builder->layout[$surface_name] as $view)
			{
				$surfaces .= $view['view'];
			}
		}
		else
		{
			$surfaces .= $surface_name;
		}
		
		return $surfaces;
	}
	
	

}

?>