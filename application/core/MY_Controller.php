<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class DV_Controller extends MX_Controller
    {
        private $_permission;
        # if division active (If FALSE we can test frontend without division)
        # backend module is special
        # check $this->method_seg()
        private $_dv;

        const SUCCESS_PAGE = 0;
        const FAIL_PAGE = 1;
        const NO_IN_DB = -1;
        const PERMISSION_NOT_SET = 'permission_not_set';

        public function __construct()
        {
            parent::__construct();
            $this -> load -> helper(array(
                'url',
                'html'
            ));

            /* default value form permission */
            $this -> _permission = 'SITE.ALL.ALL.ALL';
            $this -> _dv = FALSE;
            $this -> lang -> load('no_page', $this -> config -> item('language'));
            $this -> lang -> load('success_page', $this -> config -> item('language'));
            $this -> lang -> load('fail_page', $this -> config -> item('language'));
            $this -> lang -> load('dv_controller', $this -> config -> item('language'));
            
            log_message('error', 'class: '. get_class($this) . '; config-language: ' . $this -> config -> item('language'));
        }

        public function set_permission($permission)
        {
            $this -> _permission = $permission;
        }

        # arg permissions	path to config file with permissions

        public function check_permission($permissions, $default_action)
        {
            $this -> load -> config($permissions);
            if (!array_key_exists($this -> _permission, $this -> config -> config))
            {
                # this permission is not set
                if ($default_action)
                {
                    echo modules::run($default_action);
                }
                return TRUE;
            }
            $this -> load -> library('division/checker');
            foreach ($this->config->item($this->_permission) as $checker => $condition)
            {
                if (!$this -> checker -> $checker($condition))
                {
                    # No permission
                    if ($default_action)
                    {
                        echo modules::run($default_action);
                    }
                    return TRUE;
                }
            }
            # We have persmission to continue
            return FALSE;
        }

        public function test_permission($permissions = 'permissions/permissions_with_priority')
        {
            $this -> load -> config($permissions);
            if (!array_key_exists($this -> _permission, $this -> config -> config))
            {
                // No permission in configs
                // At permission point (where permission started to be testing) system deciedes what to do
                log_message('error', 'permission_not_set');
                return self::PERMISSION_NOT_SET;
            }
            $this -> load -> library('permissions/permission_lib');

            //including priority
            $priorities = array();
            $priorities = $this -> config -> item($this -> _permission);
            if ((!is_array($priorities)) OR empty($priorities))
            {
                return self::PERMISSION_NOT_SET;
            }
            for ($i = 0; $i < count($priorities); $i++)
            {
                foreach ($priorities[$i] as $method => $val)
                {
                    if ($action = $this -> permission_lib -> $method($val))
                    {
                        log_message('error', (String)($action));
                        return $action;
                    }
                }
            }

            # We have persmission to continue
            return FALSE;
        }

        public function main_permission()
        {
            if ($action = $this -> test_permission())
            {
                if (is_string($action))
                {
                    switch($action)
                    {
                        case self::PERMISSION_NOT_SET :
                            log_message('error', 'permission is not set');
                            $this -> _no_permission('Permission is not set for this dv_stop');
                            break;
                        default :
                            echo modules::run($action);
                            break;
                    }
                }
                else
                {
                    $this -> _no_permission('Method which test permission return wrong data type');
                }
                die();
            }
        }

        public function method_seg()
        {
            return $this -> _dv ? 2 : 3;
        }

        public function set_dv($flag)
        {
            $this -> _dv = $flag;
        }

        protected function _no_page($message = FALSE, $view = 'no_page')
        {
            $data['message'] = $message;
            $this -> load -> view($view, $data);
        }

        protected function _success_page($message = FALSE, $view = 'success_page')
        {
            $data['message'] = $message;
            $this -> load -> view($view, $data);
        }

        protected function _fail_page($message = FALSE, $view = 'fail_page')
        {
            $data['message'] = $message;
            $this -> load -> view($view, $data);
        }

        protected function _no_db_result($message = FALSE, $view = 'no_db_result')
        {
            $data['message'] = $message;
            $this -> load -> view($view, $data);
        }
        
        protected function _no_permission($message = FALSE, $view = 'fail_page')
        {
            $data['message'] = $message;
            $this -> load -> view($view, $data);
        }

    }

    /* End of file MY_Controller.php */
    /* Location: ./application/core/MY_Controller.php */
