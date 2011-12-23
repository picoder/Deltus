<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('delete_dir_with_files'))
{
	function delete_dir_with_files($dir_path) 
	{
		if (! is_dir($dir_path)) 
		{
			throw new InvalidArgumentException('$dir_path must be a directory');
		}
		if (substr($dir_path, strlen($dir_path) - 1, 1) != '/') 
		{
			$dir_path .= '/';
		}
		$files = glob($dir_path . '*', GLOB_MARK);
		foreach ($files as $file) 
		{
			if (is_dir($file)) 
			{
				delete_dir_with_files($file); # runs in helper like the helper - recursive
			} 
			else 
			{
				unlink($file);
			}
		}
		rmdir($dir_path);
	}
}