<?php echo $doctype_delaration ?>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --> 
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<script>document.documentElement.className = 'js';</script>
	<meta charset="utf-8">

	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame Remove this if you use the .htaccess -->
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

	<title><?php echo $title ?></title>
  	<meta name="description" content="<?php echo $description ?>">
  	<meta name="author" content="<?php echo $author ?>">

  	<!--  Mobile viewport optimized: j.mp/bplateviewport -->
  	<meta name="viewport" content="<?php echo $meta_viewport_content ?>">

  	<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  	<link rel="shortcut icon" href="<?php echo $favicon ?>">
  	<link rel="apple-touch-icon" href="<?php echo $ios_icon ?>">
		
		<?php echo $stylesheets; ?>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();  ?>extends/chosen/chosen.css">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();  ?>extends/collapsible_checkbox/jquery.collapsibleCheckboxTree.css">

 
  
  
		<?php echo $head_scripts; ?>
        <?php echo $head_snippets; ?>
         
        <script type="text/javascript" src="<?php echo base_url(); ?>extends/collapsible_checkbox/jquery.collapsibleCheckboxTree.js"></script>
        <script type="text/javascript">
jQuery(document).ready(function(){
		
     $('ul#example').collapsibleCheckboxTree();
});
/*
jQuery(document).ready(function(){
		$('ul#example').collapsibleCheckboxTree({
		checkParents : true, // When checking a box, all parents are checked (Default: true)
		checkChildren : false, // When checking a box, all children are checked (Default: false)
		uncheckChildren : true, // When unchecking a box, all children are unchecked (Default: true)
		initialState : 'default' // Options - 'expand' (fully expanded), 'collapse' (fully collapsed) or default
												});
});
*/
</script>

</head>
<body<?php echo $body_id.$body_class; ?>>