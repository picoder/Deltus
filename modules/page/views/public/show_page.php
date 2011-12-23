<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*echo $item->name.br();
foreach($item_galleries as $g)
{
	echo $g->id.br();
}*/
?>

<div class="article">
<h1><?php echo $item->label; ?></h1>
<p>
<?php echo $item->content; ?>
</p>
</div>