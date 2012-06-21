<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Nowe hasło użytkowniika w serwisie <?php echo $site_name; ?></title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Nowe hasło użytkowniika</h2>
Jeśli zapomniałeś hasła, pomożemy Ci teraz - utworzysz nowe hasło.<br />
By to zrobić, kliknij w następujący link:<br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/reset-password/'.$user_id.'/'.$new_pass_key); ?>" style="color: #3366cc;">Utwórz nowe hasło</a></b></big><br />
<br />
Jeśli link nie działa, skopiuj podany adres do paska adresu przeglądarki internetowej:<br />
<nobr><a href="<?php echo site_url('/auth/reset-password/'.$user_id.'/'.$new_pass_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/reset-password/'.$user_id.'/'.$new_pass_key); ?></a></nobr><br />
<br />
<br />
Ta wiadomość została wysłana, ponieważ wykorzystano Twój adres e-mail powiązany z serwisem <a href="<?php echo site_url(''); ?>" style="color: #3366cc;"><?php echo $site_name; ?></a>. Ta wiadomośc została wysłana w wyniku procedury zmiany hasła do systemu. Jeśli ten użytkownik nie żądał zmiany hasła, zignoruj tę wiadomość, hasło pozostanie niezmienione.<br />
<br />
<br />
Dziękujemy,<br />
Zespół <?php echo $site_name; ?>
</td>
</tr>
</table>
</div>
</body>
</html>