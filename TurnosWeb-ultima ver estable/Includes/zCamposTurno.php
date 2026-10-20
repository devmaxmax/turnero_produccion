<? GLO_mensajeerror(); ?>

<!--turno--> 
<table width="900" border="0" cellspacing="0" class="Tabla TMT" >
<tr>
	<td width="130" height="18" >
		<label class="comentario3" style="color:#4285F4;">
			<? echo $_SESSION['TxtSTurno']; ?></label>
		</td>
		<td width="120" align="right">Turno:</td>
		<td width="650" valign="top">
			<input  name="TxtNumero" type="text"  readonly="true" class="TextBoxRO" value="<? echo $_SESSION['TxtNumero'];?>" style="text-align:right;width:90px">&nbsp;
			<input  name="TxtFecha" type="text"  readonly="true"  class="TextBoxRO" style="width:110px"  value="<? echo $_SESSION['TxtFecha'];?>" >
			<input  name="TxtHora" type="text"  readonly="true"  class="TextBoxRO" style="width:80px"  value="<? echo $_SESSION['TxtHora'];?>" >&nbsp; <label class="comentario3"  style="font-weight:normal;"><? echo $_SESSION['TxtDiasFaltantes']; ?></label>
		</td>
	</tr>
</table>



<? GLO_Hidden('TxtIdAgenda',0);GLO_Hidden('TxtIdUsuario',0);GLO_Hidden('TxtFPago',0); ?>

<!--cliente-->   
  
<table width="900" border="0" cellspacing="0" class="Tabla TMT" >

<tr>
	<td width="250" height="18" align="right">Raz&oacute;n Social:</td>
	<td width="650" valign="middle" >
		<select name="CbIdRSF" style="width:450px" class="campos" tabindex="1"><? ComboLocalRSF("CbIdRSF",$conn); ?></select><label class="MuestraCampoRequerido"> * </label>
	</td>
</tr>
<tr>
	<td height="18"  align="right">Facturar A:</td>
	<td  valign="middle" >
		<select name="CbIdEntidad" style="width:250px; " class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("entidades","CbIdEntidad","Nombre","","",$conn); ?></select><label class="MuestraCampoRequerido"> * </label>
	</td>
</tr>
<tr>
	<td height="18"  align="right"  >ART que lo env&iacute;a:</td>
	<td valign="middle" >
		<input name="TxtART"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtART'];?>">
	</td>
</tr>
</table>


<!--estudios-->
<table  border="0"  cellpadding="0" cellspacing="0">
	<tr>
		<td height="5"></td>
	</tr>
</table>	

<table width="900" border="0" cellspacing="0" class="Tabla" >
<tr>
	<td width="250" height="18"  align="right">Apellido y Nombre del Paciente:</td>
	<td width="650" valign="middle" >
		<input name="TxtPaciente"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtPaciente'];?>"><label class="MuestraCampoRequerido"> * </label>
	</td>
</tr>
<tr>
	<td height="18"  align="right"  >DNI Paciente:</td>
	<td valign="middle" >
		<input name="TxtDNIP"  type="text"  class="TextBox"  style="width:250px" maxlength="20" tabindex="1"  value="<? echo $_SESSION['TxtDNIP'];?>">
	</td>
</tr>
<tr>
	<td height="18" align="right">Nombre del Puesto:</td>
	<td valign="middle">
		<input name="TxtPuesto" type="text" class="TextBox" style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtPuesto'];?>"><label class="MuestraCampoRequerido"> * </label>
	</td>
</tr>
<tr>
	<td height="18" align="right"  >Observaciones del Puesto:</td>
	<td valign="middle" >
		<input name="TxtObsPuesto" type="text" class="TextBox" style="width:450px" maxlength="50" tabindex="1" value="<? echo $_SESSION['TxtObsPuesto'];?>">
	</td>
</tr>
<tr>
	<td height="18" align="right">Tipo de Examen:</td>
	<td  valign="middle" >
		<select name="CbIdTipoEx" style="width:250px" class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("tipoexamen","CbIdTipoEx","Id","","",$conn); ?></select><label class="MuestraCampoRequerido"> * </label>
	</td>
