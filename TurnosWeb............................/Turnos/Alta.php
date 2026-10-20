<? include("../Codigo/Seguridad.php");include("../Codigo/Funciones.php");include("../Codigo/Config.php");    $_SESSION["NivelArbol"]="../";
//$_GET trae dia y hora del turno
//GLO_ValidaGETTUR($_GET['Id'],0,0,'Inicio');//valida que no sea vacio
GLO_ValidaGETTUR($_SESSION["GLO_FechaTurno"],0,0,'Inicio');//valida que no sea vacio

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

//$_SESSION['TxtVarGet'] = decrypt($_GET['Id'],'elcrucedelosandes2016');//guarda para volver si no completa requeridos
//list($f,$h,$a)=explode("|",mysql_real_escape_string(decrypt($_GET['Id'],'elcrucedelosandes2016')));
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
<? GLO_tituloypath(0,1120,'../Inicio.php','ALTA DE TURNO','linksalir'); ?>


<table width="750" border="0" cellspacing="0" class="Tabla">
<tr>
  <td width="250" height="3"></td>
  <td width="500"></td>
</tr>
<tr>
  <td height="18"  align="right">Turno:</td>
  <td valign="top" ><input  name="TxtFecha" type="text"  readonly="true"  class="TextBoxRO" style="width:110px"  value="<? echo $_SESSION['TxtFecha'];?>" > 
    <input  name="TxtHora" type="text"  readonly="true"  class="TextBoxRO" style="width:90px"  value="<? echo $_SESSION['TxtHora'];?>" >&nbsp; 
    <label class="comentario3"  style="font-weight:normal;"><? echo $_SESSION['TxtDiasFaltantes']; ?></label>
  </td>
</tr>
<? GLO_Hidden('TxtIdAgenda',0);GLO_Hidden('TxtIdUsuario',0);GLO_Hidden('TxtVarGet',0);GLO_Hidden('TxtNumero',0); ?>
<tr>
  <td height="18"  align="right">Raz&oacute;n Social:</td>
  <td  valign="top">
    <select name="CbIdRSF" style="width:450px" class="campos" tabindex="1"><? ComboLocalRSF("CbIdRSF",$conn); ?></select><label class="MuestraCampoRequerido"> * </label>
  </td>
</tr>
<tr>
  <td height="18" align="right">Apellido y Nombre del Paciente:</td>
  <td  valign="top">
    <input name="TxtPaciente"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtPaciente'];?>"><label class="MuestraCampoRequerido"> * </label>
  </td>
</tr>
<tr>
  <td width="250" height="3"></td>
  <td width="500"></td>
</tr>
</table>

	
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5"></td>
  </tr>
</table>	

<table width="750" border="0"   cellspacing="0"  class="Tabla">
<tr>
  <td height="19" align="center" >
    <input name="CmdAceptar" type="submit" class="boton"  value="Seguir" onClick="return confirm('Desea grabar los datos?');">
  </td>
</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="10"></td>
  </tr>
</table>  

<? 
GLO_Hidden('GLO_FechaTurno',0);
GLO_mensajeerror();
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(1120,0);
echo 'Para solicitar el <font class="comentario3">Turno</font> seleccione el bot&oacute;n <font class="comentario2">Seguir</font>';
GLO_endcomment();


//Inicio Banner RW

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

$query="SELECT * From banners WHERE id = 2";
$banner=mysql_query($query,$conn);
$rowe=mysql_fetch_array($banner);

if($rowe['Activado'] == 'SI') {
  echo '<div class="banner-rw"><h3>'.$rowe['Subtitulo'].'</h3><p>'.$rowe['Texto'].'</p></div><br>';
}

mysql_close($conn);

//Final Banner RW

include ("../Codigo/FooterConUsuario.php");
?>