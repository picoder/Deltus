<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Witamy w <?php echo $site_name; ?>!</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Witamy w <?php echo $site_name; ?>!</h2>
Dziękujemy za rejestrację w <?php echo $site_name; ?>. Podumowaliśmy dane Twojego konta poniżej. Prosimy o ich zabezpieczenie.<br />
By potwierdzić podany przez Ciebie adres e-mail, kliknij w link:<br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;">Prosimy o ukończenie procesu rejestracji...</a></b></big><br />
<br />
Jeśli link nie działa, skopiuj podany adres do paska adresu przeglądarki internetowej:<br />
<nobr><a href="<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?></a></nobr><br />
<br />
Prosimy o weryfikację adres e-mail w okresie <?php echo $activation_period; ?> godzin. W przeciwnym razie będzie konieczna ponowna rejestracja<br />
<br />
<br />
<?php if (strlen($username) > 0) { ?>Twój login: <?php echo $username; ?><br /><?php } ?>
Twój adres e-mail: <?php echo $email; ?><br />
<?php if (isset($password)) { /* ?>Your password: <?php echo $password; ?><br /><?php */ } ?>
<br />
<br />
Powodzenia!<br />
Zepół <?php echo $site_name; ?>
</td>
</tr>
</table>
</div>
</body>
</html>