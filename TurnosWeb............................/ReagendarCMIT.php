<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}
//$_GET trae id turno
GLO_ValidaGETTUR($_GET['id'],0,0,'InicioCMIT');//valida que no sea vacio

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

$_SESSION['TxtIdTurno']=intval(decrypt($_GET['id'],'elcrucedelosandes2016'));
$_SESSION['TxtIdEncriptado']=$_GET['ide'];
$_SESSION['TxtIdVolver']=$_GET['idv'];


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
	list($h1,$m1)=explode(":",$hora);$horamin=$m1+($h1*60);
	list($h1,$m1)=explode(":",date("H:i"));$horaminactual=$m1+($h1*60);
	for ($i=1; $i <=14; $i= $i +1) {
		//cierra celda		
		$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";
		//tipo dia y turnos disponibles
		include("Includes/zTipoDia.php");
		//muestra horario libre en el calendario(segun sea turno/sobreturno)
		if($j<=$varhorarios){include("Includes/zMuestraCelda.php");}else{include("Includes/zMuestraCeldaST.php");}		
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
//Cerrar tabla
$tablaclientes .="</table></td></tr></table>"; 
echo $tablaclientes;
}


GLO_InitHTML($_SESSION["NivelArbol"],'','BannerInicio','TurnosCMIT/zReagendar',0,0,0,0);
echo '<meta http-equiv="REFRESH" content="300">'; 
GLO_tituloypath(0,1120,'','Cambiar Fecha','salir');


GLO_Hidden('IdConsulta',0);GLO_Hidden('TxtId',0);GLO_Hidden('TxtIdTurno',0);
GLO_Hidden('TxtIdEncriptado',0);GLO_Hidden('TxtIdVolver',0);GLO_Hidden('TxtNumero',0);
MostrarTabla($conn,intval($_SESSION['IdConsulta']));
GLO_cierratablaform();
mysql_close($conn);
include ("Codigo/FooterConUsuarioSM.php"); 
?>