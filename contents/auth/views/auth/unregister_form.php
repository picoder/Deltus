<?php
$password = array(
        'name' => 'password',
        'id' => 'password',
        'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    );
    
    
    $attributes = array('id' => 'auth-form');

$err_bgn = '<div class="form-error"><label>&nbsp;</label>';
$err_end = '</div>';
    
?>

<h1><?php echo $this -> lang -> line('title.auth.unregister_form'); ?></h1>

<?php echo form_open($this -> uri -> uri_string(), $attributes); ?>

<div>
    <?php echo form_label($this -> lang -> line('password.auth.unregister_form'), $password['id']); ?>
    <?php echo form_password($password); ?>
</div>
<?php echo form_error($password['name'], $err_bgn, $err_end); ?>

<?php echo isset($errors[$password['name']]) ? $err_bgn.$errors[$password['name']].$err_end : ''; ?>


<div>
    <label>&nbsp;</label>
    <input type="submit" value="<?php echo $this -> lang -> line('submit.auth.unregister_form'); ?>" class="ideal-button" />
</div>

<?php echo form_close(); ?>

<?php

$this->theme->set_mod_js('auth', 'unregister_idealforms', 'idealforms/'.$this -> config -> item('language').'/', 'body', 'contents');


