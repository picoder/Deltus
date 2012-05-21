<?php

function site_root($path)
{
	return base_url() . "{$path}";
}

function stylesheet($css)
{
	$CI =& get_instance();
	return $CI->matchbook->stylesheet_link($css);
}

function stylesheets()
{
	$CI =& get_instance();
	return $CI->matchbook->stylesheets();
}

function script($script)
{
	$CI =& get_instance();
	return $CI->matchbook->script_link($script);
}

function scripts()
{
	$CI =& get_instance();
	return $CI->matchbook->scripts();
}

function head_scripts()
{
	$CI =& get_instance();
	return $CI->matchbook->head_scripts();
}

function body_scripts()
{
	$CI =& get_instance();
	return $CI->matchbook->body_scripts();
}

function head()
{
	$CI =& get_instance();
	return $CI->matchbook->head();
}

function end_html()
{
	$CI =& get_instance();
	return $CI->matchbook->end_html();
}

function image($image, $attr = array(), $catalog = '')
{
	$CI =& get_instance();
	return $CI->matchbook->img($image, $attr, $catalog);
}

?>