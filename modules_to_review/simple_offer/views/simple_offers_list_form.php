<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
if($so_items === FALSE)
{
	echo '<h2 class="t_center v_space_30">Brak ofert</h2>';
}
else
{
	$attributes = array('class' => 'piform');
	echo form_open(current_url(), $attributes);
	echo $so_items;
	echo form_hidden('operation_delete', TRUE);
	echo form_submit('so_items_edit', 'Usuń wybrane oferty');
	echo form_close();
}