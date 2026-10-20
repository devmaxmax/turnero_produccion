<? 
//variables
$varagenda=1;
//hora inicio lunes a viernes
$hora=GLO_horainicioLV();	
//dias que muestra el calendario
$hoy=date("d-m-Y");if($idconsulta==2){$fechainicial=date("d-m-Y", strtotime("$hoy +14 day"));}else{$fechainicial=$hoy;}	


$idturno=1;//para q el check reconozca varios registros con misma fecha y hora
$clicksig="'Si cambia de semana perdera los datos seleccionados'";

//Titulos de la tabla
$tablaclientes="";
$tablaclientes .='<table width="1120" border="0" cellspacing="0" cellpadding="0">';
$tablaclientes .='<tr><td height="20"></td><td></td></tr>';
$tablaclientes .='<tr><td class="tituloturnos" height="20" width="820">Ingrese los datos de la Empresa, seleccione los Turnos y Grabe</td>';
$tablaclientes .='<td style="text-align:right;" height="20" width="300">';
if($idconsulta==2){$tablaclientes .='<button name="CmdAnterior" type="submit" class="btn btn-prest4" value="Anterior" onClick="return confirm('.$clicksig.');"><i class="fa fa-angle-left"></i> Anterior</button>';}
else{$tablaclientes .='<button name="CmdSiguiente" type="submit" class="btn btn-prest3" value="Siguiente" onClick="return confirm('.$clicksig.');">Siguiente <i class="fa fa-angle-right"></i></button>';}
$tablaclientes .='</td></tr></table>';
$tablaclientes .='<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="10"></td></tr></table>';	
$tablaclientes .="<table width="."1120"." border="."0"." cellspacing="."0"." cellpadding="."0"." ><tr> ";

//limpio variable turnos disp por dia
for ($i=1; $i <=14; $i= $i +1) {${'turnosdispdiario'.$i}=0;}
//limpio variable sobreturnos disp por dia
for ($i=1; $i <=14; $i= $i +1) {${'sturnosdispdiario'.$i}=0;}

//completa dia x dia
$fecha=$fechainicial;

?>