<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<h1>Errors:</h1>
<div class="form">
<?php
$attributes = array('id' => 'update_offer_form');

echo form_open_multipart($this->config->item('backend_url').'/'.$this->config->item('simple_offer_content_url').'/update/'.$so->id, $attributes);
?>

<?php
echo form_hidden('offer_id', $so->id);
?>

<div class="v_f">
<?php echo validation_errors(); ?>
</div>
<div class="v_f">
<?php
echo form_label('Name', 'offer_name');

$data = array(
              'name'        => 'offer_name',
              'id'          => 'offer_name',
              'value'       => $this->input->post('offer_name'),
            );

echo form_input($data);
?>
</div>
<div class="v_f">
<?php
echo form_label('Tytuł', 'offer_label');

$data = array(
              'name'        => 'offer_label',
              'id'          => 'offer_label',
              'value'       => $this->input->post('offer_label'),
            );

echo form_input($data);
?>
</div>
<div class="v_f">
<?php
echo form_label('Krótki opis', 'offer_description');

$data = array(
              'name'        => 'offer_description',
              'id'          => 'offer_description',
              'value'       => $this->input->post('offer_description'),
            );

echo form_textarea($data);
?>
</div>


<div class="v_f">
<?php
echo form_label('Link', 'offer_link');

$data = array(
              'name'        => 'offer_link',
              'id'          => 'offer_link',
              'value'       => $this->input->post('offer_link'),
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Treść', 'offer_content');

$data = array(
              'name'        => 'offer_content',
              'id'          => 'offer_content',
              'value'       => $this->input->post('offer_content'),
            );

echo form_textarea($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Marka i model', 'offer_model');

$data = array(
              'name'        => 'offer_model',
              'id'          => 'offer_model',
              'value'       => $this->input->post('offer_model'),
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Kolor', 'offer_color');

$data = array(
              'name'        => 'offer_color',
              'id'          => 'offer_color',
              'value'       => $this->input->post('offer_color'),
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Pojemność [cm<sup>3</sup>]', 'offer_capacity');

$data = array(
              'name'        => 'offer_capacity',
              'id'          => 'offer_capacity',
              'value'       => $this->input->post('offer_capacity'),
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Zarejestrowany', 'offer_registered');

$data = array(
              'name'        => 'offer_registered',
              'id'          => 'offer_registered',
              'value'       => $this->input->post('offer_registered'),
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Rok produkcji', 'offer_production');

$data = array(
              'name'        => 'offer_production',
              'id'          => 'offer_production',
              'value'       => $this->input->post('offer_production'),
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Moc [KM]', 'offer_power');

$data = array(
              'name'        => 'offer_power',
              'id'          => 'offer_power',
              'value'       => $this->input->post('offer_power'),
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Cena brutto', 'offer_price');

$data = array(
              'name'        => 'offer_price',
              'id'          => 'offer_price',
              'value'       => $this->input->post('offer_price'),
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Silnik', 'offer_engine');

$data = array(
              'name'        => 'offer_engine',
              'id'          => 'offer_engine',
              'value'       => $this->input->post('offer_engine'),
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Status', 'offer_status');

$options = array(
                  0  => 'Inactive',
                  1  => 'Active',
                );
$data = 'id="status_offer"';

echo form_dropdown('offer_status', $options, $this->input->post('offer_status'), $data);
?>
</div>

<div class="v_f">
<?php
echo form_submit('mysubmit', 'Aktualizuj ofertę');
?>
</div>

<?php
echo form_close();
?>
</div>



