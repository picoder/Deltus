<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="form">

<?php
$attributes = array('id' => 'user_add_form', 'class' => 'admin_form');

echo form_open(current_url(), $attributes);
?>

<!-- Form Row -->
<div class="v_f">
<?php
echo form_label($this->lang->line('user_c_add_user_name'), 'user_name');

$data = array(
              'name'        => 'user_name',
              'id'          => 'user_name',
              'value'       => '',
            );

echo form_input($data);
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f">
<?php
echo form_label($this->lang->line('user_c_add_user_email'), 'user_email');

$data = array(
              'name'        => 'user_email',
              'id'          => 'user_email',
              'value'       => '',
            );

echo form_input($data);
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f">
<?php
echo form_label($this->lang->line('user_c_add_user_pass'), 'user_pass');

$data = array(
              'name'        => 'user_pass',
              'id'          => 'user_pass',
              'value'       => '',
            );

echo form_input($data);
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f">
<?php
echo form_label($this->lang->line('user_c_add_user_status'), 'user_status');

$options = array(
                  0  => $this->lang->line('user_c_add_user_status_inactive'),
                  1    => $this->lang->line('user_c_add_user_status_active'),
                );
$data = 'id="user_status"';

echo form_dropdown('user_status', $options, 1, $data);
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f submit">
<?php
echo form_submit('user_c_add_user_submit', $this->lang->line('user_c_add_user_submit'));
?>
</div>
<!-- End Form Row -->

<?php
echo form_close();
?>
</div>
