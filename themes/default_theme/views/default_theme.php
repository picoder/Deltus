<?php
# matchbook helper
echo head();
?> 



<div class="container">
<?php
echo create_surfaces('CONTENT');
?>
</div>
<hr />
<div class="container">
<?php
echo create_surfaces('SIDEBAR');
?>
</div>
<?php
# matchbook helper
echo end_html();


/* End of file default_theme.php */
/* Location: ./themes/default_theme/controllers/default_theme.php */