<?php
if (!defined('IN_SITE')){
  die('Hacking attempt');
}

if( $_POST['mode'] == "Enviar" AND $_POST['captcha'] == "gPHd98"  )
{


   if ( $_ERROR == "" )
   {
      $asunto = "Mensaje desde la web";
      $headers  = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
      $headers .= "From:".trim($_POST['email'])."\r\n";
      $mensaje  ='
      <html>
      <head>
        <title>Mensaje desde la web</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

      </head>
<body>
<table width="650" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
          <td height="35" colspan="2" align="center" valign="middle" style="background:#2459a6; color:#FFFFFF; font:15px arial; text-transform:uppercase"><b>Mensaje desde el sitio web</b></td>
</tr>

<tr>
  <td width="150" align="left"  style="background:#eeeeee; color:#333333; font:13px arial; padding:10px; border-bottom:1px solid #ffffff; border-right:1px solid #ffffff"><b>Nombre y Apellido:</b></td>
  <td width="494" align="left" style="background:#f5f5f5; color:#011019; font:13px arial; padding:10px; border-bottom:1px solid #ffffff">'.$_POST['nombre'].'&nbsp;</td>
</tr>

<tr>
          <td align="left"  style="background:#eeeeee; color:#333333; font:13px arial; padding:10px; border-bottom:1px solid #ffffff; border-right:1px solid #ffffff"><b>Teléfono:</b></td>
          <td align="left" style="background:#f5f5f5; color:#011019; font:13px arial; padding:10px; border-bottom:1px solid #ffffff">'.$_POST['movil'].'&nbsp;</td>
  </tr>   
          <td align="left"  style="background:#eeeeee; color:#333333; font:13px arial; padding:10px; border-bottom:1px solid #ffffff; border-right:1px solid #ffffff"><b>E-mail:</b></td>
          <td align="left" style="background:#f5f5f5; color:#011019; font:13px arial; padding:10px; border-bottom:1px solid #ffffff">'.$_POST['email'].'&nbsp;</td>
</tr>
<tr>
          <td align="left" style="background:#eeeeee; color:#333333; font:13px arial; padding:10px; border-bottom:1px solid #ffffff; border-right:1px solid #ffffff"><b>Fecha y Hora:</b></td>
          <td align="left" style="background:#f5f5f5; color:#011019; font:13px arial; padding:10px; border-bottom:1px solid #ffffff">'.date("d/m/y # h:i a").'</td>
</tr>
<tr>
  <td align="left" style="background:#eeeeee; color:#333333; font:13px arial; padding:10px; border-bottom:1px solid #ffffff; border-right:1px solid #ffffff"><b>CUIT y Consulta:</b></td>
  <td align="left" style="background:#f5f5f5; color:#011019; font:13px arial; padding:10px; border-bottom:1px solid #ffffff">'.nl2br($_POST['consulta']).'</td>
</tr>

</table>
</body>
      </html>'; 

  if( mail("info@cmit.com.ar", $asunto, utf8_decode($mensaje), $headers) )
      {
       mysql_query("INSERT INTO emails (nombreyapellido, telefono, email, fecha) VALUES ('".$_POST['nombre']."', '".$_POST['movil']."', '".$_POST['email']."', CURDATE())");   
      @header("Location: index?/contacto/enviado");
      }
   }
}



include('modulos/vista/layout0.php');

?>