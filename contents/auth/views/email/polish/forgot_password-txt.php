Hi<?php if (strlen($username) > 0) { ?> <?php echo $username; ?><?php } ?>,

Jeśli zapomniałeś hasła, pomożemy Ci teraz - utworzysz nowe hasło.
By to zrobić, wykorzystaj następujący adres:

<?php echo site_url('/auth/reset-password/'.$user_id.'/'.$new_pass_key); ?>


Ta wiadomość została wysłana, ponieważ wykorzystano Twój adres e-mail powiązany z serwisem <?php echo $site_name; ?>. Ta wiadomośc została wysłana w wyniku procedury zmiany hasła do systemu. Jeśli ten użytkownik nie żądał zmiany hasła, zignoruj tę wiadomość, hasło pozostanie niezmienione.


Dziękujemy,
Zespół <?php echo $site_name; ?>