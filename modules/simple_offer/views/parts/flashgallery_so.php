<!-- Div that contains gallery. -->
<div id="gallery">
<h1>No flash player!</h1>
<p>It looks like you don't have flash player installed. <a href="http://www.macromedia.com/go/getflashplayer" >Click here</a> to go to Macromedia download page.</p>
</div>
<script language="javascript" type="text/javascript">
var so = new SWFObject("<?php echo base_url();?>extends/flashgallery/flashgallery.swf", "gallery", "100%", "500", "8"); // Location of SWF file. You can change gallery width and height here (using pixels or percents).
so.addParam("quality", "high");
so.addParam("allowFullScreen", "true");
so.addParam("wmode", "transparent");
so.addVariable("content_path","../../uploads/galleries/<?php echo $id; ?>"); // Location of a folder with JPG and PNG files (relative to php script).
so.addVariable("color_path","<?php echo base_url();?>extends/flashgallery/default.xml"); // Location of XML file with settings.
so.addVariable("script_path","<?php echo base_url();?>extends/flashgallery/flashgallery.php"); // Location of PHP script.
so.write("gallery");
</script>