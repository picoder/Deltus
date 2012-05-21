<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Class Content_pages
 */
class Content_pages
{
	private $html_to_format;
	private $max_length;
	private $page_base_url;
	private $active_page;
	// array with content of each page
	private $pages;
	
	function __construct()
	{
		parent::__construct();
		//initiate array and it always contain at least one page
		$this->pages[0] = '';
	}
	
	function initiate($html, $max_length_per_page, $active_page, $active_url, $article_path) 
	{
		// initiate class variables
		// we must delete white spaces at the beginning and at the end of html text
		$this->html_to_format = trim($html);
		$this->max_length = $max_length_per_page;
		$this->page_base_url = $this->prepare_url($active_url, $article_path);
		$this->create_pages();
		// we must convert $active_page to int value and check if isn't bigger or smaller than max number of pages
		$this->active_page = intval($active_page);
		if ($this->active_page > (count($this->pages) - 1))
		{
			// if user manually give wrong number in url
			$this->active_page = count($this->pages) - 1;
		}
	}
		
	private function prepare_url($url, $found_path) 
	{
		// this php function find the first occurence of second parameter
		$end = strpos($url, $found_path);
		$url = substr($url, 0, $end);
		return $url.$found_path.'/';	
	}
	
	private function create_pages()
	{	
		$i = 0;
		$last_pos = 0;
		do
		{
			//jeśli to ostatnia strona
			if((strlen($this->html_to_format) - $last_pos) <= $this->max_length)
			{
				$this->pages[$i] = substr($this->html_to_format, $last_pos);
				return 0;
			}
			// discover the firts occurence of ending paragraph tag after given length of page of article
			$tag_pos_forward = strpos($this->html_to_format, '</p>', $this->max_length + $last_pos);
			// discover the last occurence of ending paragraph tag before given length of page of article
			$for_back_pos = substr($this->html_to_format, $last_pos, $this->max_length);
			$tag_pos_back = strrpos($for_back_pos, '</p>') + $last_pos;
			// check which tag is closer
			$dif_pos_forward = $tag_pos_forward - $this->max_length - $last_pos;
			$dif_pos_back = $this->max_length + $last_pos - $tag_pos_back;
			if($dif_pos_forward <= $dif_pos_back)
			{
				$this->pages[$i] = substr($this->html_to_format, $last_pos, $tag_pos_forward + 4 - $last_pos);	
				$last_pos = $tag_pos_forward + 4;
			}
			else
			{
				$this->pages[$i] = substr($this->html_to_format, $last_pos, $tag_pos_back + 4 - $last_pos);
				$last_pos = $tag_pos_back + 4;
			}
			$i++;	
		}
		while(1);
		
	}
	
	function article_page()
	{	
		return $this->pages[$this->active_page];
	}
	
	function display_pages_anchors()
	{
		$data = '';
		foreach ($this->pages as $page => $content)
		{
			if($this->active_page == intval($page))
			{
				$data .= '<strong>'.anchor($this->page_base_url.$page.'/', $page + 1, array('class' => 'noicon active')).'</strong> ';
			}
			else
			{
				$data .= anchor($this->page_base_url.$page.'/', $page + 1, array('class' => 'noicon')).' ';
			}
		}
		if(count($this->pages) == 1)
		{
			return '';
		}
		else
		{
			return $data;
		}
	}
	

}

/* End of file content_pages.php */
/* Location: ./modules/content/libraries/content_pages.php */

?>