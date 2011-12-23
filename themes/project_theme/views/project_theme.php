<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
echo head();
?>


<div class="w wrapper">
<div class="v top">
Top
</div>
<div class="v main">
<div class="l col_left">
Left column
</div>
<div class="r col_right">
Right column
</div>
<div class="e o col_mid">

<?php
echo create_surfaces('CONTENT');
?>

</div>
</div><!--div.main-->

</div><!--div.wrapper-->


<?php
echo end_html();
/* End of file project_theme.php */
/* Location: ./themes/project_theme/views/project_theme.php */