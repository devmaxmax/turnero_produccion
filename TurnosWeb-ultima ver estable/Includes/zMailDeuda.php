<? 

//datos
$asunto='PROXIMO BLOQUEO DE USUARIO POR FALTA DE PAGO';$adjunto='';$cuerpo='';
//cuerpo
include("../Includes/zMailCuerpoI.php");
$cuerpo .='<BR>Estimado Cliente,<BR><BR>';
$cuerpo .='Le informamos que su usuario en breve sera bloqueado autom&aacute;ticamente debido a que registra facturas vencidas impagas, le rogamos regularizar su situacion a la brevedad posible.<BR><BR>';
$cuerpo .='<STRONG>--Si ya hubiera realizado el pago le agradeceremos nos envie la informacion del mismo.--</STRONG><BR><BR>';
$cuerpo .='Cualquier consulta puede contactarse con nuestro departamento de Administracion de lunes a viernes de 8 a 16hs al Tel: 0299 4474371 int 5 o a nuestro email facturacion@cmit.com.ar.<BR><BR><BR>';
$cuerpo .='<STRONG>Informamos nuestro CBU para abonar sus facturas:</STRONG><BR><BR>';
$cuerpo .='Banco: Galicia S.A. <BR>';
$cuerpo .='Sucursal: 129 - Neuquen <BR>';
$cuerpo .='Alias: SALUDOCUPACIONALSRL <BR>';
$cuerpo .='CUIT: 30-70997141-3<BR>';
$cuerpo .='Cuenta Corriente: $ 11220-2 129-4<BR>';
$cuerpo .='CBU: 00701293-20000011220248<BR><BR><BR><BR>';
$cuerpo .='Saluda a Ud. muy atte,<BR><BR>';
$cuerpo .='EQUIPO DE COBRANZA<BR>';
$cuerpo .='SALUD OCUPACIONAL SRL<BR>';
$cuerpo .='Juan B Justo 825 1p of1<BR>';
$cuerpo .='Tel: 0299 - 4474371 int 5<BR>';
$cuerpo .='Neuquen Capital';
include("../Includes/zMailCuerpoF.php");
//enviar mail
$resultenvio=EnviarMailUsuario($mails,$asunto,$cuerpo,$adjunto,$conn);

	
?>