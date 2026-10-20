<? include("../Codigo/SeguridadCMIT.php") ;include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Config.php"); include ("Includes/zFunciones.php"); require_once('../Codigo/calendar/classes/tc_calendar.php');
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}
//$_GET trae id user
GLO_ValidaGETTUR($_GET['id'],0,0,'InicioCMIT');//valida que no sea vacio

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

if ($_GET['Flag1']!="False"){
	$id=mysql_real_escape_string(decrypt($_GET['id'],'elcrucedelosandes2016'));	
	$query="SELECT * From usuarios where Usuario='$id'";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
	if(mysql_num_rows($rs)!=0){
		$_SESSION['TxtUsuario'] = $row['Usuario'];
		$_SESSION['TxtNombre']=$row['Nombre'];
		$_SESSION['TxtApellido']= $row['Apellido'];
		$_SESSION['TxtTel'] = $row['Tel'];
		$_SESSION['TxtRSF']=$row['RSF'];
		$_SESSION['TxtCUITF']=$row['CUITF'];
		$_SESSION['TxtDomiF']=$row['DomiF'];
		$_SESSION['TxtPciaF']=$row['PciaF'];
		$_SESSION['TxtNFF']=$row['NFF'];
		$_SESSION['ChkFP']=$row['FPago'];		
		$_SESSION['ChkBloq']= $row['Bloqueado'];
		$_SESSION['ChkBloqOrig']= $row['Bloqueado'];
		$_SESSION['ChkR']= $row['Riesgo'];if($row['FPago']==0){$_SESSION['ChkR']=1;}//si es ctdo es riesgo
		//
		$_SESSION['ChkSA']=$row['SA'];		
		$_SESSION['TxtDias']=$row['DiasSA'];
		$_SESSION['TxtFechaSA'] = GLO_FormatoFecha($row['FechaSA']);
		$_SESSION['TxtFechaSAF'] = GLO_TURSinAltaHTFin($row['FPago'],$row['SA'],$row['DiasSA'],$row['FechaSA']);//fecha fin HT
		//
		$_SESSION['ChkHT']=GLO_TURSinAltaHT($row['FPago'],$row['SA'],$row['DiasSA'],$row['FechaSA']);
	}mysql_free_result($rs);	
}	

//texto bloq
$_SESSION['ChkBloqT']='Bloqueado '.GLO_FormatoFecha($row['FechaBL']);
if(intval($_SESSION['ChkBloq'])==1){$_SESSION['ChkBloqT']='Bloqueado manualmente '.GLO_FormatoFecha($row['FechaBL']);}
if(intval($_SESSION['ChkBloq'])==2){$_SESSION['ChkBloqT']='Bloqueado por alta automatica '.GLO_FormatoFecha($row['FechaBL']);}



GLO_InitHTML($_SESSION["NivelArbol"],'TxtNombre','BannerConMenuHVCMIT','zModificar',0,0,0,0);
GLO_tituloypath(0,650,'../Clientes.php','USUARIO','linksalir');
?>


<table width="650" border="0"   cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="430"></td><td width="100"></td> </tr>
<tr><td height="18"  align="right"  >EMail:</td><td  valign="top" > &nbsp; <input name="TxtUsuario" type="text"  readonly="true"  class="TextBoxRO" style="width:400px"  value="<? echo $_SESSION['TxtUsuario']; ?>"  onKeyDown="enterxtab(event)"></td><td align="right"><input name="CmdEnviarClave" type="submit" class="boton" value="Enviar Clave"  onClick="document.Formulario.target='_self'">&nbsp;</td></tr>
</table>  
      
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	       



<table width="650" border="0"   cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="430"></td><td width="100"></td> </tr>
<tr> <td height="18"  align="right"  ></td><td  valign="top" > &nbsp;<input name="ChkBloq" type="checkbox"  value="<? if(intval($_SESSION['ChkBloq'])==2){echo '2';}else{echo '1';} ?>" <? if (intval($_SESSION['ChkBloq'])!='0') echo 'checked'; ?>> <? GLO_CheckColor($_SESSION['ChkBloqT'],$_SESSION['ChkBloq'],0);?></td><td align="right"><input name="CmdTurnos" type="submit" class="boton02" value="Turnos"  onClick="document.Formulario.target='_self'">&nbsp;</td></tr>
<tr><td height="18"  align="right"  ></td><td  valign="top"  colspan="2"> &nbsp;<input name="ChkR"  type="checkbox"  value="1" <? if ($_SESSION['ChkR'] =='1') echo 'checked'; ?>> <? GLO_CheckColor('Cliente de Riesgo',$_SESSION['ChkR'],0);?></td></tr>
</table>  
      
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	       

