<? include("../Codigo/SeguridadCMIT.php") ;include("../Codigo/Config.php") ;include("../Codigo/Funciones.php") ; $_SESSION["NivelArbol"]="../";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}
//$_GET trae id usuario
GLO_ValidaGETTUR($_GET['id'],0,0,'InicioCMIT');//valida que no sea vacio


$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

$id=decrypt($_GET['id'],'elcrucedelosandes2016');
$query="SELECT * From usuarios where Usuario='".$id."'";$rs=mysql_query($query,$conn);
while($row=mysql_fetch_array($rs)){$_SESSION['TxtUsuario'] = $row['Usuario'];$_SESSION['CbPerfil'] = $row['IdPerfil'];}mysql_free_result($rs);




function ComboTablaPerfilRFX($tabla,$campo,$orden,$arbol,$where,$conn){
$query="SELECT * FROM $tabla where Id<>0 and Id<>1 and Id<>5  $where Order by $orden";$rs=mysql_query($query,$conn);
$combo="";
while($row=mysql_fetch_array($rs)){ 
  if( $row['Id'] == $_SESSION[$campo]) {$combo .= " <option value='".$row['Id']."' selected='"."selected"."'>".$row['Nombre']."</option>\n";
  }else{ $combo .= " <option value='".$row['Id']."'>".$row['Nombre']."</option>\n";   }}
echo $combo;mysql_free_result($rs);
}




GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHVCMIT','zModificar',0,0,0,0); 
GLO_tituloypath(0,500,'../Usuarios.php','USUARIO','linksalir'); 



?>

<table width="500" border="0"  cellspacing="0" class="Tabla" >
<tr> <td width="110" height="5"  ></td> <td width="390"></td> </tr>
<tr><td height="18"  align="right"  >&nbsp;Usuario:</td><td  valign="top" > &nbsp; <input name="TxtUsuario" type="text"  readonly="true" class="TextBoxRO"  style="width:300px"  value="<? echo $_SESSION['TxtUsuario']; ?>">  </td></tr>
<tr><td height="21"  align="right"  >&nbsp;Perfil:</td><td  valign="top" > &nbsp; <select name="CbPerfil"  class="campos" id="CbPerfil" style="width:300px"><option value=""></option> <? ComboTablaPerfilRFX("perfiles","CbPerfil","Nombre","","",$conn); ?> </select> <label class="MuestraCampoRequerido"> * </label><input  name="TxtModificar"  type="hidden"   value="<? echo $_SESSION['TxtModificar']; ?>"></td></tr>
</table>



<? 
GLO_botonesform(500,0,2);
GLO_mensajeerror();
mysql_close($conn);
GLO_cierratablaform();
include ("../Codigo/FooterConUsuario.php");
?>