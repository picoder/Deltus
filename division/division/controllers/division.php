<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Division extends DV_Controller
    {

        function __construct()
        {
            parent::__construct();

            $this -> load -> library('division/division_builder');

            $this -> load -> helper(array('layout'));

            $this -> load -> config('division/division', TRUE);

            $this -> set_dv(TRUE);
            # For testing without divisions - see MY_Controller.php

            $this -> division_builder -> set_dv_url($this -> config -> item('app_default_url', 'division'));

            # Matchbook for assets and layouts
            # $this -> load -> library('matchbook/matchbook');
            # $this -> load -> helper('matchbook/matchbook');

            #to replace matchbook
            $this -> load -> library('theme/theme');
        }

        public function _remap($method)
        {
            $this -> index();
        }

        public function index()
        {
            if ($this -> uri -> segment(1))
            {
                $this -> division_builder -> set_dv_url($this -> uri -> segment(1));
            }

            switch($dv_url = $this->division_builder->get_dv_url())
            {

                # Special urls are static
                case 'ajax-division' :
                case 'file-creator' :
                    $module = $this -> uri -> segment(2);
                    $controller = $this -> uri -> segment(3);
                    $method = $this -> uri -> segment(4);
                    $this -> load -> module($module . '/' . $controller);
                    $this -> $controller -> $method();
                    break;

                default :
                    $division = $this -> division_builder -> get_division($dv_url);

                    if (($division -> id === NULL))
                    {
                        die('Division is empty | Site does not exist');
                    }

                    if ($division -> status === 0)
                    {
                        die('Status of division is 0 | Site does not exist');
                    }

                    $this -> load -> library('division/division_config');
                    # so now we can put divsion configs

                    $this -> division_config -> load_dv_configs($division -> configurations);

                    # Language
                    $this -> config -> set_item('language', $this -> config -> item('deltus_language'));

                    $this -> set_permission('DIVISION.ALL.ALL.ALL');

                    /*
                     if($this->check_permission('permissions/permissions', 'division/division/no_dv_permission'))
                     {
                     return;
                     //die('No permission for division | redirect ');
                     }
                     */

                    if ($action = $this -> test_permission())
                    {
                        if (is_string($action))
                        {
                            switch($action)
                            {
                                case DV_Controller::PERMISSION_NOT_SET :
                                    log_message('error', 'permission is not set');
                                    $this -> no_dv_permission();
                                    break;
                                default :
                                    echo modules::run($action);
                                    break;
                            }
                        }
                        else
                        {
                            $this -> no_dv_permission();
                        }
                        return;
                    }

                    # Contents
                    if ($division -> contents != '')
                    {
                        $functions = $this -> division_builder -> separate_functions($division -> contents);
                        $i = 0;
                        foreach ($functions as $function)
                        {
                            $checkers_cond = TRUE;
                            if (!$this -> config -> item('no_checkers_for_surfaces', 'division'))
                            {
                                $checkers_cond = $this -> division_builder -> find_checkers($this -> division_builder -> get_checkers($function));
                                log_message('error', $checkers_cond);
                            }
                            if ($checkers_cond)
                            {
                                $this -> division_builder -> contents[$i]['function'] = $this -> division_builder -> build_function($function);
                                $this -> division_builder -> contents[$i]['lang'] = $this -> division_builder -> get_lang($function);
                                $this -> division_builder -> contents[$i]['params'] = $this -> division_builder -> build_params($function);
                                $this -> division_builder -> set_position($function, $this -> division_builder -> contents[$i]);
                            }
                            ++$i;
                        }
                        #DEBUG: var_dump($this->division_builder->layout);
                    }

                    # Widgets
                    if ($division -> widgets != '')
                    {
                        $functions = $this -> division_builder -> separate_functions($division -> widgets);
                        $i = 0;
                        foreach ($functions as $function)
                        {
                            $checkers_cond = TRUE;
                            if (!$this -> config -> item('no_checkers_for_surfaces', 'division'))
                            {
                                $checkers_cond = $this -> division_builder -> find_checkers($this -> division_builder -> get_checkers($function));
                            }
                            if ($checkers_cond)
                            {
                                $this -> division_builder -> widgets[$i]['function'] = $this -> division_builder -> build_function($function);
                                $this -> division_builder -> widgets[$i]['lang'] = $this -> division_builder -> get_lang($function);
                                $this -> division_builder -> widgets[$i]['params'] = $this -> division_builder -> build_params($function);
                                $this -> division_builder -> set_position($function, $this -> division_builder -> widgets[$i]);
                            }
                            ++$i;
                        }
                        #DEBUG: var_dump($this->division_builder->layout);
                    }

                    # Layout
                    # First we load all function in order which was set by loading_order param

                    $surfaces_loading_order = array();
                    $surfaces_content = array();
                    $i = 0;

                    if (!empty($this -> division_builder -> layout))
                    {

                        foreach ($this->division_builder->layout as $position_key => $subpositions)
                        {
                            foreach ($subpositions as $subposition_key => $params)
                            {
                                $surfaces_loading_order["$i"] = $params['loading_order'];
                                $surfaces_content["$i"] = $params;
                                $this -> division_builder -> layout[$position_key][$subposition_key]['alias_key'] = "$i";
                                $i++;
                            }
                        }

                        asort($surfaces_loading_order, SORT_NUMERIC);

                        # DEBUG: var_dump($this->division_builder->layout);

                        foreach ($surfaces_loading_order as $key => $val)
                        {
                            $surfaces_content[$key]['view'] = modules::run($surfaces_content[$key]['function'], $surfaces_content[$key]['params'], $surfaces_content[$key]['lang']);
                        }

                        # DEBUG: var_dump($this->division_builder->layout); die();

                        foreach ($this->division_builder->layout as $position_key => $subpositions)
                        {
                            foreach ($subpositions as $subposition_key => $params)
                            {
                                $this -> division_builder -> layout[$position_key][$subposition_key]['view'] = $surfaces_content[$this -> division_builder -> layout[$position_key][$subposition_key]['alias_key']]['view'];
                            }
                        }

                    }
                    $this -> division_builder -> layout['view'] = modules::run($this -> division_builder -> build_function($division -> layout), $this -> division_builder -> build_params($division -> layout));
                # DEBUG: print_r($this->division_builder->layout);
            }# switch $dv_url

            # We set layout
            echo $this -> division_builder -> layout['view'];

            switch (ENVIRONMENT)
            {
                case 'development' :
                    $this -> output -> enable_profiler(FALSE);
                    break;

                case 'testing' :
                    $this -> output -> enable_profiler(TRUE);
                    break;
            }

        }

        # To replace all die() functions in this file in future
        public function no_dv_site()
        {
            $this -> _no_page();
        }

        public function no_dv_permission()
        {
            echo 'No dv permission - default action';
        }

        public function test()
        {
            echo 'test';
        }

        # TODO Write the rest of the code for Division
    }

    /* End of file division.php */
    /* Location: ./modules/division/controllers/division.php */
