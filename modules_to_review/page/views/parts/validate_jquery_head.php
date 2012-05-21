<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
<!--<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/additional-methods.min.js"></script>-->

<script type="text/javascript">

$(document).ready(function(){
$("form").validate({
 rules: 
 {	 
  page_name: {
   required: true,
   minlength: 4
   },
  page_label: {
   required: true,
   minlength: 4
   },
  page_link: {
   required: true,
   minlength: 2
  }
  },
  messages: {
   page_name:{
   required: "Pole nie może być puste",
   minlength: "Minimalna długość to 4 znaki"
   },
   page_label:{
    required: "Pole nie może być puste",
    minlength: "Minimalna długość to 4 znaki"
   },
   page_link:{
    required: "Pole nie może być puste",
    minlength: "Minimalna długość to 4 znaki"
   }
   },
   success: function(label) {
   label.html("&nbsp;").addClass("checked_control");
   }
  });
});

</script>