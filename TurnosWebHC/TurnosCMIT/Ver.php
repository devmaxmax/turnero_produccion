<? include("../Codigo/SeguridadCMIT.php") ;include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Config.php"); 
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}
//$_GET trae id turno
GLO_ValidaGETTUR($_GET['id'],0,0,'InicioCMIT');//valida que no sea vacio

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

if ($_GET['Flag1']=="True"){
	$id=intval(decrypt($_GET['id'],'elcrucedelosandes2016'));
	$query="SELECT t.* From turnos t where t.Id=$id";$rs=mysql_query($query,$conn);
	while($row=mysql_fetch_array($rs)){
		$_SESSION['TxtNumero'] = str_pad($row['Id'], 6, "0", STR_PAD_LEFT);
		$_SESSION['TxtFecha']=ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha'])).' '.FormatoFecha($row['Fecha']);
		$_SESSION['TxtHora']=date("H:i",strtotime($row['Hora']));
		$_SESSION['TxtIdAgenda']=$row['IdAgenda'];
		$_SESSION['TxtIdUsuario']=$row['IdUsuario'];
		$_SESSION['TxtIdEstado']=$row['Estado'];
		if($row['Cmit']==1 and $row['IdUsuario']=='ngrunmann@gmail.com'){$_SESSION['TxtIdUsuario2']='CMIT';}else{$_SESSION['TxtIdUsuario2']=$row['IdUsuario'];}
		$_SESSION['TxtObs']=$row['Obs'];
		$_SESSION['TxtPaciente']=$row['Paciente'];
		$_SESSION['TxtDNIP']=$row['DNIP'];
		$_SESSION['OptEnvioMail']=$row['EnvioMail'];
		$_SESSION['CbIdRSF']=$row['IdRSF'];
		$_SESSION['TxtCmit']=$row['Cmit'];
		$_SESSION['ChkAc'] = $row['Acepto'];
		$_SESSION['TxtCarga'] = $row['Carga'];
		$_SESSION['OptFPago1'] = $row['FPago1'];
		$_SESSION['OptFPago2'] = $row['FPago2'];
		$_SESSION['TxtFPago'] =0;
		$_SESSION['TxtSTurno'] = GLO_TURSobreturnoLY($row['STurno']);
		//
		include ("../Includes/zMostrarTurno.php");
		//estado
		if($row['Estado']==1){$_SESSION['ChkAt']='Atendido';$colorest=' style="font-weight:bold;color:#0F9D58"';$helpest='Borrar Atendido';}
		if($row['Estado']==0){$_SESSION['ChkAt']='Sin Atender';$colorest=' style="font-weight:bold;color:#f44336"';$helpest='Atender';}
		//dias transcurridos
		$dias=dias_transcurridos(date("d-m-Y"),FormatoFecha($row['Fecha']));
		if($dias>1){$_SESSION['TxtDiasFaltantes']='(dentro de '.$dias.' dias)';}
		if($dias==1){$_SESSION['TxtDiasFaltantes']='(dentro de '.$dias.' dia)';}
		if($dias==0){$_SESSION['TxtDiasFaltantes']='(hoy)';}
	}mysql_free_result($rs);	
	//datos empresa
	if($_SESSION['CbIdRSF']==0)
	{$query="SELECT u.* FROM usuarios u where u.Usuario='".$_SESSION['TxtIdUsuario']."'";}
	else{$query="SELECT uc.*,u.Nombre,u.Apellido,u.Tel,u.FPago FROM usuariosclientes uc,usuarios u where u.Usuario=uc.IdUsuario and uc.Id=".$_SESSION['CbIdRSF'];}
	$rs=mysql_query($query,$conn);
	while($row=mysql_fetch_array($rs)){
		$_SESSION['TxtRSF']=$row['RSF'];
		$_SESSION['TxtCUITF']=$row['CUITF'];
		$_SESSION['TxtDomiF']=$row['DomiF'];
		$_SESSION['TxtPciaF']=$row['PciaF'];
		$_SESSION['TxtNFF']=$row['NFF'];
		$_SESSION['TxtRSPF']=$row['RSPF'];
		$_SESSION['TxtNombre']=$row['Nombre'];
		$_SESSION['TxtApellido']= $row['Apellido'];
		$_SESSION['TxtTel'] = $row['Tel'];		
		$_SESSION['TxtFPago'] = $row['FPago'];
	}mysql_free_result($rs);
	$_SESSION['TxtCond']=GLO_TURCondicionesWEB($conn);//condiciones
}



