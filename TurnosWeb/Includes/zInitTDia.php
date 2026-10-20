<? 
//variables
$varagenda=1;
//hora inicio lunes a viernes
$hora=GLO_horainicioLV();	
//dias que muestra el calendario

if( $_POST['fechad'] != "" )
{
	$hoyy = $_POST['fechad'];
	$_SESSION["diadehoy"] = $hoyy;

} elseif ( $_GET['fechad'] != "" ) {
	$hoyy = $_GET['fechad'];
	$_SESSION["diadehoy"] = $hoyy;
}

$hoy_rw = $_SESSION["diadehoy"];

// $hoy= "03-08-2023";

if($idconsulta==2) {
	$fechainicial=date("d-m-Y", strtotime("$hoy_rw +14 day"));
} else {
	$fechainicial=$hoy_rw;
}	




$idturno=1;//para q el check reconozca varios registros con misma fecha y hora
$clicksig="'Si cambia de semana perdera los datos seleccionados'";

//Titulos de la tabla
$tablaclientes="";
$tablaclientes .='<table width="1120" border="0" cellspacing="0" cellpadding="0">';
$tablaclientes .='<tr><td height="20"></td><td></td></tr>';
$tablaclientes .='<tr><td class="tituloturnos" height="20" width="720"><div class="amxTitulo"><i class="fa fas fa-calendar-alt"></i>'.ObtenerDiaSemana($hoy_rw).' '.date("d-m-Y",strtotime("$hoy_rw")).'</div></td>';
$tablaclientes .='<td style="text-align:right;" height="20" width="400">';
$tablaclientes .='<input type="button" onclick="selectAll()" class="boton02" style="margin-right:20px" value="Todos"><input type="button" onclick="UnSelectAll()" class="boton02" value="Ninguno">';
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