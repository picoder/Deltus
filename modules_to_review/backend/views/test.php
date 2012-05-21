<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$this->matchbook->add_head_snippet('backend/test_snippet');
?>

 <form action="" method="post" id="rejestracja">
    <p>
     <label for="login">Login:</label>
     <input name="login" />
    </p>
    <p>
     <label for="haslo1">Hasło:</label>
     <input type="password"  name="haslo1" />
    </p>
    <p>
     <label for="haslo2">Powtórz hasło:</label>
     <input  name="haslo2" />
    </p>
    <p>
     <label for="email">Email:</label>
     <input type="text"  name="email" />
    </p>
    <p>
    <input name="dodaj" value="Dodaj" />
    </p>
   </form>




