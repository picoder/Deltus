<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
echo $this->theme->get_head('kako_theme');
?>
<div class="w site">
<div class="v content">
<div class="l kako-box ad">
Ad
</div><!-- .ad -->
<div class="e o kako-box back">
<?php
echo create_surfaces('CONTENT');

?>
</div><!-- .back -->


</div><!-- .content -->





</div><!--.site-->


<?php
echo $this->theme->get_end_html('kako_theme');

