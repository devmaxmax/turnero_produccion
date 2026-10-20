<? include("../Codigo/SeguridadCMIT.php") ;include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Config.php"); 

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

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
		$_SESSION['TxtPuesto']=$row['Puesto'];
		$_SESSION['TxtObsPuesto']=$row['ObsPuesto'];
		$_SESSION['CbIdTipoEx']=$row['IdTipoEx'];
		$_SESSION['TxtObsTipo']=$row['ObsTipo'];
		$_SESSION['CbIdEntidad']=$row['IdEntidad'];
		$_SESSION['TxtDetalle']=$row['Detalle'];
		$_SESSION['OptEnvioMail']=$row['EnvioMail'];
		$_SESSION['TxtART']=$row['ART'];
		$_SESSION['CbIdRSF']=$row['IdRSF'];
		$_SESSION['TxtCmit']=$row['Cmit'];
		$_SESSION['ChkAc'] = $row['Acepto'];
		$_SESSION['TxtCarga'] = $row['Carga'];
		$_SESSION['OptFPago1'] = $row['FPago1'];
		$_SESSION['OptFPago2'] = $row['FPago2'];
		$_SESSION['TxtFPago'] =0;
		$_SESSION['TxtSTurno'] = GLO_TURSobreturnoLY($_SESSION['TxtHora']);	
		//estado
		if($row['Estado']==1){$_SESSION['ChkAt']='Atendido';$colorest=' style="font-weight:bold;color:#4CAF50"';$helpest='Borrar Atendido';}
		if($row['Estado']==0){$_SESSION['ChkAt']='Sin Atender';$colorest=' style="font-weight:bold;color:#f44336"';$helpest='Atender';}
		//dias transcurridos
		$dias=dias_transcurridos(date("d-m-Y"),FormatoFecha($row['Fecha']));
		if($dias>1){$_SESSION['TxtDiasFaltantes']='(dentro de '.$dias.' días)';}
		if($dias==1){$_SESSION['TxtDiasFaltantes']='(dentro de '.$dias.' día)';}
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

function ComboLocalRSFCMIT($campo,$criterio,$conn){
$idcombo=intval($_SESSION[$campo]);
//busco RSF de usuarios y usuariosclientes
$query1="SELECT 0 as Id,u.RSF,u.Usuario FROM usuarios u Where usuario <>'ngrunmann@gmail.com' and u.Bloqueado=0 and u.RSF Like '%".$criterio."%'";
$query2="SELECT uc.Id,uc.RSF,uc.IdUsuario as Usuario FROM usuariosclientes uc,usuarios u where uc.Id<>0 and uc.IdUsuario=u.Usuario and u.Bloqueado=0 and uc.RSF Like '%".$criterio."%'";
$query="Select uu.* From ($query1 UNION ALL $query2)uu Order by uu.RSF";$rs=mysql_query($query,$conn);
$combo='<option value=""></option>';
while($row=mysql_fetch_array($rs)){ 
	$combo .= " <option value='".$row['Id'].'|'.$row['Usuario']."'>".$row['RSF'].' ('.$row['Usuario'].')'."</option>\n";   
}mysql_free_result($rs);
echo $combo;
}


?>

