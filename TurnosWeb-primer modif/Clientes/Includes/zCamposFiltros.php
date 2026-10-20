<? if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}
?>
<table width="650" border="0"  cellspacing="0" class="Tabla">
	<tr>
		<td height="5" width="70"></td>
		<td width="100"></td>
		<td width="110"></td>
		<td width="20"></td>
		<td width="170"></td>
		<td width="10"></td>
		<td width="170"></td>
	</tr>
	<tr>
		<td height="18" align="right">Empresa:</td>
		<td colspan="2">&nbsp;<input name="TxtBusqueda" type="text" class="TextBox" style="width:170px" maxlength="20" onKeyDown="enterxtab(event)"></td>
		<td height="18" align="right"></td>
		<td colspan="2"><input name="ChkBloq" type="checkbox" value="1"> Bloqueados</td>
		<td><input name="ChkR" type="checkbox" value="1" <? if ($_SESSION['ChkR'] =='1') echo 'checked'; ?>> Cliente de Riesgo</td>
	</tr>
	<tr>
		<td height="18" align="right">Usuario:</td>
		<td colspan="2">&nbsp;<input name="TxtBusquedaU" type="text" class="TextBox" style="width:170px" maxlength="20" onKeyDown="enterxtab(event)"></td>
		<td height="18" align="right"></td>
		<td colspan="2"><input name="ChkBloqAA" type="checkbox"  value="1" > Bloq. por Alta Usuario</td>
		<td><input name="ChkSA" type="checkbox" value="1" <? if ($_SESSION['ChkSA'] =='1') echo 'checked'; ?>> Sin Alta de Turnos</td>
	</tr>
	<tr>
		<td height="18" align="right">F.Pago:</td>
		<td colspan="2">&nbsp;<select name="CbFP" class="campos" id="CbEstado" style="width:170px" onKeyDown="enterxtab(event)"><? GLO_ComboFPago(); ?></select></td>
		<td height="18" align="right"></td>
		<td colspan="2">&nbsp;</td>
		<td align="center"></td>
	</tr>
	<tr>
		<td height="18" align="right"></td>
		<td colspan="2">&nbsp;</td>
		<td height="30" align="right"></td>
		<td colspan="2">&nbsp;</td>
		<td align="left"><? GLOF_Search('CmdBuscar',0); ?>&nbsp;</td>
	</tr>
</table>