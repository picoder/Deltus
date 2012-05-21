<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MatchBook
 *
 * Yet another asset manager for Codeigniter
 *
 * @package		MatchBook
 * @author		Dayton Nolan
 * @license		MIT License http://www.opensource.org/licenses/mit-license.html
 * @link		http://github.com/textnotspeech/matchsticks
 */

// ------------------------------------------------------------------------

class MatchBook
{
	private $doctype;
	private $title = 'Untitled Document';
	private $theme_path = '';
	private $stylesheet_path ='views/assets/css/';
	private $script_path = 'views/assets/js/';
	private $image_path = 'views/assets/images/';
	private $icon_path = 'views/assets/images/icons/';
	private $meta_viewport_content = 'width=device-width; initial-scale=1.0';
	private $stylesheets = array();
	private $javascripts = array();
	private $head_scripts = array();
	private $body_scripts = array();
	private $use_cachebuster = TRUE;
	private $cachebuster = FALSE;
	private $description = '';
	private $author = '';
	private $body_id = '';
	private $body_class = '';
	private $snippets = array();
	private $view_path = 'matchbook/matchbook/';
	
	private $header;
	private $_ajaxfilemanager_scripts = array();
	private $_head_snippets = array();
	
	public function __construct($config = NULL)
	{
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
		
		$this->CI->load->config('matchbook/matchbook', TRUE);
		foreach($this->CI->config->config['matchbook'] as $setting => $value)
		{
			$this->$setting = $value;
		}
		
		if($config && is_array($config))
		{
			foreach($config as $setting => $value)
			{
					$this->$setting = $value;
			}
		}
	}
	
	public function head()
	{
		return $this->get_head();
	}
	
	private function get_head()
	{
		$head['doctype_delaration'] = $this->doctype_delaration();
		$head['title'] = $this->title;
		$head['description'] = $this->description;
		$head['author'] = $this->author;
		$head['meta_viewport_content'] = $this->meta_viewport_content;
		$head['favicon'] = $this->site_root('favicon.ico');
		$head['ios_icon'] = $this->site_root($this->icon_path . 'ios-icon.png');
		$head['stylesheets'] = $this->stylesheets();
		$head['head_scripts'] = $this->head_scripts();
		$head['body_id'] = $this->body_id;
		$head['body_class'] = $this->body_class;
		$head['head_snippets'] = $this->get_head_snippets();

		return $this->CI->load->view($this->view_path . 'head', $head, TRUE);
	}
	
	private function doctype_delaration()
	{
		$doctypes = array(
			'HTML5' => '<!DOCTYPE html>',
			'Strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
			'Transitional' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
			'Frameset' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">'
		);
		
		return $doctypes[$this->doctype];
	}
	
	private function site_root($path)
	{
		return base_url() . $path;
	}
	
	public function stylesheets()
	{
		return implode('', $this->stylesheet_links());
	}
	
	private function stylesheet_links()
	{
		$stylesheet_links = array();
		foreach($this->stylesheets as $stylesheet)
		{
			$stylesheet_links[] = $this->stylesheet_link($stylesheet);
		}
		return $stylesheet_links;
	}
	
	public function stylesheet_link($stylesheet)
	{
		$cache_buster = $this->use_cachebuster ? $this->build_cachebuster() : '';
		return '<link rel="stylesheet" href="' . base_url() . $this->theme_path . $this->stylesheet_path . $stylesheet . '.css' . $cache_buster . '" type="text/css" charset="utf-8" />' . "\n";
	}
	
	private function build_cachebuster()
	{
		return $this->cachebuster ? '?' . $this->cachebuster . '&'. time() : '?' . time();
	}
	
	public function head_scripts()
	{
		$head_script_links = array();
		
		foreach($this->head_scripts as $script)
		{
			$head_script_links[] = $this->script_link($script);
		}
		
		$head_script_links = array_merge($this->get_ajaxfilemanager_scripts(), $head_script_links);
		return implode($head_script_links);
	}
	
	public function body_scripts()
	{
		$body_script_links = array();
		
		foreach($this->body_scripts as $script)
		{
			$body_script_links[] = $this->script_link($script);
		}
		
		return implode($body_script_links);
	}
	
