Witaj<?php if (strlen($username) > 0) { ?> <?php echo $username; ?><?php } ?>,

Zmieniono hasło użytkownika.
Prosimy o zapamiętanie danych dostępowych.
<?php if (strlen($username) > 0) { ?>

Twój login: <?php echo $username; ?>
<?php } ?>

Twój adres e-mail: <?php echo $email; ?>

<?php /* Your new password: <?php echo $new_password; ?>

*/ ?>

Dziękujemy,
Zespół <?php echo $site_name; ?>