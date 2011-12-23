<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* load the MX_Config class */
require APPPATH."third_party/MX/Config.php";

class MY_Config extends MX_Config 
{
	function set_item($item, $value, $index = '')
	{
		
		if($index == '')
		{
			$this->config[$item] = $value;
		}
		else
		{
			$this->config[$index][$item] = $value;
		}
	}
	
	
		// --------------------------------------------------------------------

	/**
	 * Fetch a config file item - integrated with Division
	 *
	 *
	 * @access	public
	 * @param	string	the config item name
	 * @param	string	the index name
	 * @param	bool
	 * @return	string
	 */
	function item($item, $index = '')
	{
		if(class_exists('division_config'))
		{
			$CI = & get_instance();
			$division_config = $CI->division_config->get_dv_config();
			
			if ($index == '')
			{
				if ( ! isset($division_config[$item]))
				{
					if ( ! isset($this->config[$item]))
					{
						return FALSE;	
					}
					else
					{
						$pref = $this->config[$item];
					}
				}
				else
				{
					$pref = $division_config[$item];
				}
			}
			else
			{
				if ( ! isset($division_config[$index]))
				{
					if ( ! isset($this->config[$index]))
					{
						return FALSE;	
					}
					else
					{
						if ( ! isset($this->config[$index][$item]))
						{
							return FALSE;	
						}
						else
						{
							$pref = $this->config[$index][$item];
						}
					}
				}
				else
				{
					if ( ! isset($division_config[$index][$item]))
					{
						return FALSE;	
					}
					else
					{
						$pref = $division_config[$index][$item];
					}
				}

			}
			
			return $pref;
			
		}
		else
		{
			if ($index == '')
			{ 
				if ( ! isset($this->config[$item]))
				{
					return FALSE;
				}
	
				$pref = $this->config[$item];
			}
			else
			{
				if ( ! isset($this->config[$index]))
				{
					return FALSE;
				}
	
				if ( ! isset($this->config[$index][$item]))
				{
					return FALSE;
				}
	
				$pref = $this->config[$index][$item];
			}
			
			return $pref;
		}

	}
}

// END MY_Config class

/* End of file MY_Config.php */