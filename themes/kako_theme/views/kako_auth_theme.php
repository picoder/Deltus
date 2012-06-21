<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
echo $this->theme->get_head('kako_theme');
?>
<div class="w site">
<div class="v content">
<div class="r kako-box auth">
<?php
echo create_surfaces('CONTENT');

?>
</div><!-- .auth -->
<div class="e o kako-box ad">
Ad
</div><!-- .ad -->

</div><!-- .content -->





</div><!--.site-->


<?php
echo $this->theme->get_end_html('kako_theme');

