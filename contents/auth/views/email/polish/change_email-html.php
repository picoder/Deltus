<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Twój nowy adres e-mail związany z serwisem <?php echo $site_name; ?></title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Your new email address on <?php echo $site_name; ?></h2>
Twój adres e-mail powiązany z serwisem <?php echo $site_name; ?> został zmieniony.<br />
Wykorzystaj następujący link, by potwierdzic zmianę adresu e-mail:<br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/reset-email/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;">Potwierdź Twój nowy adres e-mail</a></b></big><br />
<br />
Jeśli link nie działa, skopiuj podany adres do paska adresu przeglądarki internetowej:<br />
<nobr><a href="<?php echo site_url('/auth/reset-email/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/reset-email/'.$user_id.'/'.$new_email_key); ?></a></nobr><br />
<br />
<br />
Twój nowy adres e-mail: <?php echo $new_email; ?><br />
<br />
<br />
Ta wiadomość została wysłana, ponieważ wykorzystano Twój adres e-mail powiązany z serwisem <a href="<?php echo site_url(''); ?>" style="color: #3366cc;"><?php echo $site_name; ?></a>. Jeśłi ta wiadomośc została wysłana pomyłkowo, nie klikaj w link potwierdzający. Po krótkim czasie żadanie zmiany e-mail zostanie wycofane z systemu.<br />
<br />
<br />
Dzięujemy,<br />
Zespół <?php echo $site_name; ?>
</td>
</tr>
</table>
</div>
</body>
</html>