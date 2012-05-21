<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
$("#rejestracja").validate({
 rules: {
  login: {
   required: true,
   minlength: 4
   },
  haslo1: {
   required: true,
   minlength: 5
   },
  haslo2: {
   required: true,
   equalTo: "#haslo1"
   },
   email: {
    required: true,
    email: true
   }
  },
  messages: {
   login:{
   required: "Prosze podać login",
   minlength: "Minimalna długość nazwy to 4 znaki"
   },
   haslo1:{
    required: "Pole hasło nie może być puste",
    minlength: "Minimalna długość hasła to 5 znaków"
   },
   haslo2:{
    required: "Powtórz hasło",
    equalTo: "Hasła są różne"
   },
   email:{
    required: "Wprowadź adres e-mail",
    email: "Wprowadź poprawny adres e-mail"
   }
  },
   success: function(label) {
   label.html("&nbsp;").addClass("sprawdzony");
   }
  });
});

</script>