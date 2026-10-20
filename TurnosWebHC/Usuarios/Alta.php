<? include("../Codigo/SeguridadCMIT.php") ;include("../Codigo/Config.php") ; include("../Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="../";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);


function ComboTablaPerfilRFX($tabla,$campo,$orden,$arbol,$where,$conn){
$query="SELECT * FROM $tabla where Id<>0 and Id<>1 and Id<>5  $where Order by $orden";$rs=mysql_query($query,$conn);
$combo="";
while($row=mysql_fetch_array($rs)){ 
  if( $row['Id'] == $_SESSION[$campo]) {$combo .= " <option value='".$row['Id']."' selected='"."selected"."'>".$row['Nombre']."</option>\n";
  }else{ $combo .= " <option value='".$row['Id']."'>".$row['Nombre']."</option>\n";   }}
echo $combo;mysql_free_result($rs);
}

GLO_InitHTML($_SESSION["NivelArbol"],'TxtNombre','BannerConMenuHVCMIT','zAlta',0,0,0,0); 
GLO_tituloypath(0,500,'../Usuarios.php','USUARIO','linksalir'); 
?>

<table width="500" border="0"   cellspacing="0" class="Tabla" >
<tr> <td width="110" height="5"  ></td> <td width="390"></td> </tr>
<tr><td height="18"  align="right"  >Nombre:</td><td valign="top" > &nbsp; <input name="TxtNombre" type="text"  class="TextBox" style="width:300px" maxlength="30"  value="<? echo $_SESSION['TxtNombre']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr><td height="18"  align="right"  >Apellido:</td><td  valign="top" > &nbsp; <input name="TxtApellido" type="text"  class="TextBox" style="width:300px" maxlength="30"  value="<? echo $_SESSION['TxtApellido']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr><td height="18"  align="right"  >&nbsp;Perfil:</td><td  valign="top" > &nbsp; <select name="CbPerfil"  class="campos" id="CbPerfil" style="width:160px"><option value=""></option> <? ComboTablaPerfilRFX("perfiles","CbPerfil","Nombre","","",$conn); ?> </select> <label class="MuestraCampoRequerido"> * </label></td></tr>
</table>



<table width="500" border="0"   cellspacing="0" class="Tabla TMT"  >
<tr> <td width="110" height="5"  ></td> <td width="390"></td> <td colspan="2"></td></tr>	
<tr><td height="18"  align="right"  >&nbsp;Usuario:</td><td  valign="top" > &nbsp;
<input name="TxtUsuario" type="text"  class="TextBox" style="width:300px" maxlength="100" value="<? echo $_SESSION['TxtUsuario']; ?>" onKeyUp="this.value=this.value.toLowerCase()"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr><td height="18"  align="right"  >&nbsp;Clave:</td><td  valign="top" > &nbsp; <input name="TxtClave" type="password"  class="TextBox"  style="width:160px" maxlength="8" value="<? echo $_SESSION['TxtClave']; ?>"> <label class="MuestraCampoRequerido"> * </label></td></tr>
<tr><td height="18"  align="right"  >&nbsp;Confirmar Clave:</td><td  valign="top" > &nbsp; <input name="TxtConfirmar" type="password"  class="TextBox"  style="width:160px" maxlength="8" value="<? echo $_SESSION['TxtConfirmar']; ?>"> <label class="MuestraCampoRequerido"> * </label></td></tr>
</table>




<? 
GLO_botonesform(500,0,2);
GLO_mensajeerror();
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(500,0);
echo 'La <font class="comentario3">Clave</font> debe tener 8 caracteres y contener letras y n&uacute;meros';
GLO_endcomment();


include ("../Codigo/FooterConUsuario.php");
?>