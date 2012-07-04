<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articlecat_lib
{
    public $CI;
    private $socategories_for_menu;
    
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    
    public function count_assigned_articles($cat_id)
    {
        $r = new Articlecatdm();
        $r -> include_related_count('articledm') -> where('id', $cat_id) -> get();
        return $r->articledm_count;
    }
    
    public function set_socas($socas)
    {
        $this->socategories_for_menu = $socas;
    }
    
    public function get_socas()
    {
        if(empty($this->socategories_for_menu))
        {
            $socas = new Articlecatdm();
            $socas->get();
            return $socas;
        }
        else
        {
            return $this->socategories_for_menu;
        }
    }
    
    # param $soca comes as one row
    public function update_tree($soca)
    {
        $tree = $this->set_tree($soca->tree);
        foreach($tree as $property => $val)
        {
            $soca->{$property} = $val;  
        }
        $parent_id = $soca->parent_id;
        $soca -> save();
        
        # we must set islast for new parent if it was not category root/main category
        if($parent_id != 0)
        {
            $soca_parent = new Articlecatdm();
            $soca_parent->where('id', $parent_id)->get();
            if($soca_parent->islast == 1)
            {
                $soca_parent->islast = 0;
                $soca_parent->save();
            }
        }    
    }

    public function add($soca)
    {
        $tree = $this->set_tree($soca->tree);
        foreach($tree as $property => $val)
        {
            $soca->{$property} = $val;  
        }
        
        $parent_id = $soca->parent_id;
        $soca->save();
        $soca_parent = new Articlecatdm();
        $soca_parent->where('id', $parent_id)->get();
        $soca_parent->islast = 0;
        $soca_parent->save();
    }
    
    public function delete($id)
    {
        $soca = new Articlecatdm();
        $soca->where('id', $id)->get();
        $parent_id = $soca->parent_id;
        $soca->delete(); // it deletes also with its relations
        
        $soca_parent = new Articlecatdm();
        $soca_parent->where('id', $parent_id)->get();
        $soca_parent->is_last = 1;
        $soca_parent->save();
        
    }
    
    public function set_tree($tree_string)
    {
        $object;
        if($tree_string == 'root')
        {
            $object->parent_id = 0;
            $object->family_id = 0;
            $object->level = 0;
            $object->islast = 1;
        }
        else
        {
            # explode string ex. 9|1|1|1 - id|family_id|level|islast|
            $from_tree_string = explode('|', $tree_string);
            $object->parent_id = (int)($from_tree_string[0]);
            if((int)($from_tree_string[1]) == 0)
            {
                $object->family_id = (int)($from_tree_string[0]);
            }
            else
            {
                $object->family_id = (int)($from_tree_string[1]);
            }
            $object->level = (int)($from_tree_string[2]) + 1;
            $object->islast = 1;
                
        }
        
        return $object;
    }
    
    public function formpart_parent_soca($socas, $selected_val = null, $excluded = null)
    {
        $this-> CI -> load -> helper(array('form'));
        $options_part = $this->fpc_tree($socas, $excluded);
        
        $options = array(
                  'root'  => 'Kategoria główna',
                );
        $data = 'id="tree"';

        $formpart = form_dropdown('tree', array_merge($options, $options_part), is_null($selected_val) ? 'root' : $selected_val, $data);
        return $formpart;
    }
    
    public function fpc_tree($socas, $excluded = null)
    {
        $tree = array();
        foreach($socas as $item)
        {
            if($item->parent_id == 0 AND $item->id != $excluded)
            {
                $tree = array_merge($tree, array($item->id.'|'.$item->family_id.'|'.$item->level.'|'.$item->islast => $this->print_margin($item->level).' '.$item->label));
                $tree = array_merge($tree, $this->tree_children($item->id, $socas, $excluded));
            }
                        
        }
        # DEBUG: print_r($tree);
        return $tree;
    }
    
    public function option_value($item)
    {
        //log_message('error', $item->id.'|'.$item->family_id.'|'.$item->level.'|'.$item->islast);
        return $item->id.'|'.$item->family_id.'|'.$item->level.'|'.$item->islast;
    }
    
    public function tree_children($parent_id, $socas, $excluded = null)
    {
        $children_tree = array();
        foreach($socas as $item)
        {
            
            if($item->parent_id == $parent_id AND $item->id != $excluded)
            {
                
                if($item->islast == 1)
                {
                    $children_tree = array_merge($children_tree, array($item->id.'|'.$item->family_id.'|'.$item->level.'|'.$item->islast => $this->print_margin($item->level).' '.$item->label));
                }
                else
                {
                    $children_tree = array_merge($children_tree, array($item->id.'|'.$item->family_id.'|'.$item->level.'|'.$item->islast => $this->print_margin($item->level).' '.$item->label));
                    $children_tree = array_merge($children_tree, $this->tree_children($item->id, $socas, $excluded));
                }
            }
            else
            {
                if($item->id == $excluded)
                {
                    log_message('error', 'excluded: '.(is_null($excluded) ? 'null' : $excluded).' - '.$item->id);
                }
                
            }

            
        }
        
        return $children_tree;
    }
    
    public function print_margin($nr)
    {
        $out = '-';
        for($i = 0; $i < $nr; $i++)
        {
            $out .= '-';
        }
        return $out;
    }   
    
    public function menu_socategory($excluded = null)
    {
        $menu = '<ul>';
        
        $socas_for_menu = $this->get_socas();
        foreach($socas_for_menu as $item)
        {
            if($item->parent_id == 0 AND $item->id != $excluded)
            {
                $menu .= '<li>'.anchor($this->CI->division_builder->get_dv_url().'/'.$this->CI->config->item('so_so_url').'/'.$this->CI->config->item('list_so_by_category_url').'/'.$item->link, $item->label);
                if($item->islast == 1)
                {
                    $menu .= '</li>';
                }
                else
                {
                    $menu .= $this->menu_socategory_children($item->id, $socas_for_menu, $excluded).'</li>';   
                }
            }
        }
        
        $menu .= '</ul>';
        
        # save to view file
        $this->CI->load->helper('file');
        if ( ! write_file('modules/article/views/articlecats_menu.php', $menu))
        {
             echo 'Unable to write the file';
        }
        else
        {
             echo 'File written!';
        }   
    }
    
    public function menu_socategory_children($parent_id, $items, $excluded = null)
    {
        $submenu = '<ul>';
        foreach($items as $item)
        {
            if($item->parent_id == $parent_id AND $item->id != $excluded)
            {
                $submenu .= '<li>'.anchor($this->CI->division_builder->get_dv_url().'/'.$this->CI->config->item('so_so_url').'/'.$this->CI->config->item('list_so_by_category_url').'/'.$item->link, $item->label);
                if($item->islast == 1)
                {
                    $submenu .= '</li>';
                }
                else
                {
                    $submenu .= $this->menu_socategory_children($item->id, $items).'</li>';
                }
            }
        }
        $submenu .= '</ul>';
        return $submenu;
    }


}
