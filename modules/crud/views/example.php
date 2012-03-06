<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
</head>
<body>
	<div>
		<a href='<?php echo site_url('test/lab-content/crud/customers_management')?>'>Customers</a> |
		<a href='<?php echo site_url('test/lab-content/crud/orders_management')?>'>Orders</a> |
		<a href='<?php echo site_url('test/lab-content/crud/products_management')?>'>Products</a> |
		<a href='<?php echo site_url('test/lab-content/crud/offices_management')?>'>Offices</a> | 
		<a href='<?php echo site_url('test/lab-content/crud/employees_management')?>'>Employees</a> |		 
		<a href='<?php echo site_url('test/lab-content/crud/film_management')?>'>Films</a>
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
