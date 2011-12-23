<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
echo head();
?>


<div class="w wrapper">
<div class="v top">
<h1 class="t_center">Panel administracyjny Auto-Pati.pl</h1>
</div>
<div class="v main">
<div class="l col_left">
<?php
$this->load->view('admin_theme/left_menu');
?>
</div>
<div class="r col_right">
Right column
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
echo end_html();
/* End of file project_theme.php */
/* Location: ./themes/project_theme/views/project_theme.php */