	public function scripts()
	{		
		$scripts = array_merge($this->head_scripts, $this->body_scripts);
		$script_links = array();
		
		foreach($scripts as $script)
		{
			$script_links[] = $this->script_link($script);
		}
		
		return implode($script_links);
	}
	
	public function script_link($script)
	{
		$cache_buster = $this->use_cachebuster ? $this->build_cachebuster() : '';
		return '<script src="' . site_root($this->theme_path . $this->script_path . $script) . '.js' . $cache_buster . '"></script>' . "\n";
	}
	
	public function img($file_name, $attributes = array(), $catalog = '')
	{
		if(!isset($attributes['alt']))
		{
			$attributes['alt'] = $file_name;
		}
		
		return '<img src="' . $this->image_src($catalog.$file_name) . '"' . $this->build_attributes($attributes) . '/>';
	}
	
	public function image_src($path)
	{
		return $this->site_root($this->theme_path . $this->image_path . $path);
	}
	
	public function build_attributes($attributes)
	{		
		$attributes_string = '';
		foreach($attributes as $attr => $val)
		{
			$attributes_string .= ' ' . $attr . '="' . $val . '"';
		}
		
		return $attributes_string;
	}
		
	public function add_stylesheet($stylesheet)
	{
		$this->stylesheets[] = $stylesheet;
	}

	public function add_script($script, $location = 'head')
	{
		$script_location = $location . '_scripts';
		$this->{$script_location}[] = $script;
	}
	
	private function script_snippet($source)
	{
		$snippet['source'] = $source;
		return $this->CI->load->view($this->view_path . 'snippet', $source, TRUE);
	}
	
	public function add_snippet($source)
	{
		$this->snippets[] = $source;
	}
	
	private function snippets()
	{
		return (!empty($this->snippets)) ? $this->script_snippet(implode("\n", $this->snippets)) : '';
	}
	
	public function end_html()
	{
		$end['body_scripts'] = $this->body_scripts();
		$end['snippets'] = $this->snippets();
		return $this->CI->load->view($this->view_path . 'end', $end, TRUE);
	}
	
	public function page_info($options)
	{
		$this->title = (isset($options['title'])) ? $options['title'] : $this->title;
		$this->body_id = (isset($options['id'])) ? ' id="' . $options['id'] . '"' : '';
		$this->body_class = (isset($options['class'])) ? ' class="' . $options['class'] . '"' : '';
	}
	
	public function title($title)
	{
		$this->title = $title;
	}
	
	public function body_id($id)
	{
		$this->body_id = ' id="' . $id . '"';
	}
	
	public function body_class($class)
	{
		$this->body_class = ' class="' . $class .'"';
	}
	
	public function theme_path($theme_path)
	{
		$this->theme_path = $theme_path;
	}

	public function add_head_snippet($file_path, $data = array())
	{
		$this->_head_snippets[] = $this->CI->load->view($file_path, $data, TRUE);
	}
	
	public function get_head_snippets()
	{
		return ( ! empty($this->_head_snippets)) ? (implode("\n", $this->_head_snippets)) : '';
	}

	################# Special #################
	public function add_niceforms()
	{
		$this->_ajaxfilemanager_scripts = array(
		'<script language="javascript" type="text/javascript" src="'. base_url().'extends/niceforms/niceforms.js"></script>'."\n", 
		'<link rel="stylesheet" type="text/css" media="all" href="'. base_url().'extends/niceforms/niceforms-default.css" />'."\n",
		);
	}

	public function add_ajaxfilemanager()
	{
		$this->_ajaxfilemanager_scripts = array(
		'<script language="javascript" type="text/javascript" src="'. base_url().'extends/ajaxfilemanager/jscripts/tiny_mce/tiny_mce.js"></script>'."\n", 
		'<script language="javascript" type="text/javascript" src="'. base_url().'extends/ajaxfilemanager/jscripts/general.js"></script>'."\n",
		);
	}
	
	public function get_ajaxfilemanager_scripts()
	{
		return $this->_ajaxfilemanager_scripts;	
	}
}

/* End of file matchbook.php */