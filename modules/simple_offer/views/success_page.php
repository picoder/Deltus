<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="success_page">
<span class="t_center">
<?php

if($message != FALSE)
{
	echo $message;	
}
else
{
	echo 'Operacja zakończona sukcesem';
}

?>
</span>
</div>