<? if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}
?>
<td></td><td colspan="2"> &nbsp; 
<input name="ChkHT"  type="checkbox"  value="1" <? if ($_SESSION['ChkHT'] ==1) {echo 'checked';}?>
<? 
$hoy=date("d-m-Y"); 
echo ' onClick="if (this.checked==true){document.Formulario.TxtDias.value=3;document.Formulario.TxtFechaSA.value='."'$hoy'".';}';
echo ' else{document.Formulario.TxtDias.value=0;document.Formulario.TxtFechaSA.value='."''".';}"';
?>
> Habilitado Temporalmente <input name="TxtDias" type="text" class="TextBox"   maxlength="2" value="<? echo $_SESSION['TxtDias']; ?>" onChange="this.value=validarEntero(this.value);" style="text-align:right;width:30px"> dias desde <? GLO_calendario("TxtFechaSA","../Codigo/","actual",3); if($_SESSION['TxtFechaSAF']!=''){echo ' hasta '.$_SESSION['TxtFechaSAF'].' incluido';} ?> </td></tr>

