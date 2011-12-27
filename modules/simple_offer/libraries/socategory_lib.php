<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Socategory_lib
{
	public $CI;
	private $socategories_for_menu;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function set_socas($socas)
	{
		$this->socategories_for_menu = $socas;
	}
	
	public function get_socas()
	{
		if(empty($this->socategories_for_menu))
		{
			$socas = new Socategorydm();
			$socas->get();
			return $socas;
		}
		else
		{
			return $this->socategories_for_menu;
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
		$soca_parent = new Socategorydm();
		$soca_parent->where('id', $parent_id)->get();
		$soca_parent->islast = 0;
		$soca_parent->save();
	}
	
	public function delete($id)
	{
		$soca = new Socategorydm();
		$soca->where('id', $id)->get();
		$parent_id = $soca->parent_id;
		$soca->delete(); // it deletes also with its relations
		
		$soca_parent = new Socategorydm();
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
	
	public function formpart_parent_soca($socas)
	{
		
		$options_part = $this->fpc_tree($socas);
		
		$options = array(
                  'root'  => 'Kategoria główna',
                );
		$data = 'id="soca_tree"';

		$formpart = form_dropdown('soca_tree', array_merge($options, $options_part), 'root', $data);
		return $formpart;
	}
	
	public function fpc_tree($socas)
	{
		$tree = array();
		foreach($socas as $item)
		{
			if($item->parent_id == 0)
			{
				$tree = array_merge($tree, array($item->id.'|'.$item->family_id.'|'.$item->level.'|'.$item->islast => $this->print_margin($item->level).' '.$item->label));
				$tree = array_merge($tree, $this->tree_children($item->id, $socas));
			}
						
		}
		print_r($tree);
		return $tree;
	}
	
	public function tree_children($parent_id, $socas)
	{
		$children_tree = array();
		foreach($socas as $item)
		{
			if($item->parent_id == $parent_id)
			{
				if($item->islast == 1)
				{
					$children_tree = array_merge($children_tree, array($item->id.'|'.$item->family_id.'|'.$item->level.'|'.$item->islast => $this->print_margin($item->level).' '.$item->label));
				}
				else
				{
					$children_tree = array_merge($children_tree, array($item->id.'|'.$item->family_id.'|'.$item->level.'|'.$item->islast => $this->print_margin($item->level).' '.$item->label));
					$children_tree = array_merge($children_tree, $this->tree_children($item->id, $socas));
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
	
	public function menu_socategory()
	{
		$menu = '<ul>';
		
		$socas_for_menu = $this->get_socas();
		foreach($socas_for_menu as $item)
		{
			if($item->parent_id == 0)
			{
				$menu .= '<li>'.anchor($this->CI->division_builder->get_dv_url().'/'.$this->CI->config->item('so_so_url').'/'.$this->CI->config->item('list_so_by_category_url').'/'.$item->link, $item->label);
				if($item->islast == 1)
				{
					$menu .= '</li>';
				}
				else
				{
					$menu .= $this->menu_socategory_children($item->id, $socas_for_menu).'</li>';	
				}
			}
		}
		
		$menu .= '</ul>';
		
		# save to view file
		$this->CI->load->helper('file');
		if ( ! write_file('modules/simple_offer/views/menus/socas_menu.php', $menu))
		{
			 echo 'Unable to write the file';
		}
		else
		{
			 echo 'File written!';
		}	
	}
	
	public function menu_socategory_children($parent_id, $items)
	{
		$submenu = '<ul>';
		foreach($items as $item)
		{
			if($item->parent_id == $parent_id)
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
