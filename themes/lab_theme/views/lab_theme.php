<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
echo $this->theme->get_head('lab_theme');
?>
<div class="w wrapper">
<div class="v top">
<h1 class="t_center">Panel administracyjny Lab</h1>
</div>
<div class="v main">
<div class="l col_left">
<?php
echo modules::run('simple_offer/menus/socategory_menu/index');
?>
</div>
<div class="r col_right">
<?php
echo create_surfaces('WIDGET');
?>
</div>
<div class="e o col_mid">
<div class="col_mid_inner">

<?php
echo create_surfaces('CONTENT');

?>
</div>
</div><!-- div.col_mid -->
</div><!--div.main-->

</div><!--div.wrapper-->


<?php
echo $this->theme->get_end_html('lab_theme');