function ComboLocalRSF($campo,$conn){
$idcombo=intval($_SESSION[$campo]);
$usuario=mysql_real_escape_string($_SESSION['TxtIdUsuario']);
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
<? include ("../Codigo/BannerConMenuHVCMIT.php");?>
<? GLO_formform('Formulario','zVer.php',1,0,0);
GLO_tituloypath(0,700,'../ConsultaCMIT.php','VER TURNO','linksalir'); 
?>

<? GLO_mensajeerrorE();?>

<table width="700" border="0"   cellspacing="0" class="Tabla" >
<tr> <td width="150" height="3"  ></td><td width="50" height="3"  ></td> <td width="500"></td> </tr>
<tr><td  height="18" >&nbsp;<input  name="TxtNumero" type="text"  readonly="true"  class="TextBoxRO" style="width:50px" value="<? echo $_SESSION['TxtNumero'];?>"> <label class="comentario3"  style="color:#4285F4;"><? echo $_SESSION['TxtSTurno']; ?></label></td><td  align="right"  >Turno:</td><td  valign="top" >&nbsp; <input  name="TxtFecha" type="text"  readonly="true"  class="TextBoxRO" style="width:90px"  value="<? echo $_SESSION['TxtFecha'];?>" >  <input  name="TxtHora" type="text"  readonly="true"  class="TextBoxRO" style="width:50px"  value="<? echo $_SESSION['TxtHora'];?>" >&nbsp; <label class="comentario3"  style="font-weight:normal;"><? echo $_SESSION['TxtDiasFaltantes']; ?></label> &nbsp;&nbsp;&nbsp;&nbsp;<? if($_SESSION['TxtIdEstado']!=3) echo '<button name="CmdAtender" type="submit" class="iconbtn2" value="" title=""><i class="fa fa-check iconsmallbt iconlgray"></i></button>'; ?> <label <? echo $colorest; ?>><? echo $_SESSION['ChkAt']; ?></label></td>
</tr>
</table>
	
    
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	

 
  
<table width="700" border="0"  cellspacing="0" class="Tabla" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  >Raz&oacute;n Social:</td><td  valign="top" >&nbsp; 
<? 
echo '<select name="CbIdRSF" style="width:450px" class="campos" tabindex="1">';ComboLocalRSF("CbIdRSF",$conn);echo '</select>';
//si dio de alta cmit no pongo requerido
if($_SESSION['TxtCmit']==0){echo '<label class="MuestraCampoRequerido"> * </label>';} 
?>

 </td></tr>
</table>

<? include ("../Includes/zCamposTurnoCMIT.php");?>


<table width="700" border="0"   cellspacing="0"  class="Tabla">
<tr> <td height="3"></td></tr>
<tr> <td height="19" align="center" >
<input name="CmdCancelar" type="submit" class="boton"  value="Cerrar"  >
<input  name="TxtIdAgenda" type="hidden"  value="<? echo $_SESSION['TxtIdAgenda'];?>"><input  name="TxtIdUsuario" type="hidden"  value="<? echo $_SESSION['TxtIdUsuario'];?>"><input  name="TxtCmit" type="hidden"  value="<? echo $_SESSION['TxtCmit'];?>"><input  name="TxtFPago" type="hidden"  value="<? echo $_SESSION['TxtFPago'];?>"></td></tr>
</table>

<?
GLO_mensajeerror();
?>


<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="10"></td></tr></table>	
  
<table width="700" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr ><td height="18" ><strong>Datos del solicitante:</strong></td></tr>
</table>
<table width="700" border="0"  cellspacing="0" class="Tabla" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  >Raz&oacute;n Social:</td><td  valign="top" > &nbsp; <input name="TxtRSF" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"  value="<? echo $_SESSION['TxtRSF']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >Nombre de Fantasia:</td><td  valign="top" > &nbsp; <input name="TxtNFF" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"   value="<? echo $_SESSION['TxtNFF']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >CUIT:</td><td  valign="top" > &nbsp; <input name="TxtCUITF" type="text"  readonly="true"  class="TextBoxRO" style="width:250px"   value="<? echo $_SESSION['TxtCUITF']; ?>"  onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="18"  align="right"  >Domicilio Real:</td><td  valign="top" > &nbsp; <input name="TxtDomiF" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"  value="<? echo $_SESSION['TxtDomiF']; ?>" onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="18"  align="right"  >Ciudad/Provincia:</td><td  valign="top" > &nbsp; <input name="TxtPciaF"  type="text" readonly="true"  class="TextBoxRO"  style="width:450px"  tabindex="1"  value="<? echo $_SESSION['TxtPciaF'];?>"></td></tr>
<tr><td height="18"  align="right"  >Empresa Planilla:</td><td  valign="top" > &nbsp; <input name="TxtRSPF" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"   value="<? echo $_SESSION['TxtRSPF']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >Usuario:</td><td  valign="top" > &nbsp; <input name="TxtIdUsuario2" type="text"  readonly="true"  class="TextBoxRO" style="width:250px"   value="<? echo $_SESSION['TxtIdUsuario2']; ?>"  onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >Nombre:</td><td  valign="top" > &nbsp; <input name="TxtNombre" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"   value="<? echo $_SESSION['TxtNombre']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >Apellido:</td><td  valign="top" > &nbsp; <input name="TxtApellido" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"  value="<? echo $_SESSION['TxtApellido']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="18"  align="right"  >Tel&eacute;fono:</td><td  valign="top" > &nbsp; <input name="TxtTel" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"   value="<? echo $_SESSION['TxtTel']; ?>" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >Usuario Registr&oacute;:</td><td  valign="top" > &nbsp; <input name="TxtCarga" type="text"  readonly="true"  class="TextBoxRO" style="width:250px"   value="<? echo $_SESSION['TxtCarga']; ?>"  onKeyDown="enterxtab(event)"></td></tr>
</table>



<? 
GLO_cierratablaform();
mysql_close($conn);

GLO_initcomment(700,0);
echo 'Enviar&aacute; <font class="comentario2">mail</font>  de aviso al Cliente si el turno: tiene cliente asignado, no est&aacute; atendido y est&aacute; vigente<br>';
echo 'Para <font class="comentario3">atender</font> o <font class="comentario3">borrar atendido</font> haga click en el bot&oacute;n del tilde.';
GLO_endcomment();
?>

<? include ("../Codigo/FooterConUsuario.php");?>