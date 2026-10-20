<?php

include("Codigo/SeguridadCMIT.php");
include("Codigo/Config.php");
include("Codigo/Funciones.php");
$_SESSION["NivelArbol"]="";


//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);




function MostrarTabla($conn,$idconsulta){
//variables
include("Includes/zVariables.php");
//tabla
include("Includes/zInitTInicio.php");
//Horarios
for ($j=1; $j <=$varhorariosst; $j= $j +1) {
	$tablaclientes .="<tr>";
	$fecha=$fechainicial;
	//hora (segun sea turno/sobreturno)
	if($j>$varhorarios){$hora=$varhorast;}
	list($h1,$m1)=explode(":",$hora);$horamin=$m1+($h1*60);	list($h1,$m1)=explode(":",date("H:i"));$horaminactual=$m1+($h1*60);
	//
	for ($i=1; $i <=14; $i= $i +1) {
		//cierra celda		
		$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";
		//tipo dia y turnos disponibles
		include("Includes/zTipoDia.php");
		//muestra horario libre en el calendario(segun sea turno/sobreturno)
		if($j<=$varhorarios){include("Includes/zMuestraCelda.php");}else{include("Includes/zMuestraCeldaST.php");}		
		//muestra horario ocupado,domingo,sabado fuera de horario,horario no vigente,feriado
		if($ocupado==1 or $domingo==1 or $sabado==1 or $horavieja==1 or $feriado==1){
			if($ocupado==0){$tablaclientes .="<td "." class="."TablaDato2"."  style='text-align:center;height:18px; '>".$hora."</td>"; }
			else{			
				$tablaclientes .="<td "." class="."TablaDato2"."  style='text-align:center;background-color:#cc9966;height:20px; '>".'<input name="CmdTurno" type="submit" class="botonocu"   value="'.$hora.'" id="'.$fecha.'|'.$hora.'|'.$varagenda.'" data-toggle="tooltip" data-placement="right" title="'.date("d-m",strtotime("$fecha")).' '.$hora.' '.'(ocupado)'.'" onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'">'."</td>";
			}
		} 		
		$fecha=date("d-m-Y", strtotime("$fecha +1 day"));
	} 
	$tablaclientes .="<td class="."TablaMostrarRight"."> </td></tr>";	 
	//sumo 15 minutos 
	$hora=GLO_TURSumo15Min($hora);
}
include("Includes/zCerrarTInicioCMIT.php");//cerrar tabla
}


GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHVCMIT','TurnosCMIT/zTurnos',0,0,0,0);
echo '<meta http-equiv="REFRESH" content="300">'; 
GLO_tituloypath_h('Bienvenido a Nuestra Plataforma de Turnos Online','A continuaci&oacute;n, podr&aacute; visualizar nuestra agenda de turnos con los horarios disponibles para seleccionar el que m&aacute;s le convenga. <br/>Simplemente haga clic en el horario deseado y nuestro sistema lo guiar&aacute; paso a paso en el proceso de reserva.');

include("Includes/rFechas.php");
echo "<div class='amxTitulo'>";
echo "<i class='fa fas fa-calendar-alt'></i>";
echo "Listado de turnos mes: <span>".fechaRWmes(date("d-m-Y"))."</span>";
echo"</div>";

GLO_Hidden('IdConsulta',0);GLO_Hidden('TxtId',0);
MostrarTabla($conn,intval($_SESSION['IdConsulta']));
GLO_cierratablaform();
mysql_close($conn); 

$fecha=date("d-m-Y");
GLO_initcomment(1120,0);
echo 'Agenda habilitada desde <font class="comentario2" >'.date("d-m-Y").'</font> hasta <font class="comentario2">'.date("d-m-Y",strtotime("$fecha +27 day")).'</font> <br>';
echo 'Al pi&eacute; de cada d&iacute;a se muestra la cantidad de turnos disponibles';
GLO_endcomment();
include ("Codigo/FooterConUsuario.php");
?>