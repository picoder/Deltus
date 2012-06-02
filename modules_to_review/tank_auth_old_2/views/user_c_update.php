<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="form">

<?php
$attributes = array('id' => 'user_c_update_form', 'class' => 'admin_form');

echo form_open(current_url(), $attributes);
?>

<!-- Form Row -->
<!--
<div class="v_f">
<?php
echo form_label($this->lang->line('user_c_update_user_name'), 'user_name');

$data = array(
              'name'        => 'user_name',
              'id'          => 'user_name',
              'value'       => $u->username,
            );

echo form_input($data);
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<!--
<div class="v_f">
<?php
echo form_label($this->lang->line('user_c_update_user_email'), 'user_email');

$data = array(
              'name'        => 'user_email',
              'id'          => 'user_email',
              'value'       => $u->email,
            );

echo form_input($data);
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f">
<?php
# only when updating users we can set activated as TRUE (in case when user cannot do it himself)
echo form_label($this->lang->line('user_c_update_user_activated'), 'user_activated');

$options = array(
                  0  => $this->lang->line('user_c_update_user_activated_inactive'),
                  1    => $this->lang->line('user_c_update_user_activated_active'),
                );
$data = 'id="user_activated"';

echo form_dropdown('user_activated', $options, $u->activated, $data);
?>
</div>
<!-- End Form Row -->



<!-- Form Row -->
<div class="v_f">
<?php
echo form_label($this->lang->line('user_c_update_user_status'), 'user_status');

$options = array(
                  0  => $this->lang->line('user_c_update_user_status_inactive'),
                  1    => $this->lang->line('user_c_update_user_status_active'),
                );
$data = 'id="user_status"';

echo form_dropdown('user_status', $options, $u->banned, $data);
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f">
<?php
echo form_label($this->lang->line('user_c_update_roles'), 'roles');
$data = 'id="roles"';
echo form_dropdown('roles', $roles, $user_roles, $data);
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f submit">
<?php
echo form_submit('user_c_update_user_submit', $this->lang->line('user_c_update_user_submit'));
?>
</div>
<!-- End Form Row -->

<?php
echo form_close();
?>
</div>