<table width="650" border="0"   cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="530"></td> </tr>
<tr><td height="18"  align="right"  >Nombre:</td><td  valign="top" > &nbsp; <input name="TxtNombre" type="text"  class="TextBox" style="width:400px" maxlength="30"  value="<? echo $_SESSION['TxtNombre']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label><input  name="TxtId"   type="hidden"   value="<? echo $_SESSION['TxtId']; ?>"></td></tr>
<tr><td height="18"  align="right"  >Apellido:</td><td  valign="top" > &nbsp; <input name="TxtApellido" type="text"  class="TextBox" style="width:400px" maxlength="30"  value="<? echo $_SESSION['TxtApellido']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="18"  align="right"  >Tel&eacute;fono:</td><td  valign="top" > &nbsp; <input name="TxtTel" type="text"  class="TextBox" style="width:400px" maxlength="50"  value="<? echo $_SESSION['TxtTel']; ?>" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
</table>  
      
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	       

<table width="650" border="0"   cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="530"></td> </tr>
<tr><td height="18"  align="right"  >Raz&oacute;n Social:</td><td  valign="top" > &nbsp; <input name="TxtRSF" type="text"  class="TextBox" style="width:400px" maxlength="100"  value="<? echo $_SESSION['TxtRSF']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr><td height="18"  align="right"  >Nombre de Fantasia:</td><td  valign="top" > &nbsp; <input name="TxtNFF" type="text"  class="TextBox" style="width:400px" maxlength="100"  value="<? echo $_SESSION['TxtNFF']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >CUIT:</td><td  valign="top" > &nbsp; <input name="TxtCUITF" type="text"  class="TextBox" style="width:400px" maxlength="20"  value="<? echo $_SESSION['TxtCUITF']; ?>"  onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="18"  align="right"  >Domicilio Real:</td><td  valign="top" > &nbsp; <input name="TxtDomiF" type="text"  class="TextBox" style="width:400px" maxlength="100"  value="<? echo $_SESSION['TxtDomiF']; ?>" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="18"  align="right"  >Ciudad/Provincia:</td><td  valign="top" > &nbsp; <input name="TxtPciaF"  type="text"  class="TextBox"  style="width:400px" maxlength="100" tabindex="1"  value="<? echo $_SESSION['TxtPciaF'];?>"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
</table>  
    
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	                    

<table width="650" border="0"   cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="150"></td><td width="380"></td> </tr>
<tr><td height="18"  align="right"  >Forma de Pago:</td><td  valign="top" > &nbsp; <input name="ChkFP"  type="checkbox"  value="1" <? if ($_SESSION['ChkFP'] ==1) echo 'checked'; ?>> Cuenta Corriente</td><td><input name="ChkSA"  type="checkbox"  value="1" <? if ($_SESSION['ChkSA'] ==1) {echo 'checked';} if ($_SESSION['ChkFP'] ==0) {echo ' onClick="document.Formulario.target='."'_self'".';this.form.submit()"';}  ?>  > <? GLO_CheckColor('Sin Alta de Turnos',$_SESSION['ChkSA'],0);?></td></tr>
<? 
if ($_SESSION['ChkFP'] ==0 and $_SESSION['ChkSA']!=0){include("Includes/zCamposCtdo.php");}
?> 
</table>  
    

<? 
GLO_Hidden('TxtFechaSAF',0);GLO_Hidden('ChkBloqOrig',0);
GLO_botonesform(650,0,2);
GLO_mensajeerror();
?>


<!--cc-->	  
<table width="650" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr> <td height="3" ></td></tr>
<tr ><td height="18"  class="subtituloturnos" valign="bottom">Empresas registradas por el usuario:</td><td align="right">
<? if(intval($_SESSION['ChkBloq'])==0){ echo '<input name="CmdAddRS" type="submit" class="botonlog" style="width:90px;" value="Agregar" onClick="document.Formulario.target='."'_self'".'">&nbsp;';}?>
</table>

                 

<? 
CLI_MostrarTablaRS($_SESSION['TxtUsuario'],$conn);
GLO_cierratablaform();
mysql_close($conn);

GLO_initcomment(650,0);
echo 'Para informar la contrase&ntilde;a al usuario debe hacer click en <font class="comentario3">Enviar Clave</font><br>';
echo 'Los Usuarios con Forma de Pago <font class="comentario3">Contado</font> son Clientes de <font class="comentario2">Riesgo</font><br>';
echo 'Si esta <font class="comentario2">Bloqueado</font> no podr&aacute; ingresar al sistema de turnos<br>';
//echo 'Si es de <font class="comentario2">Riesgo</font> se enviar&aacute; mail a facturacion cuando realice cambios<br>';
GLO_endcomment();
include ("../Codigo/FooterConUsuario.php");
?>