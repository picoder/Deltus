<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 

$login = array(
        'name' => 'login',
        'id' => 'login',
        'value' => set_value('login'),
        'maxlength' => 80, // because it can be an email or login
    );
    if ($login_by_username AND $login_by_email)
    {
        $login_label = $this -> lang -> line('email_or_login.auth.login_form');
    }
    else
    if ($login_by_username)
    {
        $login_label = $this -> lang -> line('login.auth.login_form');
    }
    else
    {
        $login_label = $this -> lang -> line('email.auth.login_form');
    }
    $password = array(
        'name' => 'password',
        'id' => 'password',
        'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    );

    $captcha = array(
        'name' => 'captcha',
        'id' => 'captcha',
    );
    $attributes = array('id' => 'auth-form');
    
    $err_bgn = '<div class="form-error"><label>&nbsp;</label>';
    $err_end = '</div>';
?>

<h1><?php echo $this -> lang -> line('title.auth.login_form'); ?></h1>

<?php echo form_open($this -> uri -> uri_string(), $attributes); ?>

<div>
    <?php echo form_label($login_label, $login['id']); ?>
    <?php echo form_input($login); ?>
</div>

<?php echo form_error($login['name'], $err_bgn, $err_end); ?>

<?php echo isset($errors[$login['name']]) ? $err_bgn.$errors[$login['name']].$err_end : ''; ?>

<div>
    <?php echo form_label($this -> lang -> line('password.auth.login_form'), $password['id']); ?>
    <?php echo form_password($password); ?>
</div>
<?php echo form_error($password['name'], $err_bgn, $err_end); ?>

<?php echo isset($errors[$password['name']]) ? $err_bgn.$errors[$password['name']].$err_end : ''; ?>

<?php if ($show_captcha) { ?>

<?php
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
    <label>
        <input type="checkbox" name="remember" value="1"id="remember"/>
        <?php echo $this -> lang -> line('remember.auth.login_form'); ?></label>
</div>
<div>
    <label>&nbsp;</label>
    <input type="submit" value="<?php echo $this -> lang -> line('submit.auth.login_form'); ?>" class="ideal-button" />
</div>

<?php echo form_close(); ?>
<p class="form-links">
    <a href="#" title="#" target="_self"><?php echo $this -> lang -> line('forgot_link.auth.login_form'); ?></a>
    <a href="#" title="#" target="_self"><?php echo $this -> lang -> line('register_link.auth.login_form'); ?></a>
</p>

<?php

$this->theme->set_mod_js('auth', 'login_idealforms', 'idealforms/'.$this -> config -> item('language').'/', 'body', 'contents');


