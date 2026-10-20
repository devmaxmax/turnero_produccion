<? 

//datos
$asunto='PROXIMO BLOQUEO DE USUARIO POR FALTA DE PAGO';$adjunto='';$cuerpo='';
//cuerpo
$cuerpo .='<BODY><FONT FACE="arial"><SMALL>';
$cuerpo .='<BR>Estimado Cliente,<BR><BR>';
$cuerpo .='Le informamos que su usuario en breve será bloqueado automáticamente debido a que registra facturas vencidas impagas, le rogamos regularizar su situación a la brevedad posible.<BR><BR>';
$cuerpo .='<STRONG>--Si ya hubiera realizado el pago le agradeceremos nos envíe la información del mismo.--</STRONG><BR><BR>';
$cuerpo .='Cualquier consulta puede contactarse con nuestro departamento de Administración de lunes a viernes de 8 a 17hs al Tel: 0299 4473506  o a nuestro email facturacion@cmit.com.ar.<BR><BR><BR>';
$cuerpo .='<STRONG>Informamos nuestro CBU para abonar sus facturas:</STRONG><BR><BR>';
$cuerpo .='Santander Río - Neuquén<BR>';
$cuerpo .='Razon Social: Salud Ocupacional SRL<BR>';
$cuerpo .='CUIT: 30-70997141-3<BR>';
$cuerpo .='Nro.de Cta.: 720-000160/7<BR>';
$cuerpo .='CBU: 0720720620000000016072 <BR><BR><BR><BR>';
$cuerpo .='Saluda a Ud. muy atte,<BR><BR>';
$cuerpo .='EQUIPO DE COBRANZA<BR>';
$cuerpo .='SALUD OCUPACIONAL SRL<BR>';
$cuerpo .='Bouquet Roldan 65 1p of2<BR>';
$cuerpo .='Tel: 0299 - 4473506<BR>';
$cuerpo .='Neuquén Capital <BR>';
$cuerpo .='</SMALL></FONT></BODY>';	
//enviar mail
$resultenvio=EnviarMailUsuario($mails,$asunto,$cuerpo,$adjunto,$conn);

	
?>