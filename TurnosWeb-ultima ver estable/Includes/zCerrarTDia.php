<? 
//cerrar tabla
$tablaclientes .="</table>"; 
$tablaclientes .='<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="10"></td></tr></table>';	
$tablaclientes .="<table width="."1120"." border="."0"." cellspacing="."0"." cellpadding="."0"." class="."fondo"." >";
//leyenda turnos disponibles por dia
$tablaclientes .='<tr>';

	$tablaclientes .="<td class="."TablaTituloLeft"." style='width:1px;'> </td>"; 
	$tablaclientes .="<td style='text-align:center;color: #666666;width:120px;'>"; 	
	$tablaclientes .=${'turnosdispdiario'.$i};
	
$tablaclientes .="<td class="."TablaMostrarRight"." style='width:1000px; text-align:center; color: #666666'>Turnos disponibles</td></tr>";  
//leyenda sobreturnos disponibles por dia
$tablaclientes .='<tr>';

	$tablaclientes .="<td class="."TablaTituloLeft"." style='width:1px;'> </td>"; 
	$tablaclientes .="<td style='text-align:center;color: #666666;width:120px'>"; 	
	$tablaclientes .=${'sturnosdispdiario'.$i};

$tablaclientes .="<td class="."TablaMostrarRight"." style='text-align:center; color: #666666'> Sobreturnos disponibles</td></tr>";  
//muestro
$tablaclientes .='</table>';  
echo $tablaclientes;
?>