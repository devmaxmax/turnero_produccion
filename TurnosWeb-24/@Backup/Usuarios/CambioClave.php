<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php"); include("../Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="../";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}



$_SESSION[TxtClave]="";$_SESSION[TxtConfirmar]="";
$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
$id=decrypt($_GET['id'],'elcrucedelosandes2016');
$query="SELECT Usuario From usuarios where Usuario<>'ngrunmann@gmail.com' and Usuario='".$id."'";$rs=mysql_query($query,$conn);
while($row=mysql_fetch_array($rs)){	$_SESSION[TxtUsuario] = $row['Usuario'];}mysql_free_result($rs);
mysql_close($conn);
?>





<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">   
<html>
<head>
<? include ("../Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="../CSS/Estilo.css" >
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['TxtClave'].focus()">
<? include ("../Codigo/BannerConMenuHVCMIT.php");?>

<form name="Formulario" action="zCambioClave.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"  >
<tr> <td height="8"></td></tr>
<tr > <td align="right" valign="top" > </td></tr>						
<tr><td align="center">
<table width="750" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >CLAVE DE ACCESO</td> </tr>
</table> 
<table> 
<tr><td  align="center"  valign="top">
<table width="500" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr> <td width="110" height="5"  ></td> <td width="390"></td> </tr>
<tr><td height="18"  align="right"  >&nbsp;Usuario:</td><td valign="top" > &nbsp; <input name="TxtUsuario" type="text" class="TextBoxRO"   style="width:300px" value="<? echo $_SESSION[TxtUsuario]; ?>"> </td></tr>
<tr> <td  height="5"  ></td></tr>	
<tr><td height="18"  align="right"  >&nbsp;Clave:</td><td valign="top" > &nbsp; <input name="TxtClave" type="password"  class="TextBox"  style="width:160px" maxlength="8" value="<? echo $_SESSION[TxtClave]; ?>"> <label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="5"></td></tr>
<tr><td height="18"  align="right"  >&nbsp;Confirmar Clave:</td><td valign="top" > &nbsp; <input name="TxtConfirmar" type="password"  class="TextBox"  style="width:160px" maxlength="8" value="<? echo $_SESSION[TxtConfirmar]; ?>"> <label class="MuestraCampoRequerido"> * </label></td></tr>

</table>
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>

<table width="500" border="0"  cellpadding="0" cellspacing="0"  class="Tabla"  >
<tr> <td height="5"></td></tr>
<tr> <td height="19" align="center" valign="middle" > <input name="CmdAceptar" type="submit" class="boton"  value="Guardar" onClick="return confirm('Desea grabar los datos?');"> &nbsp; <input name="CmdCancelar" type="submit" class="boton"  value="Cerrar"  > </td></tr>
<tr> <td height="5"></td></tr>
</table>
</td></tr>

<!--  Mensaje error-->
<tr> <td  align="center"  valign="top"> 			  
<table width="500" border="0"  cellpadding="0" cellspacing="0"  >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table>
</td>
</tr>	           
<? //limpia las var de session
$_SESSION[TxtUsuario] = "";
$_SESSION[TxtClave] = "";
$_SESSION[TxtConfirmar] = "";
?>			
</table>    
</td>
</tr>
</table>
</Form>	
<!-- Comentario-->
<table  width="750" border="0" cellspacing="0" cellpadding="0"  >
<tr><td class="comentario1">
La <font class="comentario3">Clave</font> debe tener 8 caracteres y contener letras y números<br>
</td></tr>
</table>
<!-- fin Comentario-->

<? include ("../Codigo/FooterConUsuario.php");?>
</body>
</html>





