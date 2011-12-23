<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Division_config
{
	public $CI;
	private $_dv_config;
	
	public function __construct()
	{
		$this->CI = & get_instance();
	}
	
	public function set_dv_config($configs)
	{
		$this->_dv_config = $configs;
	}
	
	public function get_dv_config()
	{
		return $this->_dv_config;
		# TEST
		# return array('first_index' =>array('second_index' => 'virtual'),
		#			'test_config_index' => 'from division_config lib',
		#			);
		# END TEST
	}
	
	public function load_dv_configs($config_string)
	{
		if($config_string = '')
		{
			return;
		}
		$configs_from_dv = array();
		$pre_dv_config = array();
		$data_type = array();
		$config_val;
		$two_dimension = array();
		$configs_from_dv = explode(';', $config_string);
		array_pop($configs_from_dv);
		foreach($configs_from_dv as $val)
		{
			$indval = explode('=', $val);
			
			#computing of data type
			$data_type = explode('#', $indval[1]);
			switch($data_type[0])
			{
				case 's':
				$config_val = (string)($data_type[1]);
				break;
				case 'i':
				$config_val = (int)($data_type[1]);
				break;
				case 'f':
				$config_val = (float)($data_type[1]);
				break;
				default:
				die('Wrong data type in division configuration - line 51 of division_config.php');	
			}
			
			# computing of indexes
			$two_dimension = explode(',', $indval[0]);
			if( ! isset($two_dimension[1]))
			{
				$pre_dv_config[$indval[0]] = $config_val;
			}
			else
			{
				$pre_dv_config[$two_dimension[1]][$two_dimension[0]] = $config_val;
			}
		}
		
		# TEST
		# var_dump($pre_dv_config);
		# exit();
		# END TEST
		
		$this->_dv_config = $pre_dv_config;
			
	}
	
	

}

/* End of file division_builder.php */
/* Location: ./modules/division/libraries/division_config.php */