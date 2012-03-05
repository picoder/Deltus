<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="form">
<h2>
<?php
echo $this->lang->line('user_edit_form_title');
?>
</h2>
<?php
$attributes = array('id' => 'user_edit_form', 'class' => 'admin_form');

echo form_open(current_url(), $attributes);

echo '<div class="list">';

if($items->result_count() < 1)
{
	echo $this->lang->line('user_edit_form_no_result');
}
else
{
	echo '<div class="v header_list">';
	echo '<div class="l">';
	echo $this->lang->line('user_edit_form_username_header');
	echo '</div>';
	echo '<div class="l">';
	echo $this->lang->line('user_edit_form_email_header');
	echo '</div>';
	echo '<div class="l status">';
	echo $this->lang->line('user_edit_form_activated_header');
	echo '</div>';
	echo '<div class="l status">';
	echo $this->lang->line('user_edit_form_status_header');
	echo '</div>';
	echo '<div class="l">';
	echo $this->lang->line('user_edit_form_created_header');
	echo '</div>';
	echo '<div class="l">';
	echo $this->lang->line('user_edit_form_modified_header');
	echo '</div>';
	echo '<div class="l">';
	echo $this->lang->line('user_edit_form_assigned_header');
	echo '</div>';
	echo '<div class="l">';
	echo $this->lang->line('user_edit_form_actions_header');
	echo '</div>';
	echo '<div class="o e">';
	echo $this->lang->line('user_edit_form_delete_header');
	echo '</div>';
	echo '</div>';
	
	foreach($items as $item)
	{
		echo '<div class="v">';
		
		echo '<div class="l">';
		echo $item->username;
		echo '</div>';
		
		echo '<div class="l">';
		echo $item->email;
		echo '</div>';
		
		echo '<div class="l status">';
		switch($item->activated)
		{
			case 1:
			echo $this->lang->line('user_edit_form_activated_1');	
			break;
			case 0:
			echo $this->lang->line('user_edit_form_activated_0');	
			break;
		}
		echo '</div>';
		
		echo '<div class="l status">';
		switch($item->banned)
		{
			case 1:
			echo $this->lang->line('user_edit_form_status_1');	
			break;
			case 0:
			echo $this->lang->line('user_edit_form_status_0');	
			break;
		}
		echo '</div>';
		
		echo '<div class="l">';
		echo $item->created;
		echo '</div>';
		
		echo '<div class="l">';
		echo $item->modified;
		echo '</div>';
		
		echo '<div class="l">';
		echo $item->assigned_roles;
		echo '</div>';
		
		echo '<div class="l">';
		echo anchor($user_edit_base_url.$this->config->item('update_user_url').'/'.$item->id.'/', $this->lang->line('user_edit_form_update_link'));
		echo br();
		echo anchor($user_edit_base_url.$this->config->item('delete_user_url').'/'.$item->id.'/', $this->lang->line('user_edit_form_delete_link'));
		echo '</div>';
		
		echo '<div class="o e">';
		
		$data = array(
		'name'        => 'user_delete[]',
		'id'          => 'user_delete_'.$item->id,
		'value'       => $item->id,
		'checked'     => FALSE,
		);

		echo form_checkbox($data);
		
		echo '</div>';
		
		echo '</div>';
	}
}

echo '</div><!-- div.list -->';
?>

<!-- Form Row -->
<div class="v_f submit">
<?php
echo form_submit('validation_submit', $this->lang->line('user_edit_form_submit'));
?>
</div>
<!-- End Form Row -->

<?php
echo form_close();
?>
</div>

<div class="list_pagination">
<?php
	if($items->paged->has_previous)
	{
		echo anchor($user_edit_base_url.$this->config->item('edit_user_url').'/1/'.$user_edit_field_url.'/'.$user_edit_asc_url.'/'.$user_edit_filter_url, $this->lang->line('user_edit_form_first_page'));
		echo anchor($user_edit_base_url.$this->config->item('edit_user_url').'/'.$items->paged->previous_page.'/'.$user_edit_field_url.'/'.$user_edit_asc_url.'/'.$user_edit_filter_url, $this->lang->line('user_edit_form_prev_page'));
	}
	if($items->paged->has_next)
	{
		echo anchor($user_edit_base_url.$this->config->item('edit_user_url').'/'.$items->paged->next_page.'/'.$user_edit_field_url.'/'.$user_edit_asc_url.'/'.$user_edit_filter_url, $this->lang->line('user_edit_form_next_page'));
		echo anchor($user_edit_base_url.$this->config->item('edit_user_url').'/'.$items->paged->total_pages.'/'.$user_edit_field_url.'/'.$user_edit_asc_url.'/'.$user_edit_filter_url, $this->lang->line('user_edit_form_total_page'));
	}
?>
</div>
