<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


?>
<div class="success_page">
<?php
if($message)
{
	echo $message;
}
else
{
	echo $this->lang->line('success_page_default_msg');
}
?>
</div>