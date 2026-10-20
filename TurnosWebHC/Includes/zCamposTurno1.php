<? GLO_mensajeerror(); ?>

<!--turno--> 
<table width="700" border="0"  cellspacing="0" class="Tabla TMT" >
<tr> <td width="150" height="3"  ></td><td width="50" height="3"  ></td> <td width="500"></td> </tr>
<tr><td  height="18" >&nbsp;<label class="comentario3" style="color:#4285F4;"><? echo $_SESSION['TxtSTurno']; ?></label> </td><td align="right"  >Turno:</td><td  valign="top" >&nbsp; <input  name="TxtNumero" type="text"  readonly="true"  class="TextBoxRO"   value="<? echo $_SESSION['TxtNumero'];?>" style="text-align:right;width:50px">&nbsp;<input  name="TxtFecha" type="text"  readonly="true"  class="TextBoxRO" style="width:90px"  value="<? echo $_SESSION['TxtFecha'];?>" >  <input  name="TxtHora" type="text"  readonly="true"  class="TextBoxRO" style="width:50px"  value="<? echo $_SESSION['TxtHora'];?>" >&nbsp; <label class="comentario3"  style="font-weight:normal;"><? echo $_SESSION['TxtDiasFaltantes']; ?></label></td></tr>
</table>
<? GLO_Hidden('TxtIdAgenda',0);GLO_Hidden('TxtIdUsuario',0);GLO_Hidden('TxtFPago',0); ?>
<? GLO_Hidden('OptEnvioMail',0);GLO_Hidden('OptFPago1',0);GLO_Hidden('OptFPago2',0);GLO_Hidden('TxtCond',0); GLO_Hidden('ChkAc',0);   ?>


