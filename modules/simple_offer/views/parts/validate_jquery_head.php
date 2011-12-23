<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
<!--<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/additional-methods.min.js"></script>-->

<script type="text/javascript">

$(document).ready(function(){
$("form").validate({
 rules: 
 {	 
  offer_name: {
   required: true,
   minlength: 4
   },
  offer_label: {
   required: true,
   minlength: 4
   },
  offer_link: {
   required: true,
   minlength: 2
  }
  },
  messages: {
   offer_name:{
   required: "Proszę podać login",
   minlength: "Minimalna długość nazwy to 4 znaki"
   },
   offer_label:{
    required: "Pole hasło nie może być puste",
    minlength: "Minimalna długość hasła to 5 znaków"
   },
   offer_link:{
    required: "Powtórz hasło",
    equalTo: "Hasła są różne"
   }
   },
   success: function(label) {
   label.html("&nbsp;").addClass("checked_control");
   }
  });
});

</script>