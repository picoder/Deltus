<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    /*
     *  Class for handling crud operations in file module
     */
  
  class File_crud extends DV_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->config('file/file');
            $this -> load -> library('crud/grocery_crud');
            $this -> grocery_crud -> module = "file/file_crud";
            $this -> load -> library('theme/theme');

        }
        
        public function _remap($method)
        {
            $this -> index();
        }
        
        public function index()
        {
            $this -> division_builder -> set_cur_seg();
            
            switch($this->uri->segment($this->division_builder->get_cur_seg()))
            {
                case $this->config->item('file.file_crud.edit.url') :
                    $this -> set_permission('FILE.FILE_CRUD.EDIT');
                    break;

                default :
                    $this -> set_permission('FILE.FILE_CRUD.EDIT');
                    break;
            }

            $this -> main_permission();

            switch($this->uri->segment($this->division_builder->get_cur_seg()))
            {
                case $this->config->item('file.file_crud.edit.url') :
                    $this -> division_builder -> set_path($this->config->item('file.file_crud.edit.url'));
                    $this -> _edit();
                    break;

                default :
                    $this -> division_builder -> set_path($this->config->item('file.file_crud.edit.url'));
                    $this -> _edit();
                    break;
            }

        }
        
        protected function _output($output = null)
        {
            $this -> load -> view('file/file_crud__edit.php', $output);
        }
        
        protected function _edit()
        {
            try
            {
                $this -> grocery_crud -> set_table('fotogalfiles');
                
                $this ->grocery_crud->set_field_upload('path','uploads/fotogalfiles');
 
                $output = $this ->grocery_crud->render();
             
                $this->_output($output);
            }
            catch(Exception $e)
            {
                show_error($e -> getMessage());
            }
        }
    }  