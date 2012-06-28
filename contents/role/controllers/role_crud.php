<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    /*
     *  Class for handling crud operations in role module
     */

    class Role_crud extends DV_Controller
    {
        public $editing_id = null;

        public function __construct()
        {
            parent::__construct();
            $this -> load -> library('crud/grocery_crud');
            $this -> grocery_crud -> module = "role/role_crud";
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
                case 'crud-edit' :
                # $this -> set_permission('ROLE.ROLE_CRUD.ROLE_CRUD');
                    break;
            }

            # Checking permissions
            if ($this -> check_permission('permissions/permissions', 'permissions/permissions/default_no_permission'))
            {
                # Additional steps if no permission
                return;
            }

            switch($this->uri->segment($this->division_builder->get_cur_seg()))
            {
                case 'crud-edit' :
                    $this -> division_builder -> set_path('crud-edit');
                    if ($this -> uri -> segment($this -> division_builder -> get_cur_seg() + 2) == 'edit')
                    {
                        $this -> editing_id = ($this -> uri -> segment($this -> division_builder -> get_cur_seg() + 3));
                    }
                    $this -> edit();
                    break;
            }
        }

        protected function _output($output = null)
        {
            $this -> load -> view('role/role_crud_edit.php', $output);
        }

        public function edit()
        {
            try
            {
                $this -> grocery_crud -> set_table('roles');
                $this -> grocery_crud -> columns('name', 'description', 'include', 'status', 'users_assigned', 'created', 'modified');
                $this -> grocery_crud -> callback_column('users_assigned', array(
                    $this,
                    'callback_column_users_assigned'
                ));
                $this -> grocery_crud -> add_fields('name', 'description', 'include', 'status', 'created', 'modified');
                $this -> grocery_crud -> edit_fields('name', 'description', 'include', 'status', 'modified');
                $this -> grocery_crud -> callback_add_field('include', array(
                        $this,
                        'callback_add_include'
                    ));
                    
                $this -> grocery_crud -> callback_edit_field('include', array(
                        $this,
                        'callback_edit_include'
                    ));
                $this -> grocery_crud -> callback_add_field('status', array(
                        $this,
                        'callback_add_status'
                    ));
                    
                $this -> grocery_crud -> callback_edit_field('status', array(
                        $this,
                        'callback_edit_status'
                    ));
                $this -> grocery_crud -> change_field_type('created', 'hidden', 0);
                $this -> grocery_crud -> change_field_type('modified', 'hidden', 0);
                $this -> grocery_crud -> callback_before_insert(array(
                    $this,
                    'callback_before_insert'
                ));
                $this -> grocery_crud -> callback_before_update(array(
                    $this,
                    'callback_before_update'
                ));
                $this -> grocery_crud -> set_rules('name', 'Name', 'required|callback_role_name_check');
                $this -> grocery_crud -> callback_escape_delete(array(
                    $this,
                    'callback_escape_delete'
                ));
                $output = $this -> grocery_crud -> render();
                $this -> _output($output);

            }
            catch(Exception $e)
            {
                show_error($e -> getMessage());
            }
        }

        public function callback_column_users_assigned($id, $row)
        {
            $this -> load -> library('role/role_lib');

            return $this -> role_lib -> count_assigned_users($row -> id);
        }

        public function callback_before_insert($post_array)
        {
            $post_array['created'] = date('c');
            $post_array['modified'] = date('c');
            return $post_array;
        }

        public function callback_before_update($post_array, $id)
        {
            $post_array['modified'] = date('c');
            return $post_array;
        }

        public function role_name_check($str)
        {
            $id = $this -> uri -> segment($this -> division_builder -> get_cur_seg() + 3);
            if ($id != null AND is_numeric($id))
            {
                $name_old = $this -> db -> where("id", $id) -> get('roles') -> row() -> name;
                $this -> db -> where("name !=", $name_old);
                log_message('error', 'ok');
            }
            $num_row = $this -> db -> where('name', $str) -> get('roles') -> num_rows();
            if ($num_row >= 1)
            {
                $this -> form_validation -> set_message('role_name_check', 'The %s field with value ' . $str . ' exists in system');
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }

        public function callback_escape_delete($id)
        {
            $this -> load -> library('role/role_lib');
            if ($this -> role_lib -> count_assigned_users($id) > 0)
            {
                throw new Exception("You cannot delete role with assigned users", 14);
                die();
            }
            else
            {
                $this -> db -> delete('roles', array('id' => $id));
            }
        }
        
        public function callback_add_include()
        {
            return '<select name="include"><option value="0">0</option><option value="1">1</option></select>';
        }
        
        public function callback_edit_include($value, $id)
        {
            $possible_vals = array(0, 1);
            
            $keys = array_keys($possible_vals, $value);
            
            unset($possible_vals[$keys[0]]);
            
            $output =  '<select name="include">';
            $output .= '<option val="'.$value.'" selected>'.$value.'</option>';
            foreach($possible_vals as $opt)
            {
                $output .= '<option value="'.$opt.'">'.$opt.'</option>';
            }
            return $output.'</select>';
        }
        
        public function callback_add_status()
        {
            return '<select name="status"><option value="0">0</option><option value="1">1</option></select>';
        }
        
        public function callback_edit_status($value, $id)
        {
            $possible_vals = array(0, 1);
            
            $keys = array_keys($possible_vals, $value);
            
            unset($possible_vals[$keys[0]]);
            
            $output =  '<select name="status">';
            $output .= '<option val="'.$value.'" selected>'.$value.'</option>';
            foreach($possible_vals as $opt)
            {
                $output .= '<option value="'.$opt.'">'.$opt.'</option>';
            }
            return $output.'</select>';
        }

    }
