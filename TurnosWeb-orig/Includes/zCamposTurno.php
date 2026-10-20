<? GLO_mensajeerror(); ?>

<!--turno--> 
<table width="700" border="0"  cellspacing="0" class="Tabla TMT" >
<tr> <td width="150" height="3"  ></td><td width="50" height="3"  ></td> <td width="500"></td> </tr>
<tr><td  height="18" >&nbsp;<label class="comentario3" style="color:#4285F4;"><? echo $_SESSION['TxtSTurno']; ?></label> </td><td align="right"  >Turno:</td><td  valign="top" >&nbsp; <input  name="TxtNumero" type="text"  readonly="true"  class="TextBoxRO"   value="<? echo $_SESSION['TxtNumero'];?>" style="text-align:right;width:50px">&nbsp;<input  name="TxtFecha" type="text"  readonly="true"  class="TextBoxRO" style="width:90px"  value="<? echo $_SESSION['TxtFecha'];?>" >  <input  name="TxtHora" type="text"  readonly="true"  class="TextBoxRO" style="width:50px"  value="<? echo $_SESSION['TxtHora'];?>" >&nbsp; <label class="comentario3"  style="font-weight:normal;"><? echo $_SESSION['TxtDiasFaltantes']; ?></label></td></tr>
</table>



<? GLO_Hidden('TxtIdAgenda',0);GLO_Hidden('TxtIdUsuario',0);GLO_Hidden('TxtFPago',0); ?>

<!--cliente-->   
  
<table width="700" border="0"   cellspacing="0" class="Tabla TMT" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  >Raz&oacute;n Social:</td><td  valign="top" >&nbsp; <select name="CbIdRSF" style="width:450px" class="campos" tabindex="1"><? ComboLocalRSF("CbIdRSF",$conn); ?></select><label class="MuestraCampoRequerido"> * </label> </td></tr>
<tr><td height="18"  align="right"  >Facturar A:</td><td  valign="top" >&nbsp; <select name="CbIdEntidad" style="width:250px; " class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("entidades","CbIdEntidad","Nombre","","",$conn); ?></select><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr><td height="18"  align="right"  >ART que lo env&iacute;a:</td><td  valign="top" >&nbsp; <input name="TxtART"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtART'];?>"> </td></tr>
</table>


<!--estudios-->
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	

<table width="700" border="0"   cellspacing="0" class="Tabla" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  >Apellido y Nombre del Paciente:</td><td  valign="top" >&nbsp; <input name="TxtPaciente"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtPaciente'];?>"><label class="MuestraCampoRequerido"> * </label> </td></tr>
<tr><td height="18"  align="right"  >DNI Paciente:</td><td  valign="top" >&nbsp; <input name="TxtDNIP"  type="text"  class="TextBox"  style="width:250px" maxlength="20" tabindex="1"  value="<? echo $_SESSION['TxtDNIP'];?>"> </td></tr>
<tr><td height="18"  align="right"  >Nombre del Puesto:</td><td  valign="top" >&nbsp; <input name="TxtPuesto"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtPuesto'];?>"><label class="MuestraCampoRequerido"> * </label> </td></tr>
<tr><td height="18"  align="right"  >Observaciones del Puesto:</td><td  valign="top" >&nbsp; <input name="TxtObsPuesto"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtObsPuesto'];?>"> </td></tr>
<tr><td height="18"  align="right"  >Tipo de Examen:</td><td  valign="top" >&nbsp; <select name="CbIdTipoEx" style="width:250px" class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("tipoexamen","CbIdTipoEx","Id","","",$conn); ?></select><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr><td height="18"  align="right"  >Si es otro aclarar:</td><td  valign="top" >&nbsp; <input name="TxtObsTipo"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtObsTipo'];?>"> </td></tr>
<tr><td height="18"  align="right"  valign="top" >Detalle (estudios incluidos):</td><td  valign="top" >&nbsp; <textarea name="TxtDetalle" style="width:450px" rows="5" class="TextBox" onKeyPress="event.cancelBubble=true;" tabindex="1"><? echo $_SESSION['TxtDetalle']; ?></textarea><label class="MuestraCampoRequerido" style="vertical-align:top"> * </label></td></tr>
</table>


<!--generales-->
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	

<table width="700" border="0"   cellspacing="0" class="Tabla" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  valign="top" >Observaciones generales:</td><td  valign="top" >&nbsp; <textarea name="TxtObs" style="width:450px" rows="1" class="TextBox" onKeyPress="event.cancelBubble=true;" tabindex="1"><? echo $_SESSION['TxtObs']; ?></textarea></td></tr>
<tr><td height="18"  align="right"  >Envi&oacute; email a turnos@cmit.com.ar ampliando el pedido?:</td><td  valign="top" >&nbsp; <input name="OptEnvioMail"  type="radio"  class="radiob"  tabindex="1"  value="SI"<? if ($_SESSION['OptEnvioMail'] =='SI') echo 'checked'; ?> >Si   <input name="OptEnvioMail"  type="radio"  class="radiob" tabindex="1"  value="NO"<? if ($_SESSION['OptEnvioMail'] =='NO') echo 'checked'; ?> >No   </td></tr>
</table>


<!--pago-->
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	

<table width="700" border="0"  cellspacing="0" class="Tabla" >
<tr> <td width="200" height="3"  ></td> <td width="250"></td><td width="250"></td> </tr>
<tr><td height="18"  align="right"   valign="middle">Forma de Pago:</td><td  valign="top" >&nbsp;<input name="OptFPago1"  type="radio"  class="radiob"    value="0" <? if ($_SESSION['OptFPago1'] ==0) echo 'checked'; ?> >Contado anticipado al envio del paciente</td><td><select name="OptFPago2" style="width:200px" class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("turnosdetalle","OptFPago2","Id","","",$conn); ?></select><label class="MuestraCampoRequerido"> * </label></td></tr>
<? if ($_SESSION['TxtFPago'] ==1){
echo '<tr> <td height="2"></td></tr>';
echo '<tr><td height="18"  align="right"  valign="top" ></td><td  valign="top" >&nbsp;<input name="OptFPago1" type="radio"  class="radiob"   value="1"'; if ($_SESSION['OptFPago1']==1) echo 'checked';echo'>Cuenta Corriente</td><td></td></tr>';
} ?>
</table>


<!--condiciones-->
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	

<table width="700" border="0"   cellspacing="0" class="Tabla" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  valign="top" >Condiciones:</td><td  valign="top" >&nbsp; <textarea name="TxtCond" style="width:450px" rows="1" onKeyPress="event.cancelBubble=true;" readonly="true"  class="TextBoxRO"><? echo $_SESSION['TxtCond']; ?></textarea></td></tr>
<tr><td height="18"  align="right"  valign="top" ></td><td  valign="top" >&nbsp;<input name="ChkAc"  type="checkbox" disabled value="1" <? if ($_SESSION['ChkAc'] =='1') echo 'checked'; ?>> Acepto</td></tr>
</table>


<!--botones-->
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	

