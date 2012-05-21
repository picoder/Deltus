<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="form">
<?php
$attributes = array('id' => 'add_category_form', 'class' => 'piform');

echo form_open('test/lab-content/soca/add', $attributes);
?>
<div class="v_f">
<?php
echo form_label('Nazwa kategorii', 'soca_name');

$data = array(
              'name'        => 'soca_name',
              'id'          => 'soca_name',
              'value'       => '',
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Etykieta menu', 'soca_label');

$data = array(
              'name'        => 'soca_label',
              'id'          => 'soca_label',
              'value'       => '',
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo form_label('Link menu', 'soca_link');

$data = array(
              'name'        => 'soca_link',
              'id'          => 'soca_link',
              'value'       => '',
            );

echo form_input($data);
?>
</div>

<div class="v_f">
<?php
echo $formpart_parent_soca;
?>
</div>



<div class="v_f submit">
<?php
echo form_submit('mysubmit', 'Dodaj kategorię');
?>
</div>

<?php
echo form_close();
?>
</div>



