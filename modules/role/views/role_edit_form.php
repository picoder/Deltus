<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="form">
<h2>
<?php
echo $this->lang->line('role_edit_form_title');
?>
</h2>

<?php
$attributes = array('id' => 'role_edit_form', 'class' => 'admin_form');

echo form_open(current_url(), $attributes);
if($items->result_count() < 1)
{
	echo $this->lang->line('role_edit_form_no_result');
}
else
{

	foreach($items as $item)
	{
		echo $item->name;
		echo '<span> | </span>';
		echo $item->description;
		echo '<span> | </span>';
		echo $item->status;
		echo '<span> | </span>';
		echo $item->created;
		echo '<span> | </span>';
		echo $item->modified;
		echo '<span> | </span>';
		echo anchor($role_edit_base_url.$this->config->item('update_role_url').'/'.$item->id.'/', $this->lang->line('role_edit_form_update_link'));
		echo '<span> | </span>';
		echo anchor($role_edit_base_url.$this->config->item('delete_role_url').'/'.$item->id.'/', $this->lang->line('role_edit_form_delete_link'));
		echo br();
	}
	
	if($items->paged->has_previous)
	{
		echo anchor($role_edit_base_url.$this->config->item('edit_role_url').'/1/'.$field.'/'.$asc.'/', $this->lang->line('role_edit_form_first_page'));
		echo anchor($role_edit_base_url.$this->config->item('edit_role_url').'/'.$items->paged->previous_page.'/'.$field.'/'.$asc.'/', $this->lang->line('role_edit_form_prev_page'));
	}
	if($items->paged->has_next)
	{
		echo anchor($role_edit_base_url.$this->config->item('edit_role_url').'/'.$items->paged->next_page.'/'.$field.'/'.$asc.'/', $this->lang->line('role_edit_form_next_page'));
		echo anchor($role_edit_base_url.$this->config->item('edit_role_url').'/'.$items->paged->total_pages.'/'.$field.'/'.$asc.'/', $this->lang->line('role_edit_form_total_page'));
	}
	
}

?>


<?php
echo form_close();
?>
</div>
