<? include("../Codigo/Seguridad.php") ;include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Config.php"); 
//$_GET trae id turno
GLO_ValidaGETTUR($_GET['id'],0,0,'Inicio');//valida que no sea vacio

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

//valida usuario turno=usuario logueado
$id=intval(decrypt($_GET['id'],'elcrucedelosandes2016'));
$usuario=mysql_real_escape_string($_SESSION["login"]);//usuario logueado
GLO_ValidaUSERTUR($usuario,$id,'Inicio',$conn);

if ($_GET['Flag1']=="True"){	
	$query="SELECT t.*,u.FPago From turnos t,usuarios u where t.IdUsuario=u.Usuario and u.Usuario='$usuario' and t.Id=$id";$rs=mysql_query($query,$conn);
	while($row=mysql_fetch_array($rs)){
		$_SESSION['TxtNumero'] = str_pad($row['Id'], 6, "0", STR_PAD_LEFT);
		$_SESSION['TxtFecha']=ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha'])).' '.FormatoFecha($row['Fecha']);
		$_SESSION['TxtHora']=date("H:i",strtotime($row['Hora']));
		$_SESSION['TxtIdAgenda']=$row['IdAgenda'];
		$_SESSION['TxtIdUsuario']=$row['IdUsuario'];
		$_SESSION['TxtIdEstado']=$row['Estado'];
		$_SESSION['TxtObs']=$row['Obs'];
		$_SESSION['TxtPaciente']=$row['Paciente'];
		$_SESSION['TxtDNIP']=$row['DNIP'];
		$_SESSION['OptEnvioMail']=$row['EnvioMail'];
		$_SESSION['CbIdRSF']=$row['IdRSF'];
		$_SESSION['ChkAc'] = $row['Acepto'];
		$_SESSION['OptFPago1'] = $row['FPago1'];
		$_SESSION['OptFPago2'] = $row['FPago2'];
		$_SESSION['TxtFPago'] =$row['FPago'];
		$_SESSION['TxtST']=$row['STurno'];
		//
		include ("../Includes/zMostrarTurno.php");
		//dias transcurridos
		$dias=dias_transcurridos(date("d-m-Y"),FormatoFecha($row['Fecha']));
		if($dias>1){$_SESSION['TxtDiasFaltantes']='(dentro de '.$dias.' dias)';}
		if($dias==1){$_SESSION['TxtDiasFaltantes']='(dentro de '.$dias.' dia)';}
		if($dias==0){$_SESSION['TxtDiasFaltantes']='(hoy)';}
	}mysql_free_result($rs);
	$_SESSION['TxtCond']=GLO_TURCondicionesWEB($conn);//condiciones
}



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
<? GLO_bodyform('CbIdRSF',0,0); ?>
<? include ("../Codigo/BannerConMenuHV.php");?>
<? GLO_formform('Formulario','zVerTurno.php',1,0,0); 
GLO_tituloypath(0,700,'../MisTurnos.php','VER TURNO','linksalir'); ?>
	
	<? 
include ("../Includes/zCamposTurno1.php");
include ("../Includes/zCamposTurno2.php");
?>
 

<table width="700" border="0"   cellspacing="0"  class="Tabla TMT">
<tr> <td height="3"></td></tr>
<tr> <td height="19" align="center" > </td></tr>
</table>



<? 
GLO_mensajeerror();
GLO_Hidden('TxtST',0);
GLO_cierratablaform();
mysql_close($conn);

GLO_initcomment(700,0);
echo 'Para agregar una <font class="comentario2">Raz&oacute;n Social</font> a la lista desplegable, elija la opci&oacute;n del men&uacute; <font class="comentario3">Mi Cuenta</font>.<br>';
GLO_endcomment();
?>

<? include ("../Codigo/FooterConUsuario.php");?>