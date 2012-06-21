<?php
$password = array(
        'name' => 'password',
        'id' => 'password',
        'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    );
$email = array(
    'name'  => 'email',
    'id'    => 'email',
    'value' => set_value('email'),
    'maxlength' => 80,
);

$attributes = array('id' => 'auth-form');

$err_bgn = '<div class="form-error"><label>&nbsp;</label>';
$err_end = '</div>';

?>

<h1><?php echo $this -> lang -> line('title.auth.change_email_form'); ?></h1>

<?php echo form_open($this -> uri -> uri_string(), $attributes); ?>

<div>
    <?php echo form_label($this -> lang -> line('password.auth.change_email_form'), $password['id']); ?>
    <?php echo form_password($password); ?>
</div>
<?php echo form_error($password['name'], $err_bgn, $err_end); ?>

<?php echo isset($errors[$password['name']]) ? $err_bgn.$errors[$password['name']].$err_end : ''; ?>

<div>
    <?php echo form_label($this -> lang -> line('email.auth.change_email_form'), $email['id']); ?>
    <?php echo form_input($email); ?>
</div>

<?php echo form_error($email['name'], $err_bgn, $err_end); ?>

<?php echo isset($errors[$email['name']]) ? $err_bgn.$errors[$email['name']].$err_end : ''; ?>


<div>
    <label>&nbsp;</label>
    <input type="submit" value="<?php echo $this -> lang -> line('submit.auth.change_email_form'); ?>" class="ideal-button" />
</div>

<?php echo form_close(); ?>

<?php

$this->theme->set_mod_js('auth', 'change_email_idealforms', 'idealforms/'.$this -> config -> item('language').'/', 'body', 'contents');
