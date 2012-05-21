<div id="slideshow">
    <div id="slidesContainer">
    <?php
	foreach($items_array as $item)
 	{
	?>
      <div class="slide">
        <h2><?php echo anchor($this->division_builder->get_dv_url().'/ogloszenia/ogloszenie/'.$item['item']->link, $item['item']->label); ?></h2>
        <p>
        <img class="l" src="<?php echo base_url();?>uploads/galleries/<?php echo $item['item_gallery']; ?>/widget/l_thumb.jpg" alt="Auto-handel Pati">
        <img class="r" src="<?php echo base_url();?>uploads/galleries/<?php echo $item['item_gallery']; ?>/widget/r_thumb.jpg" alt = "<?php echo $item['item']->label == '' ? 'Auto-handel Pati' : $item['item']->label; ?>" >
         <?php echo $item['item']->description; ?>
         </p>
      </div>
      <?php
	}
	?>
      
    </div>
</div><!-- div#slideshow-->