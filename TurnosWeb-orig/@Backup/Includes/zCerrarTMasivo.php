<? 
//cerrar tabla
$tablaclientes .="</table>"; 
$tablaclientes .='<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="2"></td></tr></table>';	
$tablaclientes .="<table width="."925"." border="."0"." cellspacing="."0"." cellpadding="."0"." class="."fondo"." >";
//leyenda turnos disponibles por dia
$tablaclientes .='<tr>';
for ($i=1; $i <=14; $i= $i +1) {
	$tablaclientes .="<td class="."TablaTituloLeft"." style='width:1px;'> </td>"; 
	$tablaclientes .="<td style='text-align:center;color: #666666;width:65px;'>"; 	
	$tablaclientes .=${'turnosdispdiario'.$i}.' turnos';
}	
$tablaclientes .="<td class="."TablaMostrarRight"." style='width:1px;'> </td></tr>";  
//leyenda sobreturnos disponibles por dia
$tablaclientes .='<tr>';
for ($i=1; $i <=14; $i= $i +1) {
	$tablaclientes .="<td class="."TablaTituloLeft"." style='width:1px;'> </td>"; 
	$tablaclientes .="<td style='text-align:center;color: #666666;width:65px;'>"; 	
	$tablaclientes .=${'sturnosdispdiario'.$i}.' sobret';
}	
$tablaclientes .="<td class="."TablaMostrarRight"." style='width:1px;'> </td></tr>";  
//muestro
$tablaclientes .='</table>';  
echo $tablaclientes;
?>