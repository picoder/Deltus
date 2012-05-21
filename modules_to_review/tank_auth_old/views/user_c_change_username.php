<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="form">

<div class="v_f">
<?php
echo $current_username;
?>
</div>
	
<?php
$attributes = array('id' => 'user_c_change_username_form', 'class' => 'admin_form');

echo form_open(current_url(), $attributes);
?>

<!-- Form Row -->
<div class="v_f">
<?php
echo form_label($this->lang->line('user_c_change_username_new_username'), 'new_username');

$data = array(
              'name'        => 'new_username',
              'id'          => 'new_username',
            );

echo form_input($data);
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f submit">
<?php
echo form_submit('user_c_change_username_submit', $this->lang->line('user_c_change_username_submit'));
?>
</div>
<!-- End Form Row -->

<?php
echo form_close();
?>
</div>