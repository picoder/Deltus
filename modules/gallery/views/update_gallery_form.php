<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$attributes = array('id' => 'add_offer_form', 'class' => 'piform');
echo form_open_multipart(base_url().$this->config->item('backend_url').'/'.$this->config->item('gallery_content_url').'/update-gallery/'.$gallery_id, $attributes);
if($gallery_items === FALSE)
{
	echo '<h2 class="t_center v_space_30">Galeria jest pusta</h2>';
}
else
{
	echo $gallery_items;
}
?>
<div id="uploader">
<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
</div>

<div class="v_f submit">
<?php
echo form_submit('mysubmit', 'Aktualizuj galerię');
echo form_close();
?>
</div>