<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$plupload_path = base_url().'extends';
?>

<!-- Third party script for BrowserPlus runtime (Google Gears included in Gears runtime now) -->
<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->
<script type="text/javascript" src="<?php echo $plupload_path;?>/plupload/js/plupload.full.js"></script>

<script type="text/javascript">

function test()
{

$.post("<?php echo base_url();?>ajax-division/simple_offer/content/test", function(data) {
   alert("Data Loaded: " + data);
 });
}
// Custom example logic
$(function() {
	var uploader = new plupload.Uploader({
		runtimes : 'gears,flash,html5,silverlight,browserplus',
		browse_button : 'pickfiles',
		container : 'uploader',
		max_file_size : '10mb',
		url : '<?php echo base_url();?>ajax-division/simple_offer/content/plupload',
		flash_swf_url : '<?php echo $plupload_path;?>/plupload/js/plupload.flash.swf',
		silverlight_xap_url : '<?php echo $plupload_path;?>/plupload/js/plupload.silverlight.xap',
		filters : [
			{title : "Image files", extensions : "jpg,gif,png"},
			{title : "Zip files", extensions : "zip"}
		],
		resize : {width : 320, height : 240, quality : 90}
	});

/*	uploader.bind('Init', function(up, params) {
		$('#filelist').html("<div>Current runtime: " + params.runtime + "</div>");
	});*/
	
	uploader.bind('Init', function(up, params) {
		$('#filelist').html("");
	});

	$('#uploadfiles').click(function(e) {
		
		uploader.start();
		e.preventDefault();
	});

	uploader.init();

	uploader.bind('FilesAdded', function(up, files) {
		$.each(files, function(i, file) {
			$('#filelist').append(
				'<div id="' + file.id + '">' +
				file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
			'</div>');
		});

		up.refresh(); // Reposition Flash/Silverlight
	});

	uploader.bind('UploadProgress', function(up, file) {
		$('#' + file.id + " b").html(file.percent + "%");
	});

	uploader.bind('Error', function(up, err) {
		$('#filelist').append("<div>Error: " + err.code +
			", Message: " + err.message +
			(err.file ? ", File: " + err.file.name : "") +
			"</div>"
		);

		up.refresh(); // Reposition Flash/Silverlight
	});

	uploader.bind('FileUploaded', function(up, file) {
		$('#' + file.id + " b").html("100%");
	});
});
</script>

			