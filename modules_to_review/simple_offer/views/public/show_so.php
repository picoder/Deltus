<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>
<h1 class="t_center">
<?php
echo $item->label;
?>
</h1>
<?php
foreach($item_galleries as $g)
{
	$this->load->view('simple_offer/parts/flashgallery_so', array('id' => $g->id));
}

?>
<div class="article">
<h2 class="t_center">Podsumowanie oferty</h2>
<table class="v_space_10">
<tr>
<td class="cat">Marka i model</td><td><?php echo $item->so_model; ?></td>
<td class="cat">Kolor</td><td><?php echo $item->so_color; ?></td>
</tr>
<tr>
<td class="cat">Pojemność</td><td><?php echo $item->so_capacity; ?> [ cm<sup>3</sup> ]</td>
<td class="cat">Zarejestrowny</td><td><?php echo $item->so_registered; ?></td>
</tr>
<tr>
<td class="cat">Rok produkcji</td><td><?php echo $item->so_production; ?></td>
<td class="cat">Moc</td><td><?php echo $item->so_power; ?> [ KM ]</td>
</tr>
<tr>
<td class="cat">Silnik</td>
<td class="cat"><?php echo $item->so_engine; ?></td>
<td class="cat">Cena brutto</td>
<td class="cat"><?php echo $item->so_price; ?> [ PLN ] </td>

</tr>
</table>
<p>
<?php
echo $item->content;
?>
</p>
</div><!--div.article-->