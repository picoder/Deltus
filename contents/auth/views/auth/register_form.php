<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
if ($use_username) {
    $login = array(
        'name' => 'login',
        'id' => 'login',
        'value' => set_value('login'),
        'maxlength' => $this->config->item('username_max_length', 'tank_auth'),
    );
    $login_label = $this -> lang -> line('login.auth.login_form');
}
$email = array(
    'name'  => 'email',
    'id'    => 'email',
    'value' => set_value('email'),
    'maxlength' => 80,
);
$password = array(
        'name' => 'password',
        'id' => 'password',
        'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    );
$confirm_password = array(
        'name' => 'confirm_password',
        'id' => 'confirm_password',
        'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    );
$captcha = array(
    'name'  => 'captcha',
    'id'    => 'captcha',
);

$attributes = array('id' => 'auth-form');

$err_bgn = '<div class="form-error"><label>&nbsp;</label>';
$err_end = '</div>';
?>

<h1><?php echo $this -> lang -> line('title.auth.register_form'); ?></h1>

<?php echo form_open($this -> uri -> uri_string(), $attributes); ?>

<?php if ($use_username) { ?>
    
<div>
    <?php echo form_label($login_label, $login['id']); ?>
    <?php echo form_input($login); ?>
</div>

<?php echo form_error($login['name'], $err_bgn, $err_end); ?>

<?php echo isset($errors[$login['name']]) ? $err_bgn.$errors[$login['name']].$err_end : ''; ?>

<?php } ?>


<div>
    <?php echo form_label($this -> lang -> line('email.auth.login_form'), $email['id']); ?>
    <?php echo form_input($email); ?>
</div>

<?php echo form_error($email['name'], $err_bgn, $err_end); ?>

<?php echo isset($errors[$email['name']]) ? $err_bgn.$errors[$email['name']].$err_end : ''; ?>


<div>
    <?php echo form_label($this -> lang -> line('password.auth.login_form'), $password['id']); ?>
    <?php echo form_password($password); ?>
</div>

<?php echo form_error($password['name'], $err_bgn, $err_end); ?>

<?php echo isset($errors[$password['name']]) ? $err_bgn.$errors[$password['name']].$err_end : ''; ?>


<div>
    <?php echo form_label($this -> lang -> line('confirm_password.auth.register_form'), $confirm_password['id']); ?>
    <?php echo form_password($confirm_password); ?>
</div>

<?php echo form_error($confirm_password['name'], $err_bgn, $err_end); ?>

<?php echo isset($errors[$confirm_password['name']]) ? $err_bgn.$errors[$confirm_password['name']].$err_end : ''; ?>

<?php if ($captcha_registration) {


if ($use_recaptcha) {
?>

<div id="recaptcha_image"></div>

<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
<div class="recaptcha_only_if_image">
    <a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a>
</div>
<div class="recaptcha_only_if_audio">
    <a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a>
</div>

<div class="recaptcha_only_if_image">
    Enter the words above
</div>
<div class="recaptcha_only_if_audio">
    Enter the numbers you hear
</div>
<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
<?php echo form_error('recaptcha_response_field'); ?>
<?php echo $recaptcha_html; ?>

<?php } else { ?>
<div>
    <label><?php echo $this -> lang -> line('captcha_info.auth.login_form'); ?></label>
    <?php echo $captcha_html; ?>
</div>
<div>
    <?php echo form_label($this -> lang -> line('captcha_input.auth.login_form'), $captcha['id']); ?>
    <?php echo form_input($captcha); ?>
</div>

<?php echo form_error($captcha['name'], $err_bgn, $err_end); ?>

<?php } ?>

<?php } ?>

<div>
    <label>&nbsp;</label>
    <input type="submit" value="<?php echo $this -> lang -> line('submit.auth.register_form'); ?>" class="ideal-button" />
</div>

<?php echo form_close(); ?>

<?php


$this->theme->set_mod_js('auth', 'register_idealforms', 'idealforms/'.$this -> config -> item('language').'/', 'body', 'contents');



