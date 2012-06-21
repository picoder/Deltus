Witaj <?php if (strlen($username) > 0) { ?> <?php echo $username; ?><?php } ?>,

Twój adres e-mail powiązany z serwisem <?php echo $site_name; ?> został zmieniony.
Wykorzystaj następujący link, by potwierdzic zmianę adresu e-mail:

<?php echo site_url('/auth/reset-email/'.$user_id.'/'.$new_email_key); ?>


Twój nowy adres e-mail: <?php echo $new_email; ?>


Ta wiadomość została wysłana, ponieważ wykorzystano Twój adres e-mail powiązany z serwisem <?php echo $site_name; ?> . Jeśłi ta wiadomośc została wysłana pomyłkowo, nie klikaj w link potwierdzający. Po krótkim czasie żadanie zmiany e-mail zostanie wycofane z systemu.


Dziękujemy,
Zespół <?php echo $site_name; ?>