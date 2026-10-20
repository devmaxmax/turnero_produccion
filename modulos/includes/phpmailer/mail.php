<?php
if (!defined('IN_SITE')){
	die('Hacking attempt');
}

require("class.phpmailer.php");
$mail = new PHPMailer();

$mail->PluginDir = "";
$mail->Mailer = "mail";
$mail->IsSMTP();
$mail->SMTPAuth = true;

$mail->Host = "mail.vallecom.net";
$mail->Username = "mercado@vallecom.net";
$mail->Password = "12345";

$mail->IsHTML(true);
$mail->Timeout=30;

?>

