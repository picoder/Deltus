<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


?>
<div class="no_page">
<?php
if($message)
{
	echo $message;
}
else
{
	echo $this->lang->line('no_page_default_msg');
}
?>
</div>