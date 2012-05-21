<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Backend extends DV_Controller
    {

        public function __construct()
        {
            parent::__construct();
            # we must call it to run paren condtructor - it won't run default

            # First loading default module configs
            $this -> load -> config('backend/backend');
        }

        public function _remap($method)
        {
            $this -> index();
        }

        public function index()
        {
            $this -> division_builder -> set_cur_seg();

            # Setting permissions
            switch($this->uri->segment($this->division_builder->get_cur_seg()))
            {
                case $this->config->item('backend_dashboard_url') :
                    $this -> set_permission('BACKEND.BACKEND.DASHBOARD');
                    break;

                default :
                    $this -> set_permission('BACKEND.BACKEND.DASHBOARD');
                    break;
            }

            $this -> main_permission();

            # Setting permissions
            switch($this->uri->segment($this->division_builder->get_cur_seg()))
            {
                case $this->config->item('backend_dashboard_url') :
                    $this -> division_builder -> set_path($this -> config -> item('add_role_url'));
                    $this -> dashboard();
                    break;

                default :
                    $this -> division_builder -> set_path($this -> config -> item('add_role_url'));
                    $this -> dashboard();
                    break;
            }

        }

        public function dashboard()
        {
            echo 'Dashoboard';
        }

    }