<? include ("../Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="../CSS/Estilo.css" >
<? GLO_bodyform('CbIdRSF',0,0); ?>
<? include ("../Codigo/BannerConMenuHVCMIT.php");?>
<? GLO_formform('Formulario','zModificar.php',1,0,0); ?>


<table width="100%" border="0"  cellpadding="0" cellspacing="0"><tr> <td height="8"></td></tr><tr><td align="center">

<table width="700" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr ><td width="150" ></td> <td height="20" align="center" width="400" class="Titulo" >MODIFICAR TURNO</td><td width="150" align="right" ><? if($_SESSION['TxtIdEstado']!=1 and $_SESSION['TxtIdEstado']!=3) echo '<input name="CmdReagendar" type="submit" class="boton2"  value="Cambiar Fecha"  style="width:90px" >';?></td>  </tr>
<tr> <td align="center" class="MuestraError"  style="font-size:14px" colspan="3"> <?php echo $_GET['msgE']; ?> </td> </tr>
</table> 



<table width="700" border="0"   cellspacing="0" class="Tabla" >
<tr> <td width="150" height="3"  ></td><td width="50" height="3"  ></td> <td width="500"></td> </tr>
<tr><td  height="18" >&nbsp;<input  name="TxtNumero" type="text"  readonly="true"  class="TextBoxRO" style="width:50px" value="<? echo $_SESSION[TxtNumero];?>"> <label class="comentario3" style="color:#0099cc;"><? echo $_SESSION['TxtSTurno']; ?></label></td><td  align="right"  >Turno:</td><td  valign="top" >&nbsp; <input  name="TxtFecha" type="text"  readonly="true"  class="TextBoxRO" style="width:90px"  value="<? echo $_SESSION[TxtFecha];?>" >  <input  name="TxtHora" type="text"  readonly="true"  class="TextBoxRO" style="width:50px"  value="<? echo $_SESSION[TxtHora];?>" >&nbsp; <label class="comentario3"><? echo $_SESSION['TxtDiasFaltantes']; ?></label> &nbsp;&nbsp;&nbsp;&nbsp;<? if($_SESSION['TxtIdEstado']!=3) echo '<input name="CmdAtender" type="submit" class="botonseleccionar" value="" title="">'; ?> <label <? echo $colorest; ?>><? echo $_SESSION['ChkAt']; ?></label></td>
</tr>
</table>
	
    
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	

 
  
<table width="700" border="0"   cellspacing="0" class="Tabla" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  >Razón Social:</td><td  valign="top" >&nbsp; 
<? 
//si dio de alta cmit y no asignó usuario pongo buscado de RS
if($_SESSION['TxtCmit']==1 and $_SESSION['TxtIdUsuario']=='ngrunmann@gmail.com'){
	echo '<input name="TxtExCriterio" type="text" class="TextBox" style="width:150px" maxlength="20" tabindex="1" onKeyPress="if(event.keyCode==13){document.Formulario.CmdExBuscar.click();}"> <input name="CmdExBuscar"  type="submit" class="botonbuscarG" tabindex="1" title="Buscar" value="" onClick="document.Formulario.target='."'_self'".'"> &nbsp; &nbsp;<select name="CbIdRSF"  class="campos" id="CbIdRSF" style="width:250px" tabindex="1">'; 
	if ($_SESSION[TxtExCriterio]!=""){	ComboLocalRSFCMIT("CbIdRSF",mysql_real_escape_string($_SESSION[TxtExCriterio]),$conn);}
	echo '</select>';
}else{echo '<select name="CbIdRSF" style="width:450px" class="campos" tabindex="1">';ComboLocalRSF("CbIdRSF",$conn);echo '</select>';}
//si dio de alta cmit no pongo requerido
if($_SESSION['TxtCmit']==0){echo '<label class="MuestraCampoRequerido"> * </label>';} 
?>

 </td></tr>
<tr><td height="18"  align="right"  >Facturar A:</td><td  valign="top" >&nbsp; <select name="CbIdEntidad" style="width:250px; " class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("entidades","CbIdEntidad","Nombre","","",$conn); ?></select><? if($_SESSION['TxtCmit']==0){echo '<label class="MuestraCampoRequerido"> * </label>';} ?></td></tr>
<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >ART que lo envía:</td><td  valign="top" >&nbsp; <input name="TxtART"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION[TxtART];?>"> </td></tr>
</table>
    
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	


<table width="700" border="0"   cellspacing="0" class="Tabla" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  >Apellido y Nombre del Paciente:</td><td  valign="top" >&nbsp; <input name="TxtPaciente"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION[TxtPaciente];?>"><? if($_SESSION['TxtCmit']==0){echo '<label class="MuestraCampoRequerido"> * </label>';} ?> </td></tr>
<tr><td height="18"  align="right"  >DNI Paciente:</td><td  valign="top" >&nbsp; <input name="TxtDNIP"  type="text"  class="TextBox"  style="width:250px" maxlength="20" tabindex="1"  value="<? echo $_SESSION[TxtDNIP];?>"> </td></tr>
<tr><td height="18"  align="right"  >Nombre del Puesto:</td><td  valign="top" >&nbsp; <input name="TxtPuesto"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION[TxtPuesto];?>"><? if($_SESSION['TxtCmit']==0){echo '<label class="MuestraCampoRequerido"> * </label>';} ?> </td></tr>
<tr><td height="18"  align="right"  >Observaciones del Puesto:</td><td  valign="top" >&nbsp; <input name="TxtObsPuesto"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION[TxtObsPuesto];?>"> </td></tr>
<tr><td height="18"  align="right"  >Tipo de Examen:</td><td  valign="top" >&nbsp; <select name="CbIdTipoEx" style="width:250px" class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("tipoexamen","CbIdTipoEx","Id","","",$conn); ?></select><? if($_SESSION['TxtCmit']==0){echo '<label class="MuestraCampoRequerido"> * </label>';} ?></td></tr>
<tr><td height="18"  align="right"  >Si es otro aclarar:</td><td  valign="top" >&nbsp; <input name="TxtObsTipo"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION[TxtObsTipo];?>"> </td></tr>
<tr><td height="18"  align="right"  valign="top" >Detalle (estudios incluidos):</td><td  valign="top" >&nbsp; <textarea name="TxtDetalle" style="width:450px" rows="5" class="TextBox" onKeyPress="event.cancelBubble=true;" tabindex="1"><? echo $_SESSION[TxtDetalle]; ?></textarea><? if($_SESSION['TxtCmit']==0){echo '<label class="MuestraCampoRequerido"> * </label>';} ?></td></tr>
<tr><td height="18"  align="right"  valign="top" >Observaciones:</td><td  valign="top" >&nbsp; <textarea name="TxtObs" style="width:450px" rows="1" class="TextBox" onKeyPress="event.cancelBubble=true;" tabindex="1"><? echo $_SESSION[TxtObs]; ?></textarea></td></tr>
<tr><td height="18"  align="right"  >¿Envió email a turnos@cmit.com.ar ampliando el pedido?:</td><td  valign="top" >&nbsp; <input name="OptEnvioMail"  type="radio"  class="radiob"  tabindex="1"  value="SI"<? if ($_SESSION[OptEnvioMail] =='SI') echo 'checked'; ?> >Si   <input name="OptEnvioMail"  type="radio"  class="radiob" tabindex="1"  value="NO"<? if ($_SESSION[OptEnvioMail] =='NO') echo 'checked'; ?> >No   </td></tr>
</table>
    
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	

<table width="700" border="0"  cellspacing="0" class="Tabla" >
<tr> <td width="200" height="3"  ></td> <td width="250"></td><td width="250"></td> </tr>
<tr><td height="18"  align="right"   valign="middle">Forma de Pago:</td><td  valign="top" >&nbsp;<input name="OptFPago1"  type="radio"  class="radiob"    value="0" <? if ($_SESSION[OptFPago1] ==0) echo 'checked'; ?> >Contado anticipado al envio del paciente</td><td><select name="OptFPago2" style="width:200px" class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("turnosdetalle","OptFPago2","Id","","",$conn); ?></select><? if($_SESSION['TxtCmit']==0){echo '<label class="MuestraCampoRequerido"> * </label>';} ?></td></tr>
<? if ($_SESSION[TxtFPago] ==1){
echo '<tr> <td height="2"></td></tr>';
echo '<tr><td height="18"  align="right"  valign="top" ></td><td  valign="top" >&nbsp;<input name="OptFPago1" type="radio"  class="radiob"   value="1"'; if ($_SESSION[OptFPago1]==1) echo 'checked';echo'>Cuenta Corriente</td><td></td></tr>';
} ?>
</table>
    
    
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	

<table width="700" border="0"   cellspacing="0" class="Tabla" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  valign="top" >Condiciones:</td><td  valign="top" >&nbsp; <textarea name="TxtCond" style="width:450px" rows="1" onKeyPress="event.cancelBubble=true;" readonly="true"  class="TextBoxRO"><? echo $_SESSION[TxtCond]; ?></textarea></td></tr>
<tr><td height="18"  align="right"  valign="top" ></td><td  valign="top" >&nbsp;<input name="ChkAc"  disabled  type="checkbox"  value="1" <? if ($_SESSION[ChkAc] =='1') echo 'checked'; ?>> Acepto</td></tr>
</table>
    
    
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	


<table width="700" border="0"   cellspacing="0"  class="Tabla">
<tr> <td height="3"></td></tr>
<tr> <td height="19" align="center"  >
<?
//restriccion perfiles y no eliminado
if (($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2  or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10) and ($_SESSION['TxtIdEstado']!=3)){ 	
$click="'Por favor aguarde. Grabará los cambios y enviará mail al Cliente'";
echo '<input name="CmdAceptar" type="submit" class="botongreen" tabindex="2" value="Guardar" onClick="return confirm('.$click.');">  &nbsp;';
}
?>
<input name="CmdCancelar" type="submit" class="botonred"  value="Cerrar"  >
<input  name="TxtIdAgenda" type="hidden"  value="<? echo $_SESSION[TxtIdAgenda];?>"><input  name="TxtIdUsuario" type="hidden"  value="<? echo $_SESSION[TxtIdUsuario];?>"><input  name="TxtCmit" type="hidden"  value="<? echo $_SESSION[TxtCmit];?>"><input  name="TxtFPago" type="hidden"  value="<? echo $_SESSION[TxtFPago];?>"></td></tr>
</table>


<!--  Mensaje error-->			  
<table width="600" border="0"  cellpadding="0" cellspacing="0"  >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table>


<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="10"></td></tr></table>	
  
<table width="700" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr ><td height="18" ><strong>Datos del solicitante:</strong></td></tr>
</table>
<table width="700" border="0"   cellspacing="0" class="Tabla" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  >Razón Social:</td><td  valign="top" > &nbsp; <input name="TxtRSF" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"  value="<? echo $_SESSION[TxtRSF]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >Nombre de Fantasia:</td><td  valign="top" > &nbsp; <input name="TxtNFF" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"   value="<? echo $_SESSION[TxtNFF]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >CUIT:</td><td  valign="top" > &nbsp; <input name="TxtCUITF" type="text"  readonly="true"  class="TextBoxRO" style="width:250px"   value="<? echo $_SESSION[TxtCUITF]; ?>"  onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="18"  align="right"  >Domicilio Real:</td><td  valign="top" > &nbsp; <input name="TxtDomiF" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"  value="<? echo $_SESSION[TxtDomiF]; ?>" onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="18"  align="right"  >Ciudad/Provincia:</td><td  valign="top" > &nbsp; <input name="TxtPciaF"  type="text" readonly="true"  class="TextBoxRO"  style="width:450px"  tabindex="1"  value="<? echo $_SESSION[TxtPciaF];?>"></td></tr>
<tr><td height="18"  align="right"  >Empresa Planilla:</td><td  valign="top" > &nbsp; <input name="TxtRSPF" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"   value="<? echo $_SESSION[TxtRSPF]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >Usuario:</td><td  valign="top" > &nbsp; <input name="TxtIdUsuario2" type="text"  readonly="true"  class="TextBoxRO" style="width:250px"   value="<? echo $_SESSION[TxtIdUsuario2]; ?>"  onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >Nombre:</td><td  valign="top" > &nbsp; <input name="TxtNombre" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"   value="<? echo $_SESSION[TxtNombre]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >Apellido:</td><td  valign="top" > &nbsp; <input name="TxtApellido" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"  value="<? echo $_SESSION[TxtApellido]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="18"  align="right"  >Teléfono:</td><td  valign="top" > &nbsp; <input name="TxtTel" type="text"  readonly="true"  class="TextBoxRO" style="width:450px"   value="<? echo $_SESSION[TxtTel]; ?>" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >Usuario Registró:</td><td  valign="top" > &nbsp; <input name="TxtCarga" type="text"  readonly="true"  class="TextBoxRO" style="width:250px"   value="<? echo $_SESSION[TxtCarga]; ?>"  onKeyDown="enterxtab(event)"></td></tr>
</table>



<? 
GLO_cierratablaform();
mysql_close($conn);

GLO_initcomment(700,0);
echo 'Para agregar una <font class="comentario2">Razón Social</font> a la lista desplegable, elija la opción del menú <font class="comentario3">Mi Cuenta</font>.<br>';
echo 'Enviará <font class="comentario3">Mail</font>  de aviso al Cliente si el turno: tiene cliente asignado, no está atendido y está vigente<br>';
echo 'Para <font class="comentario3">Atender</font> o <font class="comentario3">Borrar Atendido</font> haga click en el botón del tilde.';
GLO_endcomment();
?>

<? include ("../Codigo/FooterConUsuario.php");?>
</body>
</html>