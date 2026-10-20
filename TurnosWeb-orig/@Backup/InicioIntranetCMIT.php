<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
<html>

<head>
<?php  include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0"  marginheight="0"  onLoad="document.forms['Formulario']['TxtUsuario'].focus()">
<? include ("Codigo/BannerSinMenuHV.php");?>
<form name="Formulario" action="Codigo/Verifica_LoginCMIT.php" method="post">

<!-- Bienvenida -->	
<table width="100%" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr> <td  height="20"  ></td> </tr>
<tr><td height="20" align="center" valign="middle"  class="TituloLoguin1" > &nbsp;Bienvenido al Sistema de Administración de Turnos CMIT</td></tr>
<tr> <td  height="20"  ></td> </tr>
<tr><td height="20" align="center" valign="middle"  class="TituloLoguin2" > Por favor ingrese sus datos de acceso</td></tr>
<tr> <td  height="3"  ></td> </tr>
</table>


<!-- Campos -->			
<table width="270"  border="0" cellspacing="0" cellpadding="0" class="TablaLogin" >
<tr><td width="50" height="20"  ></td> <td width="220"></td> </tr>
<tr><td height="18"  align="right"  >Usuario:</td><td valign="top" > &nbsp;<input name="TxtUsuario" type="text" class="TextBoxLogin" maxlength="100" style="width:180px" onKeyDown="enterxtab(event)" ></td></tr>
<tr> <td  height="5"></td> </tr> 
<tr> <td height="18"  align="right"  >Clave:</td><td valign="top" > &nbsp;<input name="TxtPassword" type="password" maxlength="8"  style="width:180px"  class="TextBoxLogin"></td></tr>
<tr> <td  height="10"></td> </tr> 
<tr><td align="center" valign="middle"  colspan="2"><input name="CmdAceptar" type="submit" class="boton3"  value="INGRESAR" ></td></tr>
<tr> <td  height="5"  ></td> </tr>
</table>



<!-- Mensaje error -->
<table width="500" border="0" cellspacing="0" cellpadding="0" >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE'] ; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC'] ; ?> </td> </tr>
<tr><td  height="130"  ></td> </tr>
</table>  
<!-- fin Mensaje error -->
<? //limpia las var de session
$_SESSION['TxtUsuario'] = "";
$_SESSION['TxtPassword'] = "";
?>			

</Form>
<? include ("Codigo/FooterSinUsuario.php");?>
</body>
</html>


