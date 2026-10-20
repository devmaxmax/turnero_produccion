<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php"); include("../Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="../";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}
//$_GET trae id usuario
GLO_ValidaGETTUR($_GET['id'],0,0,'InicioCMIT');//valida que no sea vacio



$_SESSION['TxtClave']="";$_SESSION['TxtConfirmar']="";
$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
$id=decrypt($_GET['id'],'elcrucedelosandes2016');
$query="SELECT Usuario From usuarios where Usuario<>'ngrunmann@gmail.com' and Usuario='".$id."'";$rs=mysql_query($query,$conn);
while($row=mysql_fetch_array($rs)){	$_SESSION['TxtUsuario'] = $row['Usuario'];}mysql_free_result($rs);
mysql_close($conn);

GLO_InitHTML($_SESSION["NivelArbol"],'TxtClave','BannerConMenuHVCMIT','zCambioClave',0,0,0,0); 
GLO_tituloypath(0,500,'../Usuarios.php','CLAVE DE ACCESO','linksalir'); 
?>



<table width="500" border="0"  cellspacing="0" class="Tabla" >
<tr> <td width="110" height="5"  ></td> <td width="390"></td> </tr>
<tr><td height="18"  align="right"  >&nbsp;Usuario:</td><td valign="top" > &nbsp; <input name="TxtUsuario" type="text" readonly="true" class="TextBoxRO"   style="width:300px" value="<? echo $_SESSION['TxtUsuario']; ?>"> </td></tr>
<tr><td height="18"  align="right"  >&nbsp;Clave:</td><td valign="top" > &nbsp; <input name="TxtClave" type="password"  class="TextBox"  style="width:300px" maxlength="8" value="<? echo $_SESSION['TxtClave']; ?>"> <label class="MuestraCampoRequerido"> * </label></td></tr>
<tr><td height="18"  align="right"  >&nbsp;Confirmar Clave:</td><td valign="top" > &nbsp; <input name="TxtConfirmar" type="password"  class="TextBox"  style="width:300px" maxlength="8" value="<? echo $_SESSION['TxtConfirmar']; ?>"> <label class="MuestraCampoRequerido"> * </label></td></tr>


<? 
GLO_botonesform(500,0,2);
GLO_mensajeerror();
GLO_cierratablaform();

GLO_initcomment(500,0);
echo 'La <font class="comentario3">Clave</font> debe tener 8 caracteres y contener letras y n&uacute;meros';
GLO_endcomment();


include ("../Codigo/FooterConUsuario.php");
?>