<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --> 
<!--[if lt IE 7 ]> <html lang="en" class="ie6 no-js"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-ie no-js"> <!--<![endif]-->
<head>
	<script>document.documentElement.className += '-js';</script>
	<meta charset="utf-8">

	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame Remove this if you use the .htaccess -->
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

	<title>Title<?php //echo $title ?></title>
  	<meta name="description" content="<?php //echo $description ?>">
  	<meta name="author" content="<?php //echo $author; ?>">

  	<!--  Mobile viewport optimized: j.mp/bplateviewport -->
  	<meta name="viewport" content="<?php echo $viewport; ?>">
    <meta name="robots" content="index,follow" />

  	<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  	<link rel="shortcut icon" href="<?php //echo $favicon; ?>">
  	<link rel="apple-touch-icon" href="<?php //echo $ios_icon; ?>">
		
	<?php
	echo $css_out;
	echo $css_in;
	echo $js_out_head;
	echo $js_in_head;
	echo $fulls;
	?>   

</head>
<body<?php echo $body_id.$body_class; ?>>