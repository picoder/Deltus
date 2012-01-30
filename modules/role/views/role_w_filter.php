<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="form">

<?php
$url = '';
for($i = 1; $i < $this->division_builder->get_cur_seg(); $i++)
{
	$url .= $this->uri->segment($i).'/';
}
?>

<?php
$attributes = array('id' => 'role_filter_form', 'class' => 'admin_form');

echo form_open($url.$this->config->item('edit_role_url').'/', $attributes);
?>
<h2>Filtr statusu</h2>

<!-- Form Row -->
<div class="v_f">
<?php
$data = array(
		'name'        => 'filter_status',
		'id'          => 'filter_status_off',
		'value'       => 'off',
		'checked'     => TRUE,
		);

echo form_radio($data);
echo form_label($this->lang->line('filter_status_off_description'), 'filter_status_off');
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f">
<?php
$data = array(
		'name'        => 'filter_status',
		'id'          => 'filter_status_1',
		'value'       => 1,
		);

echo form_radio($data);
echo form_label($this->lang->line('filter_status_1_description'), 'filter_status_1');
?>
</div>
<!-- End Form Row -->


<!-- Form Row -->
<div class="v_f">
<?php
$data = array(
		'name'        => 'filter_status',
		'id'          => 'filter_status_0',
		'value'       => 0,
		);

echo form_radio($data);
echo form_label($this->lang->line('filter_status_0_description'), 'filter_status_0');
?>
</div>
<!-- End Form Row -->

<h2>Filtr użytkowników</h2>

<!-- Form Row -->
<div class="v_f">
<?php
$data = array(
		'name'        => 'filter_users',
		'id'          => 'filter_users_off',
		'value'       => 'off',
		'checked'     => TRUE,
		);

echo form_radio($data);
echo form_label($this->lang->line('filter_users_off_description'), 'filter_users_off');
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f">
<?php
$data = array(
		'name'        => 'filter_users',
		'id'          => 'filter_users_1',
		'value'       => 1,
		);

echo form_radio($data);
echo form_label($this->lang->line('filter_users_1_description'), 'filter_users_1');
?>
</div>
<!-- End Form Row -->

<!-- Form Row -->
<div class="v_f">
<?php
$data = array(
		'name'        => 'filter_users',
		'id'          => 'filter_users_0',
		'value'       => 0,
		);

echo form_radio($data);
echo form_label($this->lang->line('filter_users_0_description'), 'filter_users_0');
?>
</div>
<!-- End Form Row -->



<?php
# Flag for edit_filter controller in Role_c class
echo form_hidden('filter', TRUE)
?>

<!-- Form Row -->
<div class="v_f submit">
<?php
echo form_submit('mysubmit', $this->lang->line('role_filter_form_submit'));
?>
</div>
<!-- End Form Row -->

<?php
echo form_close();
?>

</div><!-- div.form -->