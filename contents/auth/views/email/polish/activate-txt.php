Witamy w <?php echo $site_name; ?>,

Dziękujemy za rejestrację w <?php echo $site_name; ?>. Podumowaliśmy dane Twojego konta poniżej. Prosimy o ich zabezpieczenie.
By potwierdzić podany przez Ciebie adres e-mail, wykorzystaj następujący link:

<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>


Prosimy o weryfikację adres e-mail w okresie <?php echo $activation_period; ?> godzin. W przeciwnym razie będzie konieczna ponowna rejestracja
<?php if (strlen($username) > 0) { ?>

Twój login: <?php echo $username; ?>
<?php } ?>

Twój adres e-mail: <?php echo $email; ?>
<?php if (isset($password)) { /* ?>

Your password: <?php echo $password; ?>
<?php */ } ?>



Powodzenia!
Zespół<?php echo $site_name; ?>