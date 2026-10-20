<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Funciones.php");include("../Codigo/Config.php");    $_SESSION["NivelArbol"]="../";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}


$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);


$_SESSION['TxtIdEncriptado']=$_GET['Id'];//id encriptado de fecha+hora+agenda para volvera VerTurnosCMIT.php	
list($f,$h,$a)=explode("|",mysql_real_escape_string(decrypt($_GET['Id'],'elcrucedelosandes2016')));
$_SESSION['TxtFecha']=$f;$_SESSION['TxtHora']=$h;$_SESSION['TxtIdAgenda']=$a;
//dias transcurridos
$dias=dias_transcurridos(date("d-m-Y"),$f);
if($dias>1){$_SESSION['TxtDiasFaltantes']='(dentro de '.$dias.' días)';}
if($dias==1){$_SESSION['TxtDiasFaltantes']='(dentro de '.$dias.' día)';}
if($dias==0){$_SESSION['TxtDiasFaltantes']='(hoy)';}
?> 

<? include ("../Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="../CSS/Estilo.css" >
<? GLO_bodyform('',0,0); ?>
<? include ("../Codigo/BannerConMenuHVCMIT.php");?>
<? GLO_formform('Formulario','zAlta.php',0,0,0); ?>
<? GLO_tituloypath(0,750,'','ALTA DE TURNO',''); ?>


<table width="700" border="0"  cellspacing="0" class="Tabla" >
<tr> <td width="150" height="3"  ></td> <td width="550"></td> </tr>
<tr><td height="18"  align="right"  >Turno:</td><td  valign="top" > &nbsp;<input  name="TxtFecha" type="text"  readonly="true"  class="TextBoxRO" style="width:70px"  value="<? echo $_SESSION[TxtFecha];?>" >  <input  name="TxtHora" type="text"  readonly="true"  class="TextBoxRO" style="width:50px"  value="<? echo $_SESSION[TxtHora];?>" >&nbsp; <label class="comentario3"><? echo $_SESSION['TxtDiasFaltantes']; ?></label><input  name="TxtNumero" type="hidden"  value="<? echo $_SESSION[TxtNumero];?>"><input  name="TxtIdAgenda" type="hidden"  value="<? echo $_SESSION[TxtIdAgenda];?>"><input  name="TxtIdEncriptado" type="hidden"  value="<? echo $_SESSION[TxtIdEncriptado];?>"></td></tr>
</table>
	
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	

<table width="700" border="0"   cellspacing="0"  class="Tabla">
<tr> <td height="3"></td></tr>
<tr> <td height="19" align="center"><input name="CmdAceptar" type="submit" class="botongreen"  value="Seguir" onClick="return confirm('Desea grabar los datos?');">  &nbsp; <input name="CmdCancelar" type="submit" class="botonred"  value="Cancelar"  > </td></tr>
</table>


<!--  Mensaje error-->			  
<table width="600" border="0"  cellpadding="0" cellspacing="0"  >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table>

<? 
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(700,0);
echo 'Para solicitar el <font class="comentario3">Turno</font> seleccione el botón <font class="comentario2">Seguir</font>';
GLO_endcomment();
?>


<? include ("../Codigo/FooterConUsuario.php");?>
</body>
</html>