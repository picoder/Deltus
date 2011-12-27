<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="form">

<div class="v form_fail">
<?php
echo $this->lang->line('role_add_form_fail_info');
?>
</div>

<div class="v validation_errors">
<?php echo validation_errors(); ?>
</div>

<?php
$attributes = array('id' => 'role_add_form', 'class' => 'admin_form');

echo form_open(current_url(), $attributes);
?>

<!-- Form Row -->
<div class="v_f">
<?php
echo form_label($this->lang->line('role_add_form_role_name'), 'role_name');

$data = array(
              'name'        => 'role_name',
              'id'          => 'role_name',
              'value'       => $this->input->post('role_name'),
            );

echo form_input($data);
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f">
<?php
echo form_label($this->lang->line('role_add_form_role_description'), 'role_description');

$data = array(
              'name'        => 'role_description',
              'id'          => 'role_description',
              'value'       => $this->input->post('role_description'),
            );

echo form_textarea($data);
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f">
<?php
echo form_label($this->lang->line('role_add_form_role_status'), 'role_status');

$options = array(
                  0  => $this->lang->line('role_add_form_role_status_inactive'),
                  1    => $this->lang->line('role_add_form_role_status_active'),
                );
$data = 'id="role_status"';

echo form_dropdown('role_status', $options, $this->input->post('role_status'), $data);
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f submit">
<?php
echo form_submit('mysubmit', $this->lang->line('role_add_form_role_submit'));
?>
</div>
<!-- End Form Row -->

<?php
echo form_close();
?>
</div>
