<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Division_config
    {
        public $CI;
        private $_dv_config;

        public function __construct()
        {
            $this -> CI = &get_instance();
        }

        public function set_dv_config($configs)
        {
            $this -> _dv_config = $configs;
        }

        public function get_dv_config()
        {
            return $this -> _dv_config;
            # TEST
            # return array('first_index' =>array('second_index' => 'virtual'),
            #			'test_config_index' => 'from division_config lib',
            #			);
            # END TEST
        }

        public function load_dv_configs($config_string)
        {
            if ($config_string == '')
            {
                return;
            }

            $pre_dv_config = array();

            $two_dimension = array();

            $configs_from_dv = explode(';', $config_string);

            array_pop($configs_from_dv);

            foreach ($configs_from_dv as $val)
            {
                $indval = explode('=', $val);

                # computing of indexes
                $two_dimension = explode(',', $indval[0]);
                if (!isset($two_dimension[1]))
                {
                    $pre_dv_config[$indval[0]] = $this -> build_value($indval[1]);
                }
                else
                {
                    $pre_dv_config[$two_dimension[1]][$two_dimension[0]] = $this -> build_value($indval[1]);
                }
                
               //var_dump($this->build_value($indval[1]));
            }

            # TEST
            # var_dump($pre_dv_config);
            # exit();
            # END TEST

            $this -> _dv_config = $pre_dv_config;
        }

        public function build_value($data)
        {
            $output_arr = array();
            # check if there is array
            $pos_arr = strpos($data, 'a(');
            if ($pos_arr !== FALSE)
            {
                $arr = substr($data, $pos_arr + 2, strrpos($data, ')') - 2);

                
                
                $key_val = explode('|', $arr, 2);
                log_message('error', 'inside: '.$arr);
                
                # var_dump($key_val);
                $temp = array();
                $temp[$this->get_data_types($key_val[0])] = $this->build_value($key_val[1]);
                
                return $temp;
                
            }
            else
            {
                return $this -> get_data_types($data);
            }
        }

        public function get_data_types($data)
        {
            
            #computing of data type
            $config_val = null;

            $data_type = explode('#', $data);
            switch($data_type[0])
            {
                case 'b' :
                    $config_val = (bool)($data_type[1]);
                    break;
                case 's' :
                    $config_val = (string)($data_type[1]);
                    break;
                case 'i' :
                    $config_val = (int)($data_type[1]);
                    break;
                case 'f' :
                    $config_val = (float)($data_type[1]);
                    break;
                default :
                    log_message('error', 'no data type: ' . $data);
                    # die('Wrong data type - division/libraries/division_config.php');
            }

            return $config_val;
        }

    }

    /* End of file division_builder.php */
    /* Location: ./modules/division/libraries/division_config.php */
