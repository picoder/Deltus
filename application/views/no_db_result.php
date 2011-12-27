<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


?>
<div class="no_db_result">
<?php
if($message)
{
	echo $message;
}
else
{
	echo $this->lang->line('no_db_result_default_msg');
}
?>
</div>