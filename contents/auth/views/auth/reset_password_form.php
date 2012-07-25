<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 ?>

<?php $new_password = array(
        'name' => 'new_password',
        'id' => 'new_password',
        'maxlength' => $this -> config -> item('password_max_length', 'tank_auth'),
    );
    $confirm_new_password = array(
        'name' => 'confirm_new_password',
        'id' => 'confirm_new_password',
        'maxlength' => $this -> config -> item('password_max_length', 'tank_auth'),
    );

    $attributes = array('id' => 'auth-form');

    $err_bgn = '<div class="form-error"><label>&nbsp;</label>';
    $err_end = '</div>';
?>
<h1><?php echo $this -> lang -> line('title.auth.reset_password_form'); ?></h1>

<?php echo form_open($this -> uri -> uri_string(), $attributes); ?>




<div>
    <?php echo form_label($this -> lang -> line('new_password.auth.reset_password_form'), $new_password['id']); ?>
    <?php echo form_input($new_password); ?>
</div>

<?php echo form_error($new_password['name'], $err_bgn, $err_end); ?>

<?php echo isset($errors[$new_password['name']]) ? $err_bgn . $errors[$new_password['name']] . $err_end : ''; ?>

<div>
    <?php echo form_label($this -> lang -> line('confirm_new_password.auth.reset_password_form'), $confirm_new_password['id']); ?>
    <?php echo form_input($confirm_new_password); ?>
</div>

<?php echo form_error($confirm_new_password['name'], $err_bgn, $err_end); ?>

<?php echo isset($errors[$confirm_new_password['name']]) ? $err_bgn . $errors[$confirm_new_password['name']] . $err_end : ''; ?>

<div>
    <label>&nbsp;</label>
    <input type="submit" value="<?php echo $this -> lang -> line('submit.auth.reset_password_form'); ?>" class="ideal-button" />
</div>

<?php echo form_close(); ?>

<?php

    $this -> theme -> set_mod_js('auth', 'reset_password_idealforms', 'idealforms/'.$this -> config -> item('language').'/', 'body', 'contents');