<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
//$this->matchbook->add_niceforms();
?>
<div class="form">
<?php
$attributes = array('id' => 'add_offer_form', 'class' => 'piform');

echo form_open($this->config->item('backend_url').'/'.$this->config->item('simple_offer_content_url').'/add', $attributes);
?>
<div class="v_f">
<?php
echo form_label('Nazwa oferty', 'offer_name');

$data = array(
              'name'        => 'offer_name',
              'id'          => 'offer_name',
              'value'       => '',
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
              'value'       => '',
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
              'value'       => '',
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
              'value'       => '',
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Treść oferty', 'offer_content');

$data = array(
              'name'        => 'offer_content',
              'id'          => 'offer_content',
              'value'       => '',
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
              'value'       => '',
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
              'value'       => '',
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
              'value'       => '',
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
              'value'       => '',
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
              'value'       => '',
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
              'value'       => '',
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
              'value'       => '',
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
              'value'       => '',
            );

echo form_input($data);
?>
</div>






<div id="uploader">
<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
</div>

<div class="v_f"></div>

<div class="v_f">
<?php
echo form_label('Status', 'offer_status');

$options = array(
                  0  => 'Dezaktywuj',
                  1    => 'Aktywuj',
                );
$data = 'id="status_offer"';

echo form_dropdown('offer_status', $options, 1, $data);
?>
</div>

<div class="v_f submit">
<?php
echo form_submit('mysubmit', 'Dodaj ofertę');
?>
</div>

<?php
echo form_close();
?>
</div>

