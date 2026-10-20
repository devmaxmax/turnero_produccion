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
</table>
<? GLO_Hidden('CbIdEntidad',0);GLO_Hidden('TxtART',0); ?>


<!--estudios-->
<table width="700" border="0"   cellspacing="0" class="Tabla TMT" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  >Apellido y Nombre del Paciente:</td><td  valign="top" >&nbsp; <input name="TxtPaciente"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtPaciente'];?>"><label class="MuestraCampoRequerido"> * </label> </td></tr>
<tr><td height="18"  align="right"  >DNI Paciente:</td><td  valign="top" >&nbsp; <input name="TxtDNIP"  type="text"  class="TextBox"  style="width:250px" maxlength="20" tabindex="1"  value="<? echo $_SESSION['TxtDNIP'];?>"> </td></tr>
</table>
<? GLO_Hidden('TxtPuesto',0);GLO_Hidden('TxtObsPuesto',0);GLO_Hidden('TxtObsTipo',0);GLO_Hidden('TxtDetalle',0); ?>


<!--examenes-->
<table width="700" border="0"   cellspacing="0" class="Tabla TMT" >
<tr> <td width="200" height="3"  ></td> <td width="457"></td> <td width="43"></td></tr>
<tr><td height="18"  align="right"  valign="top" >Detalle:</td><td  valign="top" >&nbsp;<input name="ChkE1"  type="checkbox" class="check" value="1" <? if ($_SESSION['ChkE1'] =='1') echo 'checked'; ?>> PCR COVID 19</td><td><label class="MuestraCampoRequerido"> * </label> </td></tr>
<tr><td height="18"  align="right"  valign="top" ></td><td  valign="top" colspan="2">&nbsp;<input name="ChkE2"  type="checkbox" class="check" value="1" <? if ($_SESSION['ChkE2'] =='1') echo 'checked'; ?>> TEST RAPIDO ANTIGENO COVID 19</td></tr>
<tr><td height="18"  align="right"  valign="top" ></td><td  valign="top" colspan="2">&nbsp;</td></tr>

<tr><td height="18"  align="right"  valign="top" ></td><td  valign="top" colspan="2">&nbsp;<input name="ChkE3"  type="checkbox" class="check" value="1" <? if ($_SESSION['ChkE3'] =='1') echo 'checked'; ?>> TEST RAPIDO ANTICUERPOS COVID 19</td></tr>
<tr><td height="18"  align="right"  valign="top" ></td><td  valign="top" colspan="2">&nbsp;<input name="ChkE4"  type="checkbox" class="check" value="1" <? if ($_SESSION['ChkE4'] =='1') echo 'checked'; ?>> ELISA ANTICUERPOS IGG</td></tr>
<tr><td height="18"  align="right"  valign="top" ></td><td  valign="top" >&nbsp;<input name="ChkE5"  type="checkbox" class="check" value="1" <? if ($_SESSION['ChkE5'] =='1') echo 'checked'; ?>> ELISA ANTICUERPOS IGM</td></tr>
</table>



<!--generales-->
<table width="700" border="0"   cellspacing="0" class="Tabla TMT" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  valign="top" >Observaciones generales:</td><td  valign="top" >&nbsp; <textarea name="TxtObs" style="width:450px" rows="2" class="TextBox" onKeyPress="event.cancelBubble=true;" tabindex="1"><? echo $_SESSION['TxtObs']; ?></textarea></td></tr>
</table>
<? GLO_Hidden('OptEnvioMail',0);GLO_Hidden('OptFPago1',0);GLO_Hidden('OptFPago2',0);GLO_Hidden('TxtCond',0); GLO_Hidden('ChkAc',0);   ?>


<!--botones-->
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	

