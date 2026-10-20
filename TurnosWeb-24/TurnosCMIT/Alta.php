<?php include("../Codigo/Root.php") ;?>
<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Funciones.php");include("../Codigo/Config.php");    $_SESSION["NivelArbol"]="../";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}
//$_GET trae fecha turno
GLO_ValidaGETTUR($_GET['Id'],0,0,'InicioCMIT');//valida que no sea vacio

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);


$_SESSION['TxtIdEncriptado']=$_GET['Id'];//id encriptado de fecha+hora+agenda para volvera VerTurnosCMIT.php	
list($f,$h,$a)=explode("|",mysql_real_escape_string(decrypt($_GET['Id'],'elcrucedelosandes2016')));
$_SESSION['TxtFecha']=$f;$_SESSION['TxtHora']=$h;$_SESSION['TxtIdAgenda']=$a;
//dias transcurridos
$dias=dias_transcurridos(date("d-m-Y"),$f);
if($dias>1){$_SESSION['TxtDiasFaltantes']='(dentro de '.$dias.' dias)';}
if($dias==1){$_SESSION['TxtDiasFaltantes']='(dentro de '.$dias.' dia)';}
if($dias==0){$_SESSION['TxtDiasFaltantes']='(hoy)';}
?> 

<? include ("../Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="../CSS/Estilo.css" >
<? GLO_bodyform('',0,0); ?>
<? include ("../Codigo/BannerConMenuHVCMIT.php");?>
<? GLO_formform('Formulario','zAlta.php',0,0,0); ?>
<? GLO_tituloypath(0,700,'','ALTA DE TURNO','salir'); ?>


<table width="700" border="0"  cellspacing="0" class="Tabla" >
<tr> <td width="150" height="3"  ></td> <td width="550"></td> </tr>
<tr><td height="18"  align="right"  >Turno:</td><td  valign="top" > &nbsp;<input  name="TxtFecha" type="text"  readonly="true"  class="TextBoxRO" style="width:70px"  value="<? echo $_SESSION['TxtFecha'];?>" >  <input  name="TxtHora" type="text"  readonly="true"  class="TextBoxRO" style="width:50px"  value="<? echo $_SESSION['TxtHora'];?>" >&nbsp; <label class="comentario3"  style="font-weight:normal;"><? echo $_SESSION['TxtDiasFaltantes']; ?></label></td></tr>
</table>
<? GLO_Hidden('TxtNumero',0);GLO_Hidden('TxtIdAgenda',0);GLO_Hidden('TxtIdEncriptado',0); ?>
	
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	

<table width="700" border="0"   cellspacing="0"  class="Tabla">
<tr> <td height="3"></td></tr>
<tr> <td height="19" align="center"><input name="CmdAceptar" type="submit" class="boton"  value="Seguir" onClick="return confirm('Desea grabar los datos?');">  &nbsp; <input name="CmdCancelar" type="submit" class="boton"  value="Cancelar"  > </td></tr>
</table>



<? 
GLO_mensajeerror();
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(700,0);
echo 'Para solicitar el <font class="comentario3">Turno</font> seleccione el boton <font class="comentario2">Seguir</font>';
GLO_endcomment();
?>


<? include ("../Codigo/FooterConUsuario.php");?>