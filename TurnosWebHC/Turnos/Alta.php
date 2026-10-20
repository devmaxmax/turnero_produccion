<? include("../Codigo/Seguridad.php");include("../Codigo/Funciones.php");include("../Codigo/Config.php");    $_SESSION["NivelArbol"]="../";
//$_GET trae dia y hora del turno
//GLO_ValidaGETTUR($_GET['Id'],0,0,'Inicio');//valida que no sea vacio
GLO_ValidaGETTUR($_SESSION["GLO_FechaTurno"],0,0,'Inicio');//valida que no sea vacio

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

$_SESSION['TxtVarGet'] = $_SESSION["GLO_FechaTurno"];//guarda para volver si no completa requeridos
list($f,$h,$a)=explode("|",mysql_real_escape_string($_SESSION["GLO_FechaTurno"]));

$_SESSION['TxtFecha']=$f;$_SESSION['TxtHora']=$h;$_SESSION['TxtIdAgenda']=$a;
$_SESSION['TxtIdUsuario']=mysql_real_escape_string($_SESSION["login"]);
//dias transcurridos
$dias=dias_transcurridos(date("d-m-Y"),$f);
if($dias>1){$_SESSION['TxtDiasFaltantes']='(dentro de '.$dias.' dias)';}
if($dias==1){$_SESSION['TxtDiasFaltantes']='(dentro de '.$dias.' dia)';}
if($dias==0){$_SESSION['TxtDiasFaltantes']='(hoy)';}
//inicializo razon social
if(empty($_SESSION['CbIdRSF'])){$_SESSION['CbIdRSF']=0;}




function ComboLocalRSF($campo,$conn){
$idcombo=intval($_SESSION[$campo]);
$usuario=mysql_real_escape_string($_SESSION["login"]);
//busco RSF de usuarios y usuariosclientes
$query1="SELECT 0 as Id,u.RSF FROM usuarios u where u.Usuario='$usuario'";
$query2="SELECT uc.Id,uc.RSF FROM usuariosclientes uc where uc.Id<>0 and uc.IdUsuario='$usuario'";
$query="Select uu.* From ($query1 UNION ALL $query2)uu Order by uu.RSF";$rs=mysql_query($query,$conn);
$combo="";
while($row=mysql_fetch_array($rs)){ 
  if( $row['Id'] == $_SESSION[$campo]) {$combo .= " <option value='".$row['Id']."' selected='"."selected"."'>".$row['RSF']."</option>\n";
  }else{ $combo .= " <option value='".$row['Id']."'>".$row['RSF']."</option>\n";   }
}mysql_free_result($rs);
echo $combo;
}

?> 
<? include ("../Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="../CSS/Estilo.css" >
<? GLO_bodyform('',0,0); ?>
<? include ("../Codigo/BannerConMenuHV.php");?>
<? GLO_formform('Formulario','zAlta.php',0,0,0); ?>
<? GLO_tituloypath(0,700,'../Inicio.php','ALTA DE TURNO','linksalir'); ?>


<table width="700" border="0"  cellspacing="0" class="Tabla" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  >Turno:</td><td  valign="top" >&nbsp; <input  name="TxtFecha" type="text"  readonly="true"  class="TextBoxRO" style="width:70px"  value="<? echo $_SESSION['TxtFecha'];?>" >  <input  name="TxtHora" type="text"  readonly="true"  class="TextBoxRO" style="width:50px"  value="<? echo $_SESSION['TxtHora'];?>" >&nbsp; <label class="comentario3"  style="font-weight:normal;"><? echo $_SESSION['TxtDiasFaltantes']; ?></label></td></tr>
<? GLO_Hidden('TxtIdAgenda',0);GLO_Hidden('TxtIdUsuario',0);GLO_Hidden('TxtVarGet',0);GLO_Hidden('TxtNumero',0); ?>
</table>

<? 
include ("../Includes/zCamposTurno2.php");
?>

<table width="700" border="0"  cellspacing="0"  class="Tabla TMT">
<tr> <td height="3"></td></tr>
<tr> <td height="19" align="center" >
<?
$click="'Por favor aguarde. Grabara los cambios y enviara mail a su usuario'";
echo '<input name="CmdAceptar" type="submit" class="boton" tabindex="2" value="Guardar" onClick="return confirm('.$click.');">  &nbsp;';
?>
 </td></tr>
</table>


<? 
GLO_Hidden('GLO_FechaTurno',0);
GLO_mensajeerror();
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(700,0);
echo 'Para agregar una <font class="comentario2">Raz&oacute;n Social</font> a la lista desplegable, elija la opci&oacute;n del men&uacute; <font class="comentario3">Mi Cuenta</font>.<br>';
GLO_endcomment();
include ("../Codigo/FooterConUsuario.php");
?>