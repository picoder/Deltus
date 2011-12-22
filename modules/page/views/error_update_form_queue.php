<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<h1>Errors:</h1>
<div class="form">
<?php
$attributes = array('id' => 'update_form');

echo form_open_multipart($this->config->item('backend_url').'/'.$this->config->item('page_content_url').'/update/'.$so->id, $attributes);
?>

<?php
echo form_hidden('page_id', $so->id);
?>

<div class="v_f">
<?php echo validation_errors(); ?>
</div>
<div class="v_f">
<?php
echo form_label('Nazwa strony', 'page_name');

$data = array(
              'name'        => 'page_name',
              'id'          => 'page_name',
              'value'       => $this->input->post('page_name'),
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
              'value'       => $this->input->post('page_label'),
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
              'value'       => $this->input->post('page_description'),
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
              'value'       => $this->input->post('page_link'),
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
              'value'       => $this->input->post('page_content'),
            );

echo form_textarea($data);
?>
</div>


<div class="v_f">
<?php
echo form_label('Status', 'page_status');

$options = array(
                  0  => 'Inactive',
                  1  => 'Active',
                );
$data = 'id="status_page"';

echo form_dropdown('page_status', $options, $this->input->post('page_status'), $data);
?>
</div>

<div class="v_f">
<?php
echo form_submit('mysubmit', 'Aktualizuj stronę');
?>
</div>

<?php
echo form_close();
?>
</div>



