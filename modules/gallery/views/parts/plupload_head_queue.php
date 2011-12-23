<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$plupload_path = base_url().'extends';
?>

<!-- Load Queue widget CSS -->
<!-- jQuery is loaded by default in theme -->

<style type="text/css">@import url(http://auto-pati.pl/extends/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css);</style>

<!-- Third party script for BrowserPlus runtime (Google Gears included in Gears runtime now) -->
<!--<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>-->

<!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->
<script type="text/javascript" src="<?php echo $plupload_path;?>/plupload/js/plupload.full.js"></script>
<script type="text/javascript" src="<?php echo $plupload_path;?>/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script type="text/javascript">
plupload.addI18n({
        'Select files' : 'Wybierz pliki',
        'Add files to the upload queue and click the start button.' : 'Pliki do wysłania',
        'Filename' : 'Nazwa pliku',
        'Status' : 'Status',
        'Size' : 'Rozmiar',
        'Add files' : 'Dodaj pliki',
    'Start upload':'Zacznij wysyłać',
        'Stop current upload' : 'Zatrzymaj wysyłanie',
        'Start uploading queue' : 'Zacznij wysyłać kolejkę',
        'Drag files here.' : 'Przeciągniej tu pliki'
});
</script>
<script type="text/javascript">
// Convert divs to queue widgets when the DOM is ready
$(function() {
	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'flash,silverlight,html5',
		url : '<?php echo base_url();?>ajax-division/gallery/ajax/ajax_plupload', //in module division, controller division there is routing ajax-division
		max_file_size : '20mb',
		chunk_size : '1mb',
		unique_names : true,

		// Resize images on clientside if we can
		resize : {width : 6000, height : 4000, quality : 100},

		// Specify what files to browse for
		filters : [
			{title : "Image files", extensions : "jpg,gif,png,jpeg"},
			{title : "Zip files", extensions : "zip"},
			{title : "Raw files", extensions : "cr2,arw"},
			{title : "Txt files", extensions : "doc,docx,txt"}
		],

		// Flash settings
		flash_swf_url : '<?php echo $plupload_path;?>/plupload/js/plupload.flash.swf',

		// Silverlight settings
		silverlight_xap_url : '<?php echo $plupload_path;?>/plupload/js/plupload.silverlight.xap'
	});

	// Client side form validation
	$('form').submit(function(e) {
        var uploader = $('#uploader').pluploadQueue();
		
        // Files in queue upload them first
        if (uploader.files.length >= 0) {
            // When all files are uploaded submit form
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                    $('form')[0].submit();
                }
            });
                
            uploader.start();
        } else {
            alert('You must queue at least one file.');
        }

        return false;
    });
});
</script>
