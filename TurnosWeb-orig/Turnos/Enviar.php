<? include("../Codigo/Seguridad.php") ;include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Config.php"); 
//$_GET trae id turno
GLO_ValidaGETTUR($_GET['id'],0,0,'Inicio');//valida que no sea vacio

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

//valida usuario turno=usuario logueado
$id=intval(decrypt($_GET['id'],'elcrucedelosandes2016'));
$usuario=mysql_real_escape_string($_SESSION["login"]);//usuario logueado
GLO_ValidaUSERTUR($usuario,$id,'Inicio',$conn);

$_SESSION['TxtNumero']=$id;

GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHV','zEnviar',0,0,0,0);
GLO_tituloypath(0,500,'','',''); 
?>

<table width="500" border="0" cellspacing="0" cellpadding="0" class="tablanotif" style="border:1px #e1e1e1 solid; padding:14px;border-radius:4px;color: #484848;">
<tr> <td height="20" align="center" class="MuestraError" style="font-size:14px"><? echo $_SESSION['GLO_msgE'];?></td></tr>
<tr> <td height="10"  ></td></tr>
<tr> <td height="20" align="center" class="MuestraConf"><? echo $_SESSION['GLO_msgC'];?></td></tr>
<tr> <td height="10"  ></td></tr>
<tr> <td height="20" align="center" class="MuestraConf">Haciendo click en Modificar vuelve al Turno registrado</td></tr>
<tr> <td height="20"  ></td></tr>
<tr><td height="18"  align="center">
<input name="CmdAceptar" type="submit" class="boton"  tabindex="20"  value="Modificar" onClick="document.Formulario.target='_self'">
&nbsp;&nbsp;<input name="CmdSeguir" type="button" class="boton"  tabindex="20"  value="Cerrar" onClick="window.location.href='../Inicio.php';"></td> </tr>
</table> 

<?
GLO_Hidden('TxtNumero',0);
GLO_cierratablaform();
include ("../Codigo/FooterConUsuario.php");
?>
