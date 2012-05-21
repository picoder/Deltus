<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
//$this->matchbook->add_niceforms();
?>
<div class="form">
<?php
$attributes = array('id' => 'add_item_form', 'class' => 'piform');

echo form_open($this->config->item('backend_url').'/'.$this->config->item('page_content_url').'/add', $attributes);
?>
<div class="v_f">
<?php
echo form_label('Nazwa strony', 'page_name');

$data = array(
              'name'        => 'page_name',
              'id'          => 'page_name',
              'value'       => '',
            );

echo form_input($data);
?>
</div>
<div class="v_f">
<?php
echo form_label('Etykieta', 'page_label');

$data = array(
              'name'        => 'page_label',
              'id'          => 'page_label',
              'value'       => '',
            );

echo form_input($data);
?>
</div>
<div class="v_f">
<?php
echo form_label('Opis', 'page_description');

$data = array(
              'name'        => 'page_description',
              'id'          => 'page_description',
              'value'       => '',
            );

echo form_textarea($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Link', 'page_link');

$data = array(
              'name'        => 'page_link',
              'id'          => 'page_link',
              'value'       => '',
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Treść', 'page_content');

$data = array(
              'name'        => 'page_content',
              'id'          => 'page_content',
              'value'       => '',
            );

echo form_textarea($data);
?>
</div>

<div id="uploader">
<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
</div>

<div class="v_f"></div>

<div class="v_f">
<?php
echo form_label('Status', 'page_status');

$options = array(
                  0  => 'Dezaktywuj',
                  1    => 'Aktywuj',
                );
$data = 'id="status_page"';

echo form_dropdown('page_status', $options, 1, $data);
?>
</div>

<div class="v_f submit">
<?php
echo form_submit('mysubmit', 'Dodaj stronę');
?>
</div>

<?php
echo form_close();
?>
</div>

