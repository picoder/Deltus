<?php $login = array(
        'name' => 'login',
        'id' => 'login',
        'value' => set_value('login'),
        'maxlength' => 80, // because it can be an email or login
    );

    $attributes = array('id' => 'auth-form');

    $err_bgn = '<div class="form-error"><label>&nbsp;</label>';
    $err_end = '</div>';

    if ($this -> config -> item('use_username', 'tank_auth'))
    {
        $login_label = $this -> lang -> line('email_or_login.auth.login_form');
    }
    else
    {
        $login_label = $this -> lang -> line('email.auth.login_form');
    }
?>

<h1><?php echo $this -> lang -> line('title.auth.forgot_password_form'); ?></h1>

<?php echo form_open($this -> uri -> uri_string(), $attributes); ?>

<div>
    <?php echo form_label($login_label, $login['id']); ?>
    <?php echo form_input($login); ?>
</div>

<?php echo form_error($login['name'], $err_bgn, $err_end); ?>

<?php echo isset($errors[$login['name']]) ? $err_bgn.$errors[$login['name']].$err_end : ''; ?>

<div>
    <label>&nbsp;</label>
    <input type="submit" value="<?php echo $this -> lang -> line('submit.auth.forgot_password_form'); ?>" class="ideal-button" />
</div>

<?php echo form_close(); ?>

<?php

$this->theme->set_mod_js('auth', 'forgot_password_idealforms', 'idealforms/'.$this -> config -> item('language').'/', 'body', 'contents');