<? include("../Codigo/SeguridadCMIT.php") ;include("../Codigo/Config.php") ;include("../Codigo/Funciones.php") ; $_SESSION["NivelArbol"]="../";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}


$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

$id=decrypt($_GET['id'],'elcrucedelosandes2016');
$query="SELECT * From usuarios where Usuario='".$id."'";$rs=mysql_query($query,$conn);
while($row=mysql_fetch_array($rs)){$_SESSION[TxtUsuario] = $row['Usuario'];$_SESSION[CbPerfil] = $row['IdPerfil'];}mysql_free_result($rs);




function ComboTablaPerfilRFX($tabla,$campo,$orden,$arbol,$where,$conn){
$query="SELECT * FROM $tabla where Id<>0 and Id<>1 and Id<>5  $where Order by $orden";$rs=mysql_query($query,$conn);
$combo="";
while($row=mysql_fetch_array($rs)){ 
  if( $row['Id'] == $_SESSION[$campo]) {$combo .= " <option value='".$row['Id']."' selected='"."selected"."'>".$row['Nombre']."</option>\n";
  }else{ $combo .= " <option value='".$row['Id']."'>".$row['Nombre']."</option>\n";   }}
echo $combo;mysql_free_result($rs);
}







?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">   
<html>
<head>
<? include ("../Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="../CSS/Estilo.css" >
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include ("../Codigo/BannerConMenuHVCMIT.php");?>

<form name="Formulario" action="zModificar.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"  >
<tr> <td height="8"></td></tr>
<tr > <td align="right" valign="top" > </td></tr>						
<tr><td align="center">
<table width="750" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >USUARIO</td> </tr>
</table> 
<table> 
<!-- Campos y botones -->
<tr><td  align="center"  valign="top">
<table width="500" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr> <td width="110" height="5"  ></td> <td width="390"></td> </tr>
<tr> <td height="5"></td></tr>
<tr><td height="18"  align="right"  >&nbsp;Usuario:</td><td  valign="top" > &nbsp; <input name="TxtUsuario" type="text"  class="TextBoxRO"  style="width:300px" readonly="true" value="<? echo $_SESSION[TxtUsuario]; ?>">  </td></tr>
<tr> <td height="3"></td></tr>
<tr><td height="21"  align="right"  >&nbsp;Perfil:</td><td  valign="top" > &nbsp; <select name="CbPerfil"  class="campos" id="CbPerfil" style="width:190px"><option value=""></option> <? ComboTablaPerfilRFX("perfiles","CbPerfil","Nombre","","",$conn); ?> </select> <label class="MuestraCampoRequerido"> * </label><input  name="TxtModificar"  type="hidden"   value="<? echo $_SESSION[TxtModificar]; ?>"></td></tr>
<tr> <td height="3"></td></tr>
</table>

<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>

<table width="500" border="0"  cellpadding="0" cellspacing="0" class="Tabla"  >
<tr> <td height="3"></td></tr>
<tr> <td height="19" align="center" valign="middle" > <input name="CmdAceptar" type="submit" class="boton"  value="Guardar" > &nbsp; <input name="CmdCancelar" type="submit" class="boton"  value="Cerrar"  > </td></tr>
<tr> <td height="5"></td></tr>
</table>

<!--  Mensaje error-->
<tr> <td  align="center"  valign="top"> 			  
<table width="500" border="0"  cellpadding="0" cellspacing="0"  >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table></td>
</tr>	           
<? mysql_close($conn);
$_SESSION[TxtUsuario] = "";
$_SESSION[CbPerfil] = "";
$_SESSION[TxtModificar] = "";

?>			
</table>    
</td>
</tr>
</table>

</Form>	
			
<? include ("../Codigo/FooterConUsuario.php");?>
</body>
</html>
