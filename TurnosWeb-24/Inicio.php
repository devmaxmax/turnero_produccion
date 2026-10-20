<?

include("Codigo/Seguridad.php") ;
$_SESSION["NivelArbol"]="";
include("Codigo/Config.php");
include("Codigo/Funciones.php");

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);




function MostrarTabla($conn,$idconsulta){
//variables
include("Includes/zVariables.php");
//tabla
include("Includes/zInitTInicio.php");
//Horarios
for ($j=1; $j <=$varhorarios; $j= $j +1) {
	$tablaclientes .="<tr>";
	$fecha=$fechainicial;
	//hora
	list($h1,$m1)=explode(":",$hora);$horamin=$m1+($h1*60);
	list($h1,$m1)=explode(":",date("H:i"));$horaminactual=$m1+($h1*60);
	for ($i=1; $i <=14; $i= $i +1) {
		//cierra celda		
		$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";		
		//tipo dia y turnos disponibles
		include("Includes/zTipoDia.php");
		//muestra horario libre en el calendario
		include("Includes/zMuestraCelda.php");
		//muestra horario ocupado,domingo,sabado fuera de horario,horario no vigente,feriado
		if($ocupado==1 or $domingo==1 or $sabado==1 or $horavieja==1 or $feriado==1){
			$tablaclientes .="<td "." class="."TablaDato2"."  style='text-align:center;height:18px; '>".$hora."</td>"; 
		}  
		$fecha=date("d-m-Y", strtotime("$fecha +1 day"));
	} 
	$tablaclientes .="<td class="."TablaMostrarRight"."> </td></tr>";	 
	//sumo 15 minutos 
	$hora=GLO_TURSumo15Min($hora);
}
include("Includes/zCerrarTInicio.php");//cerrar tabla
}

GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHV','Turnos/zTurnos',0,0,0,0);
echo '<meta http-equiv="REFRESH" content="300">'; 
GLO_tituloypath(0,920,'','','');

//Inicio Banner RW

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

$query="SELECT * From banners WHERE id = 1";
$banner=mysql_query($query,$conn);
$rowe=mysql_fetch_array($banner);

if($rowe['Activado'] == 'SI') {
	echo '<div class="banner-rw" style="margin:0px"><h3>'.$rowe['Subtitulo'].'</h3><p>'.$rowe['Texto'].'</p></div><br>';
}



//Final Banner RW


GLO_Hidden('IdConsulta',0);GLO_Hidden('TxtId',0);
GLO_mensajeerror();
MostrarTabla($conn,intval($_SESSION['IdConsulta']));
GLO_cierratablaform();
mysql_close($conn); 

$fecha=date("d-m-Y");
GLO_initcomment(920,0);
echo 'Agenda habilitada desde <font class="comentario2" >'.date("d-m-Y").'</font> hasta <font class="comentario2">'.date("d-m-Y",strtotime("$fecha +27 day")).'</font> <br>';
echo 'Al pi&eacute; de cada d&iacute;a se muestra la cantidad de turnos disponibles';
GLO_endcomment();



include ("Codigo/FooterConUsuario.php");
?>