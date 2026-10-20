<? include("Codigo/Config.php");

	
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<? include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['TxtUsuario'].focus()">
<? include ("Codigo/BannerSinMenuHV.php");?>

<form name="Formulario" action="Intranet/zLoginAyuda.php" method="post" >
<table width="100%" border="0"  cellpadding="0" cellspacing="0" >
<tr> <td height="5"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="750" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >RECUPERAR CONTRASEÑA</td></tr></table> 

<table width="450" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr><td width="100" height="5"  ></td> <td width="350"></td> </tr>
<tr><td height="18"  align="right"  >EMail:</td><td  valign="top" > &nbsp; <input name="TxtUsuario" type="text"  class="TextBox" style="width:250px" maxlength="100"  value="<? echo $_SESSION[TxtUsuario]; ?>"  onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
</table>  
      
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	                    

<table width="450" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr> <td height="3"></td></tr>
<tr> <td height="19"  align="center" valign="middle" > <input name="CmdAceptar" type="submit" class="boton"  value="Aceptar" > &nbsp; &nbsp; <input name="CmdCancelar" type="submit" class="boton"  value="Cancelar"  > </td></tr>
<tr> <td height="3"></td></tr>					
</table>


<!--  Mensaje error-->
<table width="450" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table>


<!-- Comentario-->
<table  width="450" border="0" cellspacing="0" cellpadding="0"  >
<tr> <td height="15"></td></tr>
<tr><td class="comentario1">
1. Introduzca la dirección de <font class="comentario3">EMail</font> que utiliza para iniciar sesión<br>
2. Seleccione el botón <font class="comentario2">Aceptar</font><br>
3. Recibirá en esa dirección una nueva clave de ingreso al sistema
</td></tr>
</table>
<!-- fin Comentario-->
                 
</td></tr>    	
</table>


</Form>	
<? //limpia las var de session
$_SESSION['TxtUsuario']='';
?>			

<? include ("Codigo/FooterSinUsuario.php");?>
</body>
</html>





