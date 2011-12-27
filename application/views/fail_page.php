<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


?>
<div class="fail_page">
<?php
if($message)
{
	echo $message;
}
else
{
	echo $this->lang->line('fail_page_default_msg');
}
?>
</div>