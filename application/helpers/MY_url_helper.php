<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Create URL Title and works with polish special signs
 *
 * Takes a "title" string as input and creates a
 * human-friendly URL string with either a dash
 * or an underscore as the word separator.
 *
 * @access	public
 * @param	string	the string
 * @param	string	the separator: dash, or underscore
 * @return	string
 */
if ( ! function_exists('url_title'))
{
	function url_title($str, $separator = 'dash', $lowercase = FALSE)
	{
		if ($separator == 'dash')
		{
			$search		= '_';
			$replace	= '-';
		}
		else
		{
			$search		= '-';
			$replace	= '_';
		}
		
		$pl = array ( 'ą', 'ę', 'ó', 'ł', 'ń', 'ć', 'ś', 'ż', 'ź', 
'Ą', 'Ę', 'Ó', 'Ł', 'Ń', 'Ć', 'Ś', 'Ż', 'Ź');

$en = array ( 'a', 'e', 'o', 'l', 'n', 'c', 's', 'z', 'z', 
'a', 'e', 'o', 'l', 'n', 'c', 's', 'z', 'z');

        foreach($pl as $pos => $dump)

            $str = preg_replace("#".$dump."#", $en[$pos], $str);

		$trans = array(
						'&\#\d+?;'				=> '',
						'&\S+?;'				=> '',
						'\s+'					=> $replace,
						'[^a-z0-9\-\._]'		=> '',
						$replace.'+'			=> $replace,
						$replace.'$'			=> $replace,
						'^'.$replace			=> $replace,
						'\.+$'					=> ''
					);

		$str = strip_tags($str);

		foreach ($trans as $key => $val)
		{
			$str = preg_replace("#".$key."#i", $val, $str);
		}

		if ($lowercase === TRUE)
		{
			$str = strtolower($str);
		}

		return trim(stripslashes($str));
	}
}

// ------------------------------------------------------------------------



			
			
/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */
?>