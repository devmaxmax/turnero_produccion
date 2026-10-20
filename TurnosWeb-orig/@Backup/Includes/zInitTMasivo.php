<? 
//variables
$varagenda=1;
//hora inicio lunes a viernes
$hora='07:50';
//dias que muestra el calendario
$hoy=date("d-m-Y");if($idconsulta==2){$fechainicial=date("d-m-Y", strtotime("$hoy +14 day"));}else{$fechainicial=$hoy;}	


$idturno=1;//para q el check reconozca varios registros con misma fecha y hora
$clicksig="'Si cambia de semana perderá los datos seleccionados'";

//Titulos de la tabla
$tablaclientes="";
$tablaclientes .='<table width="910" border="0" cellspacing="0" cellpadding="0" class="Tabla" >';
$tablaclientes .='<tr><td style="text-align:left;font-size:12px;font-weight:bold;color:#45302C;background-color:#9ab7c1;" height="20" width="610">&nbsp;Ingrese los datos de la Empresa, seleccione los Turnos y Grabe</td>';
$tablaclientes .='<td style="text-align:right;font-size:14px;font-weight:bold;color:#45302C;background-color:#9ab7c1;" height="20" width="300">';
if($idconsulta==2){$tablaclientes .='<input name="CmdAnterior" type="submit" class="botonsig"   value="Anterior" onClick="return confirm('.$clicksig.');">';}
else{$tablaclientes .='<input name="CmdSiguiente" type="submit" class="botonsig"   value="Siguiente" onClick="return confirm('.$clicksig.');">';}
$tablaclientes .='</td></tr></table>';
$tablaclientes .='<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="2"></td></tr></table>';	
$tablaclientes .="<table width="."910"." border="."0"." cellspacing="."0"." cellpadding="."0"." ><tr> ";

//limpio variable turnos disp por dia
for ($i=1; $i <=14; $i= $i +1) {${'turnosdispdiario'.$i}=0;}
//limpio variable sobreturnos disp por dia
for ($i=1; $i <=14; $i= $i +1) {${'sturnosdispdiario'.$i}=0;}

//completa dia x dia
$fecha=$fechainicial;

?>