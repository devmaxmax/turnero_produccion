<? 
//variables
$varagenda=1;
//hora inicio lunes a viernes
$hora='07:50';
//dias que muestra el calendario
$hoy=date("d-m-Y");if($idconsulta==2){$fechainicial=date("d-m-Y", strtotime("$hoy +14 day"));}else{$fechainicial=$hoy;}	


//Titulos de la tabla
$tablaclientes="";
$tablaclientes .='<table width="910" border="0"  cellpadding="0" cellspacing="0"  align="center" class="fondo"><tr> <td align="center"><table width="910" border="0" cellspacing="0" cellpadding="0" class="Tabla" >';
$tablaclientes .='<tr><td style="text-align:left;font-size:14px;font-weight:bold;color:#45302C;background-color:#9ab7c1;" height="20" width="610">&nbsp;Seleccione un Turno</td>';
$tablaclientes .='<td style="text-align:right;font-size:14px;font-weight:bold;color:#45302C;background-color:#9ab7c1;" height="20" width="300">';
if($idconsulta==2){$tablaclientes .='<input name="CmdAnterior" type="submit" class="botonsig"   value="Anterior" >';}
else{$tablaclientes .='<input name="CmdSiguiente" type="submit" class="botonsig"   value="Siguiente" >';}
$tablaclientes .='</td></tr></table>';
$tablaclientes .='<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="2"></td></tr></table>';	  
$tablaclientes .="<table width="."910"." border="."0"." cellspacing="."0"." cellpadding="."0"." ><tr> ";

//titulos columnas dias de la semana
$fecha=$fechainicial;
for ($i=1; $i <=14; $i= $i +1) {
	$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
	//resalta dia de hoy
	if( CompararFechas(date("d-m-Y"),$fecha)!=0)
	{$tablaclientes .="<td "."width="."65"." class="."TablaTituloDato"." style='text-align:center;'>"; }
	else{$tablaclientes .="<td "."width="."65"." class="."TablaTituloDato"." style='text-align:center;border:1px solid #f44336;background:#c9d9de;'>"; }	
	$tablaclientes .=ObtenerDiaSemanaCorto($fecha).' '.date("d-m",strtotime("$fecha"))."</td>";
	$fecha=date("d-m-Y", strtotime("$fecha +1 day"));
}	
$tablaclientes .="<td class="."TablaTituloRight"."> </td></tr>";  


//limpio variable turnos disp por dia
for ($i=1; $i <=14; $i= $i +1) {${'turnosdispdiario'.$i}=0;}
//limpio variable sobreturnos disp por dia
for ($i=1; $i <=14; $i= $i +1) {${'sturnosdispdiario'.$i}=0;}
?>