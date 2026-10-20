
<!--estudios-->
<table width="700" border="0"   cellspacing="0" class="Tabla TMT" >
<tr> <td width="200" height="3"  ></td> <td width="500"></td> </tr>
<tr><td height="18"  align="right"  >Apellido y Nombre del Paciente:</td><td  valign="top" >&nbsp; <input name="TxtPaciente"  type="text"  class="TextBox"  style="width:450px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtPaciente'];?>"><? if($_SESSION['TxtCmit']==0){echo '<label class="MuestraCampoRequerido"> * </label>';} ?> </td></tr>

<tr><td height="18"  align="right"  >DNI Paciente:</td><td  valign="top" >&nbsp; <input name="TxtDNIP"  type="text"  class="TextBox"  style="width:250px" maxlength="20" tabindex="1"  value="<? echo $_SESSION['TxtDNIP'];?>"> </td></tr>
</table>


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
