<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php");  $_SESSION["NivelArbol"]="";


//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}
 
//Consulta
$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
$query="SELECT * From usuarios where Usuario='".mysql_real_escape_string($_SESSION["login"])."'";
$rs=mysql_query($query,$conn);
while($row=mysql_fetch_array($rs)){$_SESSION[TxtUsuario] = $row['Usuario'];}
mysql_free_result($rs);mysql_close($conn);
$_SESSION[TxtClaveActual]="";$_SESSION[TxtClave]="";$_SESSION[TxtConfirmar]="";?>




<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">   
<html>
<head>
<? include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css" >
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['TxtClaveActual'].focus()">
<? include ("Codigo/BannerConMenuHVCMIT.php");?>

<form name="Formulario" action="IntranetCMIT/zCambioClave.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"  >
<tr> <td height="8"></td></tr>
<tr > <td align="right" valign="top" > </td></tr>					
<tr><td align="center">
<table width="750" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >CLAVE DE ACCESO</td> </tr>
</table> 
<table> 
<tr><td  align="center"  valign="top">


<table width="450" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr> <td width="110" height="5"  ></td> <td width="340"></td></tr>
<tr><td height="18"  align="right"  >&nbsp;Usuario:</td><td valign="top" > &nbsp; <input name="TxtApellido" type="text" class="TextBoxRO"    style="width:250px" value="<? echo $_SESSION[TxtUsuario]; ?>"> </td></tr>
<tr> <td height="3"  ></td></tr>	
<tr><td height="18"  align="right"  >&nbsp;Clave Actual:</td><td valign="top" > &nbsp; <input name="TxtClaveActual" type="password"  class="TextBox"  maxlength="8" tabindex="1" style="width:160px" value="<? echo $_SESSION[TxtActual]; ?>" onKeyDown="enterxtab(event)"> <label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >&nbsp;Clave Nueva:</td><td valign="top" > &nbsp; <input name="TxtClave" type="password"  class="TextBox"  maxlength="8" value="<? echo $_SESSION[TxtClave]; ?>" tabindex="2" style="width:160px"onKeyDown="enterxtab(event)"> <label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >&nbsp;Confirmar Clave:</td><td  valign="top" > &nbsp; <input name="TxtConfirmar" type="password"  class="TextBox"  maxlength="8" value="<? echo $_SESSION[TxtConfirmar]; ?>" tabindex="3" style="width:160px"> <label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
</table>


<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	   

<table width="450" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr> <td height="3"></td></tr>
<tr> <td height="19" align="center" valign="middle" > <input name="CmdAceptar" type="submit" class="boton"  value="Guardar" tabindex="4" > &nbsp; <input name="CmdCancelar" type="submit" class="boton"  value="Cerrar"  tabindex="5"> </td></tr>
<tr> <td height="5"></td></tr>
</table>


</td></tr>

<!--  Mensaje error-->
<tr> <td  align="center"  valign="top"> 			  
<table width="500" border="0"  cellpadding="0" cellspacing="0"  >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table></td>
</tr>	           
<? //limpia las var de session
$_SESSION[TxtNumero] = "";
$_SESSION[TxtNombre] ="";
$_SESSION[TxtApellido] = "";
$_SESSION[TxtClaveActual] = "";
$_SESSION[TxtClave] = "";
$_SESSION[TxtConfirmar] = "";
?>			
</table>    
</td>
</tr>
</table>
</Form>	
<!-- Comentario-->
<table  width="350" border="0" cellspacing="0" cellpadding="0"  >
<tr><td class="comentario1">
La <font class="comentario3">Clave</font> debe tener 8 caracteres y contener letras y números<br>
</td></tr>
</table>
<!-- fin Comentario-->

<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>





