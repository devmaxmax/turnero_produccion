<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
$id=mysql_real_escape_string(decrypt($_GET['id'],'elcrucedelosandes2016'));	
$query="SELECT Usuario From usuarios where Usuario<>'ngrunmann@gmail.com' and Usuario='".$id."'";$rs=mysql_query($query,$conn);
while($row=mysql_fetch_array($rs)){	$_SESSION['TxtUsuario'] = $row['Usuario'];}mysql_free_result($rs);
mysql_close($conn);


GLO_InitHTML($_SESSION["NivelArbol"],'TxtClave','BannerConMenuHVCMIT','zCambioClave',0,0,0,0); 
GLO_tituloypath(0,500,'../Clientes.php','CAMBIAR CLAVE DE ACCESO','linksalir');
?>

<table width="500" border="0"  cellspacing="0" class="Tabla" >
<tr> <td width="110" height="5"  ></td> <td width="390"></td> </tr>
<tr><td height="18"  align="right"  >&nbsp;Usuario:</td><td valign="top" > &nbsp; <input name="TxtUsuario" type="text" class="TextBoxRO"   style="width:160px" value="<? echo $_SESSION['TxtUsuario']; ?>"> </td></tr>
</table>

<?
GLO_botonesform(500,0,2);
GLO_mensajeerror();
GLO_cierratablaform();
include ("../Codigo/FooterConUsuario.php");
?>