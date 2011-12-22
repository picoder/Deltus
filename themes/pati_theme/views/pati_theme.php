<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//echo head();

$css_files = array(
		'themes/pati_theme/views/assets/css/v.css',
		'themes/pati_theme/views/assets/css/style.css',	
		'themes/pati_theme/views/assets/css/base.css',
		'themes/pati_theme/views/assets/css/pati.css',					
		);
$js_files = array(
		'themes/pati_theme/views/assets/js/jquery-1.6.4.min.js',
		'extends/flashgallery/swfobject.js',
		'extends/jquery_timer/jquery.timer.js',
		'themes/pati_theme/views/assets/js/pi_slideshow.js',
		);
$css_contents = $this->minify->combine_files($css_files, 'css');
$js_contents = $this->minify->combine_files($js_files, 'js');
$this->minify->save_file($css_contents, 'themes/pati_theme/views/assets/minified_css/mini.css');
$this->minify->save_file($js_contents, 'themes/pati_theme/views/assets/minified_js/mini.js');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Auto-Pati | Komis | Auto-handel | Sprowadzanie samochodów z zagranicy</title>
<!--<link href="<?php echo base_url();?>themes/pati_theme/views/assets/css/v.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>themes/pati_theme/views/assets/css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>themes/pati_theme/views/assets/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>themes/pati_theme/views/assets/css/pati.css" rel="stylesheet" type="text/css">-->
<!--<link href='http://fonts.googleapis.com/css?family=Syncopate' rel='stylesheet' type='text/css'>-->

<link href="<?php echo base_url();?>themes/pati_theme/views/assets/minified_css/mini.css" rel="stylesheet" type="text/css">
<!--[if lte IE 7]>
<link href="<?php echo base_url();?>themes/pati_theme/views/assets/css/ie7.css" rel="stylesheet" type="text/css">
<![endif]-->

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>-->

<!-- Location of javascript. -->
<!--<script language="javascript" type="text/javascript" src="<?php echo base_url();?>extends/flashgallery/swfobject.js" ></script>-->

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>themes/pati_theme/views/assets/minified_js/mini.js" ></script>

</head>

<body>

<div class="w wrapper flash_gallery">


<div class="v row1">

<?php

?>
<ul id="menu_pati">
    <li id="menu_about"  <?php echo $this->uri->segment(4)=='o-firmie' ? 'class="current"' : ''; ?>>
    <a 
    href="<?php 
	echo base_url().$this->division_builder->get_dv_url().'/'.$this->config->item('page_page_url').'/strona/o-firmie'; 
	?>" 
    title="O Firmie"><span>O firmie Auto-Handel Pati</span></a>
    </li>
    <li id="menu_offer"  <?php echo $this->uri->segment(4)=='oferta' ? 'class="current"' : ''; ?>><a 
    href="<?php 
	echo base_url().$this->division_builder->get_dv_url().'/'.$this->config->item('page_page_url').'/strona/oferta'; 
	?>" 
    title="Oferta"><span>Oferta Auto-Handel Pati</span></a></li>
    <li id="menu_buy" <?php echo $this->uri->segment(2)=='ogloszenia' ? 'class="current"' : ''; ?>><a href="#" title="Ogłoszenia"><span>Ogłoszenia aut Auto-Handel Pati</span></a></li>
    <li id="menu_contact"  <?php echo $this->uri->segment(4)=='kontakt' ? 'class="current"' : ''; ?>><a 
    href="<?php 
	echo base_url().$this->division_builder->get_dv_url().'/'.$this->config->item('page_page_url').'/strona/kontakt'; 
	?>" 
    title="Kontakt"><span>Kontakt Auto-Handel Pati</span></a></li>
</ul>

</div><!--div.row1-->

<div class="v row2">
<?php
echo modules::run('simple_offer/widgets/so_widget/so_slideshow');
?>
</div><!--div.row2-->

<div class="v row3">

<div class="l col_left">

<h2>Najnowsze ogłoszenia</h2>

<?php
echo modules::run('simple_offer/widgets/so_widget/index');
?>

</div><!--div.col_left-->

<div class="e o col_right">

<?php
echo create_surfaces('CONTENT');

?>
</div><!--div.col_right-->

</div><!--div.row3-->

<div class="v row4">
<div class='box'>
 <div class='boxtop'><div></div></div>
  <div class='boxcontent'>
   <p class="copyright">
© Copyright Pati Paweł Pawelczyk. All Rights Reserved | <a href="#" title="Picoders">Powered by Picoders</a><span class="spacer">&nbsp;</span>Elbląg, ul. Królewiecka 8-12/24 &nbsp;|&nbsp; tel: 793 633 963 &nbsp;|&nbsp; e-mail: <a href="mailto:pati@auto-pati.pl">pati@auto-pati.pl</a>
</p>
  </div>
 <div class='boxbottom'><div></div></div>
</div>
 
</div><!--div.row4-->
</div><!--div.wrapper-->

</body>
</html>

