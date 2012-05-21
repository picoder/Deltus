<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="form">
<?php

$attributes = array('id' => 'update_page_form', 'class' => 'piform');
echo form_open_multipart($this->config->item('backend_url').'/'.$this->config->item('page_content_url').'/update/'.$so->id, $attributes);
?>

<?php
echo form_hidden('page_id', $so->id);
?>
<div class="v_f special_link">
<?php
echo anchor('panel-administracyjny/gallery-content/update-gallery/'.$gallery_id.'/', 'Aktualizuj galerię dla tej oferty');
?>

</div>
<div class="v_f">
<?php
echo form_label('Nazwa strony', 'page_name');

$data = array(
              'name'        => 'page_name',
              'id'          => 'page_name',
              'value'       => $so->name,
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
              'value'       => $so->label,
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
              'value'       => $so->description,
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
              'value'       => $so->link,
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
              'value'       => $so->content,
            );

echo form_textarea($data);
?>

</div>


<div class="v_f">
<?php
echo form_label('Status', 'page_status');

$options = array(
                  0  => 'Dezaktywuj',
                  1    => 'Aktywuj',
                );
$data = 'id="status_page"';

echo form_dropdown('page_status', $options, $so->status, $data);
?>

</div>

<div class="v_f submit">
<?php
echo form_submit('mysubmit', 'Aktualizuj stronę');
?>
</div>

<?php
echo form_close();
?>
</div>

