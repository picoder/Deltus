Witamy w <?php echo $site_name; ?>,

Dziękujemy za rejestrację w <?php echo $site_name; ?>. Podumowaliśmy dane Twojego konta poniżej. Prosimy o ich zabezpieczenie.
By zalogować się w serwisie <?php echo $site_name; ?> , prosimy o kliknięcie w następujący link:<br />

<?php echo site_url('/auth/login/'); ?>

<?php if (strlen($username) > 0) { ?>

Twój login: <?php echo $username; ?>
<?php } ?>

Twój adres e-mail: <?php echo $email; ?>

<?php /* Your password: <?php echo $password; ?>

*/ ?>

Powodzenia!
Zespół <?php echo $site_name; ?>