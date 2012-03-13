<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php 
foreach($css_files as $file): ?>
	<?php
	/* 
	$file = substr($file, strlen(base_url())); //in css set by theme library all urls must be with http
	$this->theme->set_mod_css_full($file);
	 */
	?>
	<?php
	$full = '<link type="text/css" rel="stylesheet" href="'.$file.'" />';
	$this->theme->set_full($full);
	?>
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<?php
	/*
	$file = substr($file, strlen(base_url()));
	$this->theme->set_mod_js_full($file);
	 */
	?>
	<?php
	$full = '<script src="'.$file.'"></script>';
	$this->theme->set_full($full);
	?>
<?php endforeach; ?>
<?php

?>

    <div>
		<?php echo $output; ?>
    </div>

