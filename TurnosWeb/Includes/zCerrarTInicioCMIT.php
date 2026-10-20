<? 
//cerrar tabla
$tablaclientes .="</table>"; 
$tablaclientes .='<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="2"></td></tr></table>';	
$tablaclientes .="<table width="."1120"." border="."0"." cellspacing="."0"." cellpadding="."0"." class="."fondo"." > ";
//leyenda turnos disponibles por dia
$tablaclientes .='<tr>';
for ($i=1; $i <=14; $i= $i +1) {
	$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
	$tablaclientes .="<td "."width="."80"." style='text-align:center;color: #666666; padding:5px 0px 0px 0px'>"; 	
	$tablaclientes .=${'turnosdispdiario'.$i}.' Turnos';
}	
$tablaclientes .='<td class="TablaMostrarRight."> </td></tr>';  
//leyenda sobreturnos disponibles por dia
$tablaclientes .='<tr>';
for ($i=1; $i <=14; $i= $i +1) {
	$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
	$tablaclientes .="<td "."width="."80"." style='text-align:center;color: #666666; padding:5px 0px 5px 0px'>"; 	
	$tablaclientes .=${'sturnosdispdiario'.$i}.' Sobret';
}	
$tablaclientes .='<td class="TablaMostrarRight."> </td></tr>';  
//muestro
$tablaclientes .='</table></td></tr></table>';  
echo $tablaclientes;
?>