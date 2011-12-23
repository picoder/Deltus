<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 foreach($items_array as $item)
 {
 ?>
 <div class='boxl v'>
 <div class='boxtopl v'><div></div></div>
  <div class='boxcontentl v'><img 
  alt = "<?php $item['item']->label; ?>" 
  src="<?php echo base_url();?>uploads/galleries/<?php echo $item['item_gallery']; ?>/widget/pati_thumb.jpg">
   <h5><?php echo anchor($this->division_builder->get_dv_url().'/ogloszenia/ogloszenie/'.$item['item']->link, $item['item']->label); ?></h5>
   <?php echo $item['item']->description; ?>
  </div>
 <div class='boxbottoml v'><div></div></div>
</div><!--div.boxl-->
<?php
}
?>