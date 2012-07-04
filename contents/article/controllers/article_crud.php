<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    /*
     *  Class for handling crud operations in article module
     */

    class Article_crud extends DV_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->config('article/article');
            $this -> load -> library('crud/grocery_crud');
            $this -> grocery_crud -> module = "article/article_crud";
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
                case $this->config->item('article.article_crud.edit.url') :
                    $this -> set_permission('ARTICLE.ARTICLE_CRUD.EDIT');
                    break;
                    
                case $this->config->item('article.article_crud.category_edit.url') :
                    $this -> set_permission('ARTICLE.ARTICLE_CRUD.CATEGORY_EDIT');
                    break;

                default :
                    $this -> set_permission('ARTICLE.ARTICLE_CRUD.EDIT');
                    break;
            }

            $this -> main_permission();

            switch($this->uri->segment($this->division_builder->get_cur_seg()))
            {
                case $this->config->item('article.article_crud.edit.url') :
                    $this -> division_builder -> set_path($this->config->item('article.article_crud.edit.url'));
                    $this -> _edit();
                    break;
                    
                case $this->config->item('article.article_crud.category_edit.url') :
                    $this -> division_builder -> set_path($this->config->item('article.article_crud.category_edit.url'));
                    $this -> _category_edit();
                    break;
                    
                case 'test':
                    $this -> division_builder -> set_path('test');
                    $this -> _test();
                    break;

                default :
                    $this -> division_builder -> set_path($this->config->item('article.article_crud.edit.url'));
                    $this -> _edit();
                    break;
            }

        }

        protected function _output($output = null)
        {
            $this -> load -> view('article/article_crud__edit.php', $output);
        }
        
        protected function _test()
        {
            $this->load->library('article/articlecat_lib');
            $dmo = new Articlecatdm();
            $items = $dmo -> where('family_id', 1) -> get();
        }

        protected function _edit()
        {
            try
            {
                $this -> grocery_crud -> set_table('articles');
                
                $this -> grocery_crud -> columns('name', 'category', 'description', 'title', 'url', 'content', 'status', 'created', 'modified');
                $this -> grocery_crud -> add_fields('name', 'category', 'description', 'title', 'url', 'content', 'status');
                $this -> grocery_crud -> edit_fields('name', 'category', 'description', 'title', 'url', 'content', 'status');
                
                $this -> grocery_crud -> set_relation_n_n('category', 'articlecats_articles', 'articlecats', 'articledm_id', 'articlecatdm_id', 'label');
                
                
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
                $this -> grocery_crud -> callback_add_field('status', array(
                        $this,
                        'callback_add_status'
                    ));
                $this -> grocery_crud -> callback_edit_field('status', array(
                        $this,
                        'callback_edit_status'
                    ));
                
                $output = $this -> grocery_crud -> render();
                $this -> _output($output);
            }
            catch(Exception $e)
            {
                show_error($e -> getMessage());
            }
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
        
        protected function _category_edit()
        {
            try
            {
                $this -> grocery_crud -> set_table('articlecats');
                
                # $this -> grocery_crud -> unset_columns('parent', 'extra_table', 'family_id', 'level');
                $this -> grocery_crud -> columns('name', 'label', 'link', 'status', 'parent_id', 'order', 'islast', 'articles_assigned');
                $this -> grocery_crud -> fields('name', 'label', 'link', 'status', 'parent');
                
                # columns callbacks
                $this -> grocery_crud -> callback_column('articles_assigned', array(
                    $this,
                    'callback_column_articles_assigned'
                ));
                
                # add callbacks
                $this -> grocery_crud -> callback_add_field('status', array(
                        $this,
                        'callback_add_status'
                    ));
                $this -> grocery_crud -> callback_add_field('parent', array(
                        $this,
                        'callback_add_parent'
                    ));
                $this -> grocery_crud -> callback_after_insert(array(
                    $this,
                    'callback_after_cat_insert'
                ));    
                
                # edit callbacks    
                $this -> grocery_crud -> callback_edit_field('status', array(
                        $this,
                        'callback_edit_status'
                    ));
                $this -> grocery_crud -> callback_edit_field('parent', array(
                        $this,
                        'callback_edit_parent'
                    ));
                $this -> grocery_crud -> callback_escape_update(array(
                    $this,
                    'callback_escape_cat_update'
                ));
                    
                # delete callbacks
                $this -> grocery_crud -> callback_escape_delete(array(
                    $this,
                    'callback_escape_cat_delete'
                ));
                
                
                $output = $this -> grocery_crud -> render();
                $this -> _output($output);
            }
            catch(Exception $e)
            {
                show_error($e -> getMessage());
            }
        }

        public function callback_column_articles_assigned($value, $row)
        {
            $this -> load -> library('article/articlecat_lib');

            return $this -> articlecat_lib -> count_assigned_articles($row -> id);
        }

        public function callback_add_parent()
        {
            $this->load->library('article/articlecat_lib');
            $soca = new Articlecatdm();
            $socas = $soca->get();
            return $this->articlecat_lib->formpart_parent_soca($socas);
        }
        
        public function callback_edit_parent($val, $id)
        {
            $this->load->library('article/articlecat_lib');
            $soca = new Articlecatdm();
            $socas = $soca->get();
            $soca = new Articlecatdm();
            $soca -> where('id', $id) -> get();   
            $soca_parent = new Articlecatdm();
            $soca_parent -> where('id', $soca -> parent_id) -> get(); 
            return $this -> articlecat_lib -> formpart_parent_soca($socas, $this -> articlecat_lib -> option_value($soca_parent), $id);
        }
        
        public function callback_after_cat_insert($post_array, $id)
        {
            $this->load->library('article/articlecat_lib');
            $soca = new Articlecatdm();
            $soca -> where('id', $id) -> get();
            $soca -> tree = $post_array['tree'];
            $this->articlecat_lib->update_tree($soca);
        }
        
        public function callback_escape_cat_update($post_array, $id)
        {
            $parent_id;
            $id_parent;
            $family_id;
            $level;
            $islast_parent;
            if($post_array['tree'] == 'root') # when we create main category
            {
                $parent_id = 0;
                $level = 0;
                $family_id = 0;
                $id_parent = 0;
                $islast_parent = 0;
            }
            else 
            {
                $tree = explode('|', $post_array['tree']);
                $id_parent = (int)$tree[0]; # id of parent from parent category select
                $family_id = ((int)$tree[1] == 0) ? $id_parent : (int)$tree[1];
                $level = 1 + (int)$tree[2];
                $parent_id = $id_parent;
                $islast_parent = (int)$tree[3];
            }
            
            # checking if parent category has been changed
            $dmo = new Articlecatdm();
            $dmo -> where('id', $id) -> get();
            
            if($dmo -> parent_id != $id_parent)
            {
                # parent category has been changed
                $post_array['parent_id'] = $parent_id;
                $post_array['family_id'] = $family_id;
                $post_array['level'] = $level;
                $diff = $level - $dmo -> level;
                
                
                # we must change family_id and level in all descendants of chnaged category item
                log_message('error', 'changed category - islast: '.$dmo ->islast);
                if($dmo -> islast == 0)
                {
                    log_message('error', 'If updated category has descendants: '.$dmo -> id);
                    $cond = $dmo -> family_id;
                    if($dmo -> family_id == 0)
                    {
                        $cond = $id;
                    }
                    
                    $dmo2 = new Articlecatdm();
                    $children = $dmo2 -> where('family_id', $cond) -> get();
                    $this -> change_tree($id, $children, $diff, ($family_id == 0) ? $id : $family_id);
                    
                }
                
                # when last parent category had only one child (this changed child)
                $dmo3 = new Articlecatdm();
                $num_children = $dmo3 -> where('parent_id', $dmo -> parent_id) -> count();
                if( $num_children == 1 )
                {
                    $dmo5 = new Articlecatdm();
                    $dmo5 -> where('id', $dmo -> parent_id) -> get();
                    $dmo5 -> islast = 1;
                    $dmo5 -> save();
                }
                
                
                # when new parent category was last
                if($islast_parent == 1)
                {
                    $dmo4 = new Articlecatdm();
                    $dmo4 -> where('id', $id_parent) -> get();
                    $dmo4 -> islast = 0;
                    $dmo4 -> save();
                }

                
            }
            
            # nothing han not been changed
            unset($post_array['tree']);
            return $this->db->update('articlecats', $post_array, array('id' => $id));      
        }

        public function change_tree($parent_id, $children, $diff, $family_id)
        {
            foreach($children as $child)
            {
                log_message('error', 'children: '.$child -> id);   
                if($child -> parent_id == $parent_id)
                {
                    if($child -> islast == 1)
                    {
                        $dmo6 = new Articlecatdm();
                        $dmo6 -> where('id', $child -> id) -> get();
                        $dmo6 -> level = $child -> level + $diff;
                        $dmo6 -> family_id = $family_id;
                        $dmo6 -> save();
                        log_message('error', '---------tree id: '.$child -> id);
                    }
                    else 
                    {
                        $this -> change_tree($child -> id, $children, $diff, $family_id);
                    }
                }
            }
        }    
        
        public function callback_escape_cat_delete($id)
        {
            $soca = new Articlecatdm();
            $soca -> where('id', $id) -> get();
            if ($soca -> islast == 0)
            {
                throw new Exception("You cannot delete article category with children", 14);
                //die();
            }
            else
            {
                $soca -> delete();
            }
        }
    }
 