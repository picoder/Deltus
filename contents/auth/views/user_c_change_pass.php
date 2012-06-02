<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="form">

<?php
$attributes = array('id' => 'user_c_change_pass_form', 'class' => 'admin_form');

echo form_open(current_url(), $attributes);
?>

<!-- Form Row -->
<div class="v_f">
<?php
echo form_label($this->lang->line('user_c_change_pass_new_password'), 'new_password');

$data = array(
              'name'        => 'new_password',
              'id'          => 'new_password',
            );

echo form_input($data);
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f submit">
<?php
echo form_submit('user_c_change_pass_submit', $this->lang->line('user_c_change_pass_submit'));
?>
</div>
<!-- End Form Row -->

<?php
echo form_close();
?>
</div>