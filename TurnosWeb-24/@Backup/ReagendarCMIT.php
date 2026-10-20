<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

$_SESSION['TxtIdTurno']=intval(decrypt($_GET['id'],'elcrucedelosandes2016'));
$_SESSION['TxtIdEncriptado']=$_GET['ide'];
$_SESSION['TxtIdVolver']=$_GET['idv'];

//muestra los turnos dados
function MostrarTabla($conn,$idconsulta){
include("Includes/zTurnosInicio.php");//variables

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
//Horarios
for ($j=1; $j <=$varhorarios; $j= $j +1) {
	$tablaclientes .="<tr>";
	$fecha=$fechainicial;
	list($h1,$m1)=explode(":",$hora);$horamin=$m1+($h1*60);
	list($h1,$m1)=explode(":",date("H:i"));$horaminactual=$m1+($h1*60);
	for ($i=1; $i <=14; $i= $i +1) {
		if(date('w',strtotime($fecha))==0){$domingo=1;}else{$domingo=0;}//domingo
		if(date('w',strtotime($fecha))==6 and ($horamin<540 or $horamin>615 )){$sabado=1;}else{$sabado=0;}//sabado fuera de horario de atencion
		if((($horaminactual+$varminreserva)>$horamin) and (strtotime($fecha)==strtotime(date("d-m-Y")))){$horavieja=1;}else{$horavieja=0;}//horario no vigente hoy
		$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";
		//si es horario 08:00 lleva cantidad distinta de turnos
		if($j==1){$varturnos=$varturnos8hs;}else{$varturnos=$varturnosotros;}
		//busco si hay turno disponible(y cuantos)
		$ocupado=0;$cantdisp=$varturnos;
		$query="Select Count(Id) as Cant From turnos Where Estado<>3 and IdAgenda=$varagenda and Fecha='".FechaMySql($fecha)."' and Hora='$hora'";
		$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
		if(mysql_num_rows($rs)!=0){if($row['Cant']>=$varturnos){$ocupado=1;$cantdisp=0;}else{$cantdisp=$cantdisp-$row['Cant'];}}mysql_free_result($rs);
		//busco si es feriado
		$feriado=GLO_TURFeriado($fecha,$conn);
		
		//libre,no domingo,sabado dentro de horario,horariovigente,no feriado
		if($ocupado==0 and $domingo==0 and $sabado==0 and $horavieja==0 and $feriado==0){
			//muestro cant disponible
			if($cantdisp==1){$cantdispley='(1 turno disponible)';}else{$cantdispley='('.$cantdisp.' turnos disponibles)';}
			$tablaclientes .="<td "." class="."TablaDato2"."  style='text-align:center;background-color:#669900;height:18px; '>".'<input name="CmdTurno" type="submit" class="botondisp"   value="'.$hora.'" id="'.$fecha.'|'.$hora.'|'.$varagenda.'"  title="'.date("d-m",strtotime("$fecha")).' '.$hora.' '.$cantdispley.'" onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'">'."</td>";
		}
		//ocupado,domingo,sabado fuera de horario,horario no vigente,feriado
		if($ocupado==1 or $domingo==1 or $sabado==1 or $horavieja==1 or $feriado==1){
			$tablaclientes .="<td "." class="."TablaDato2"."  style='text-align:center;height:18px; '>".$hora."</td>"; 
		}  
		
		
		$fecha=date("d-m-Y", strtotime("$fecha +1 day"));
	} 
	$tablaclientes .="<td class="."TablaMostrarRight"."> </td></tr>"; 
	//sumo 15 minutos 
	list($h1,$m1)=explode(":",$hora);$minutos1=$m1+($h1*60)+$varminentreturnos;
	$H= intval($minutos1/60);$M = ($minutos1-($H*60));$hora=date("H:i",strtotime($H.":".$M));  
}

//Cerrar tabla
$tablaclientes .="</table></td></tr></table>"; 
echo $tablaclientes;
}

?> 

<? include ("Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css" >
<meta http-equiv="REFRESH" content="300"> 
<? GLO_bodyform('',0,0); ?>
<? include ("Codigo/BannerSinMenuHV.php");?>
<? GLO_formform('Formulario','TurnosCMIT/zReagendar.php',0,0,0); ?>
<? GLO_tituloypath(0,920,'','','salir'); ?>


<? 
GLO_Hidden('IdConsulta',0);GLO_Hidden('TxtId',0);GLO_Hidden('TxtIdTurno',0);
GLO_Hidden('TxtIdEncriptado',0);GLO_Hidden('TxtIdVolver',0);GLO_Hidden('TxtNumero',0);
MostrarTabla($conn,intval($_SESSION['IdConsulta']));
GLO_cierratablaform();
mysql_close($conn); 
?>


<? include ("Codigo/FooterConUsuarioSM.php");?>
</body>
</html>