<? 
//variables
$varagenda=1;
//hora inicio lunes a viernes
$hora=GLO_horainicioLV();
//dias que muestra el calendario
$hoy=date("d-m-Y");if($idconsulta==2){$fechainicial=date("d-m-Y", strtotime("$hoy +14 day"));}else{$fechainicial=$hoy;}	


//Titulos de la tabla
$tablaclientes="";
$tablaclientes .='<table width="1120" border="0"  cellpadding="0" cellspacing="0"  align="center" class="fondo"><tr> <td align="center"><table width="1120" border="0" cellspacing="0" cellpadding="0" >';
$tablaclientes .='<tr><td class="tituloturnos" height="20" width="125">Turno Disponible</td>';
$tablaclientes .='<td class="tituloturnos" height="20" width="50"><div class="box-free"></div></td>';
$tablaclientes .='<td class="tituloturnos" height="20" width="110">Turno Ocupado</td>';
$tablaclientes .='<td class="tituloturnos" height="20" width="50"><div class="box-ofree"></div></td>';
$tablaclientes .='<td class="tituloturnos" height="20" width="90">Sobreturno</td>';
$tablaclientes .='<td class="tituloturnos" height="20" width="50"><div class="box-sfree"></div></td>';
$tablaclientes .='<td class="tituloturnos" height="20" width="110">D&iacute;as inh&aacute;biles</td>';
$tablaclientes .='<td class="tituloturnos" height="20" width="50"><div class="box-nofree"></div></td>';
$tablaclientes .='<td style="text-align:right; height="20" width="185"></td>';
$tablaclientes .='<td style="text-align:right;" height="20" width="300">';
if($idconsulta==2){$tablaclientes .='<button name="CmdAnterior" type="submit" class="btn btn-prest4" value="Anterior"><i class="fa fa-angle-left"></i> Anterior</button>';}
else{$tablaclientes .='<button name="CmdSiguiente" type="submit" class="btn btn-prest3" value="Siguiente">Siguiente <i class="fa fa-angle-right"></i></button>';}
$tablaclientes .='</td></tr></table>';
$tablaclientes .='<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="10"></td></tr></table>';	  
$tablaclientes .="<table width="."1120"." border="."0"." cellspacing="."0"." cellpadding="."0"." ><tr> ";

//titulos columnas dias de la semana
$fecha=$fechainicial;
for ($i=1; $i <=14; $i= $i +1) {
	$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
	//resalta dia de hoy
	if( CompararFechas(date("d-m-Y"),$fecha)!=0) {

		$tablaclientes .="<td "."width="."80"." class="."TablaTituloDato"." style='text-align:center; color:#000!important'>";

	} else {

		$tablaclientes .="<td "."width="."80"." class="."TablaTituloDato"." style='text-align:center; border:1px solid #808080; background:#808080; color:#ffffff!important'>";
	}

		if (($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2 or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10) ) {	
			$tablaclientes .=ObtenerDiaSemana($fecha).'<br/> '.date("d-m",strtotime("$fecha"))." <br/> <a href='ConsultaCMIT.php?fechad=".$fecha."' class='boton_microt'>Turnos</a> <br/> <a href='DiaCMITL.php?fechad=".$fecha."' class='boton_microm'>Masivo</a></td>";
		} else {
			$tablaclientes .=ObtenerDiaSemana($fecha).'<br/> '.date("d-m",strtotime("$fecha"))."</td>";
		}

	$fecha=date("d-m-Y", strtotime("$fecha +1 day"));
}	
$tablaclientes .="<td class="."TablaTituloRight"."> </td></tr>";  


//limpio variable turnos disp por dia
for ($i=1; $i <=14; $i= $i +1) {${'turnosdispdiario'.$i}=0;}
//limpio variable sobreturnos disp por dia
for ($i=1; $i <=14; $i= $i +1) {${'sturnosdispdiario'.$i}=0;}
?>