</tr>
<tr>
	<td height="18"  align="right">Si es otro aclarar:</td>
	<td  valign="middle">
		<input name="TxtObsTipo" type="text" class="TextBox" style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtObsTipo'];?>">
	</td>
</tr>
<tr>
	<td height="18" align="right" valign="top">Detalle (estudios incluidos):</td>
	<td valign="middle" >
		<textarea name="TxtDetalle" style="width:450px" rows="5" class="TextBox" onKeyPress="event.cancelBubble=true;" tabindex="1"><? echo $_SESSION['TxtDetalle']; ?></textarea><label class="MuestraCampoRequerido" style="vertical-align:top"> * </label>
</td>
</tr>
</table>


<!--generales-->
<table  border="0"  cellpadding="0" cellspacing="0">
	<tr>
		<td height="5"></td>
	</tr>
</table>

<table width="900" border="0" cellspacing="0" class="Tabla">
<tr>
	<td width="250" height="18" align="right" valign="middle">Observaciones generales:</td>
	<td width="650" valign="middle">
		<textarea name="TxtObs" style="width:450px" rows="1" class="TextBox" onKeyPress="event.cancelBubble=true;" tabindex="1"><? echo $_SESSION['TxtObs']; ?></textarea>
	</td>
</tr>
<tr>
	<td height="18" align="right">Envi&oacute; email a turnos@cmit.com.ar ampliando el pedido?:</td>
	<td  valign="middle" >
		<input name="OptEnvioMail" type="radio" class="radiob" tabindex="1" value="SI"<? if ($_SESSION['OptEnvioMail'] =='SI') echo 'checked'; ?> >Si   <input name="OptEnvioMail"  type="radio"  class="radiob" tabindex="1"  value="NO"<? if ($_SESSION['OptEnvioMail'] =='NO') echo 'checked'; ?> >No   
	</td>
</tr>
</table>


<!--pago-->
<table  border="0"  cellpadding="0" cellspacing="0">
	<tr>
		<td height="5"></td>
	</tr>
</table>

<table width="900" border="0"  cellspacing="0" class="Tabla" >

<!--

<tr>
	<td width="250" height="18" align="right" valign="middle">Forma de Pago:</td>
	<td width="300" valign="middle">
		<input name="OptFPago1" type="radio" class="radiob" value="0" <? if ($_SESSION['OptFPago1'] ==0) echo 'checked'; ?> >Contado anticipado al envio del paciente
	</td>
	<td width="350">
		<select name="OptFPago2" style="width:290px" class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("turnosdetalle","OptFPago2","Id","","",$conn); ?></select><label class="MuestraCampoRequerido"> * </label>
	</td>
</tr>

-->

<? 
echo '<tr> <td height="2"></td></tr>';
echo '<tr><td width="250" height="18" align="right" valign="middle">Forma de Pago:</td>';
echo '<td width="300" valign="middle">&nbsp;<input name="OptFPago1" type="radio" class="radiob" value="1"'; if ($_SESSION['OptFPago1']==0 OR $_SESSION['OptFPago1']==1) echo 'checked';
echo'>Cuenta Corriente</td><td></td></tr>';
echo '<tr><td height="2"></td></tr>';
 ?>
</table>


<!--condiciones-->
<table  border="0"  cellpadding="0" cellspacing="0">
	<tr>
		<td height="5"></td>
	</tr>
</table>

<table width="900" border="0" cellspacing="0" class="Tabla" >
	<tr>
		<td width="250" height="18" align="right" valign="middle" >Condiciones:</td>
		<td width="650" valign="middle" >
			<textarea name="TxtCond" style="width:590px" rows="1" onKeyPress="event.cancelBubble=true;" readonly="true"  class="TextBoxRO"><? echo $_SESSION['TxtCond']; ?></textarea>
		</td>
	</tr>
	<tr>
		<td height="18" align="right" valign="middle"></td>
		<td valign="middle">
			<input name="ChkAc" type="checkbox" disabled value="1" <? if ($_SESSION['ChkAc'] =='1') echo 'checked'; ?>> Acepto
		</td>
	</tr>
</table>


<!--botones-->
<table  border="0"  cellpadding="0" cellspacing="0">
	<tr>
		<td height="5"></td>
	</tr>
</table>

