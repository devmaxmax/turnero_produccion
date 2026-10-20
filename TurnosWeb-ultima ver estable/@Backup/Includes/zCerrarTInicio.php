<? 
//cerrar tabla
$tablaclientes .="</table>"; 
$tablaclientes .='<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="2"></td></tr></table>';	
$tablaclientes .="<table width="."910"." border="."0"." cellspacing="."0"." cellpadding="."0"." class="."fondo"." ><tr> ";
//leyenda turnos disponibles por dia
for ($i=1; $i <=14; $i= $i +1) {
	$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
	$tablaclientes .="<td "."width="."65"." style='text-align:center;color: #666666;'>"; 	
	$tablaclientes .=${'turnosdispdiario'.$i}.' turnos';
}	
$tablaclientes .='<td class="TablaMostrarRight."> </td></tr></table></td></tr></table>';  
//muestro
echo $tablaclientes;
?>