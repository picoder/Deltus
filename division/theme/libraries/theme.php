<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Theme
{
	public $CI;
	
	private $body_id = '';
	private $body_class = '';
	
	public $theme_in_css = array();
	public $extend_in_css = array();
	public $module_in_css = array();
	public $theme_out_css = array();
	public $extend_out_css = array();
	public $module_out_css = array();
	
	public $theme_in_js_head = array();
	public $extend_in_js_head = array();
	public $module_in_js_head = array();
	public $theme_out_js_head = array();
	public $extend_out_js_head = array();
	public $module_out_js_head = array();
	
	public $theme_in_js_body = array();
	public $extend_in_js_body = array();
	public $module_in_js_body = array();
	public $theme_out_js_body = array();
	public $extend_out_js_body = array();
	public $module_out_js_body = array();
	
	public $fulls = array();
	
	public $viewport = 'initial-scale=1, maximum-scale=1';
	
	public function __construct()
	{
		$this->CI = & get_instance();
		$this->CI->load->helper('url');
		$this->CI->load->driver('minify');
	}
	
	# CSS set functions
	
	public function set_theme_css($theme_name, $name, $subpath = '')
	{
		$this->theme_out_css[] = 'themes/'.$theme_name.'/views/assets/'.$subpath.'css/'.$name.'.css';
	}
	
	public function set_theme_in_css($content)
	{
		$this->theme_in_css[] = $content;
	}
	
	public function set_ext_css($extend_name, $path)
	{
		$this->extend_out_css[] = 'extends/'.$extend_name.'/'.$path.'.css';
	}
	
	public function set_ext_in_css($content)
	{
		$this->extend_in_css[] = $content;
	}
	
	public function set_mod_css($module_name, $name, $subpath = '')
	{
		$this->module_out_css[] = 'modules/'.$module_name.'/views/assets/'.$subpath.'css/'.$name.'.css';
	}
	
	# not with http
	public function set_mod_css_full($path_with_type)
	{
		$this->module_out_css[] = $path_with_type;
	}
	
	public function set_mod_in_css($content)
	{
		$this->module_in_css[] = $content;
	}
	
	# JS set functions
	
	public function set_theme_js($theme_name, $name, $subpath = '', $place = 'head')
	{
		array_push($this->{'theme_out_js_'.$place}, 'themes/'.$theme_name.'/views/assets/'.$subpath.'js/'.$name.'.js');
	}
	
	public function set_theme_in_js($content, $place = 'head')
	{
		array_push($this->{'theme_in_js_'.$place}, $content);
	}
	
	public function set_ext_js($extend_name, $path, $place = 'head')
	{
		array_push($this->{'extend_out_js_'.$place}, 'extends/'.$extend_name.'/'.$path.'.js');
	}
	
	public function set_ext_in_js($content, $place = 'head')
	{
		array_push($this->{'extend_in_js_'.$place}, $content);
	}
	
	public function set_mod_js($module_name, $name, $subpath = '', $place = 'head')
	{
		array_push($this->{'module_out_js_'.$place}, 'modules/'.$module_name.'/views/assets/'.$subpath.'js/'.$name.'.js');
	}
	
	# $path_with_type not with http
	# references to all files must be set with http because minified file would not see them
	public function set_mod_js_full($path_with_type, $place = 'head') 
	{
		array_push($this->{'module_out_js_'.$place}, $path_with_type);
	}
	
	public function set_mod_in_js($content, $place = 'head')
	{
		array_push($this->{'module_in_js_'.$place}, $content);
	}
	
	public function set_full($string)
	{
		$this->fulls[] = $string;	
	}
	
	public function get_full()
	{
		$out = '';
		foreach($this->fulls as $full)
		{
			$out .= $full;	
		}
		return $out;
	}
		
	public function set_viewport($viewport)
	{
		$this->viewport = $viewport;	
	}
	
	public function get_viewport()
	{
		return $this->viewport;	
	}
	
	

	
	# print minify out resources
	
	public function get_css($theme_name)
	{
		$css_files = array_merge($this->theme_out_css, $this->extend_out_css, $this->module_out_css);
		$css_out_contents = $this->CI->minify->combine_files($css_files, 'css');
		$this->CI->minify->save_file($css_out_contents, 'themes/'.$theme_name.'/views/assets/minify/mini.css');
		return '<link href="'.base_url().'themes/'.$theme_name.'/views/assets/minify/mini.css" rel="stylesheet" type="text/css">';
		
	}
	
	public function get_js($theme_name, $place = 'head')
	{
		$theme = 'theme_out_js_'.$place;
		$js_files_{$place} = array_merge($this->$theme, $this->{'extend_out_js_'.$place}, $this->{'module_out_js_'.$place});
		$js_out_contents_{$place} = $this->CI->minify->combine_files($js_files_{$place}, 'js');
		$this->CI->minify->save_file($js_out_contents_{$place}, 'themes/'.$theme_name.'/views/assets/minify/mini_'.$place.'.js');
		return '<script language="javascript" type="text/javascript" src="'.base_url().'themes/'.$theme_name.'/views/assets/minify/mini_'.$place.'.js" ></script>';
	}
	
	# print in resources
	
	public function get_in_css($theme_name)
	{
		return '';
	}
	
	# TODO function get_in_js
	# minify contents
	public function get_in_js($theme_name, $place = 'head')
	{
		${'js_in_contents_'.$place} = '';
		foreach($this->{'theme_in_js_'.$place} as $content)
		{
			${'js_in_contents_'.$place} .= $content;
		}
		foreach($this->{'extend_in_js_'.$place} as $content)
		{
			${'js_in_contents_'.$place} .= $content;
		}
		foreach($this->{'module_in_js_'.$place} as $content)
		{
			${'js_in_contents_'.$place} .= $content;
		}
		return $this->CI->load->view('theme/snippet', array('source' => ${'js_in_contents_'.$place}), TRUE);
	}
	
	
	public function get_head($theme_name)
	{
		$head['body_id'] = $this->body_id;
		$head['body_class'] = $this->body_class;
		$head['css_out'] = $this->get_css($theme_name);
		$head['css_in'] = $this->get_in_css($theme_name);
		$head['js_out_head'] = $this->get_js($theme_name);
		$head['js_in_head'] = $this->get_in_js($theme_name);
		$head['fulls'] = $this->get_full();
		$head['viewport'] = $this->get_viewport();
		return $this->CI->load->view('theme/head', $head, TRUE);
	}
	
	public function get_end_html($theme_name)
	{
		$end['js_out_body'] = $this->get_js($theme_name, 'body');
		$end['js_in_body'] = $this->get_in_js($theme_name, 'body');
		return $this->CI->load->view('theme/end', $end, TRUE);
	}
}