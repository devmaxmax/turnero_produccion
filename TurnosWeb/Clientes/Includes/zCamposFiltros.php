<? if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}
?>
<table width="700" border="0"  cellspacing="0" class="Tabla">
	<tr>
		<td height="18" align="right">Empresa:</td>
		<td colspan="2"><input name="TxtBusqueda" type="text" class="TextBox" style="width:200px" maxlength="20" onKeyDown="enterxtab(event)"></td>
		<td height="18" align="right"></td>
		<td colspan="2"><input name="ChkBloq" type="checkbox" value="1"> Bloqueados</td>
		<td><input name="ChkR" type="checkbox" value="1" <? if ($_SESSION['ChkR'] =='1') echo 'checked'; ?>> Cliente de Riesgo</td>
	</tr>
	<tr>
		<td height="18" align="right">Usuario:</td>
		<td colspan="2"><input name="TxtBusquedaU" type="text" class="TextBox" style="width:200px" maxlength="20" onKeyDown="enterxtab(event)"></td>
		<td height="18" align="right"></td>
		<td colspan="2"><input name="ChkBloqAA" type="checkbox"  value="1" > Bloq. por Alta Usuario</td>
		<td><input name="ChkSA" type="checkbox" value="1" <? if ($_SESSION['ChkSA'] =='1') echo 'checked'; ?>> Sin Alta de Turnos</td>
	</tr>
	<tr>
		<td height="18" align="right">F. Pago:</td>
		<td colspan="2"><select name="CbFP" class="campos" id="CbEstado" style="width:200px" onKeyDown="enterxtab(event)"><? GLO_ComboFPago(); ?></select></td>
		<td height="18" align="right"></td>
		<td colspan="2">&nbsp;</td>
		<td align="center"></td>
	</tr>
	<tr>
		<td height="18" align="right"></td>
		<td colspan="2">&nbsp;</td>
		<td height="30" align="right"></td>
		<td colspan="2">&nbsp;</td>
		<td align="center"><? GLOF_Search('CmdBuscar',0); ?></td>
	</tr>
</table>