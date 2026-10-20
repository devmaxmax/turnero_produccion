<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
require_once('Codigo/calendar/classes/tc_calendar.php');

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

function MostrarTabla($conn,$idconsulta){
//variables
include("Includes/zVariables.php");
//tabla
include("Includes/zInitTMasivo.php");
//titulos columnas dias de la semana
for ($i=1; $i <=14; $i= $i +1) {
	//inicializo hora para cada dia	
	$hora=GLO_horainicioLV();
	$tablaclientes .="<td class="."TablaTituloLeft"." style='width:1px;'> </td>"; //inicia columna dia
	$tablaclientes .="<td style='text-align:center;border:none;padding:0px;width:65px;vertical-align:top'>"; //td contiene horarios del dia
	$tablaclientes .="<table style='text-align:center;border:none;padding:0px;width:65px;'>"; //td contiene horarios del dia	
	//Titulo dia	
	if( CompararFechas(date("d-m-Y"),$fecha)!=0)//resalta dia de hoy
	{$tablaclientes .="<tr><td "."width="."65"." class="."TablaTituloDato"." style='text-align:center;'>"; }
	else{$tablaclientes .="<tr><td "."width="."65"." class="."TablaTituloDato"." style='text-align:center;border:1px solid #808080;background:#808080;color:#ffffff;'>"; }	
	$tablaclientes .=ObtenerDiaSemanaCorto($fecha).' '.date("d-m",strtotime("$fecha"))."</td>";	
	$tablaclientes .="</td></tr>";
	//Horarios
	for ($j=1; $j <=$varhorariosst; $j= $j +1) {
		//hora (segun sea turno/sobreturno)
		if($j>$varhorarios){$hora=$varhorast;}
		list($h1,$m1)=explode(":",$hora);$horamin=$m1+($h1*60);
		list($h1,$m1)=explode(":",date("H:i"));$horaminactual=$m1+($h1*60);
		//tipo dia y turnos disponibles
		include("Includes/zTipoDia.php");
		//domingo,sabado fuera de horario,horario no vigente,feriado
		if($domingo==1 or $sabado==1 or $horavieja==1 or $feriado==1){			
			for ($k=1; $k <=$varturnos; $k= $k +1) {//5 turnos de cada hora
				$tablaclientes .="<tr><td "." class="."TablaDato2"."  style='text-align:center;height:24px; '>".$hora."</td></tr>";
			}
		} else{//no domingo,sabado dentro de horario,horario vigente,no feriado	
			if($j<=$varhorarios){			
				${'turnosdispdiario'.$i}=${'turnosdispdiario'.$i}+$cantdisp;//sumo turnos disponibles del dia		
				for ($k=1; $k <=$cantdisp; $k= $k +1) {//turnos disponibles
					if($cantdisp==1){$cantdispley='(disponible)';}else{$cantdispley='(disponible)';}
					$tablaclientes .="<tr><td "." class="."TablaDato2"."  style='text-align:center;background-color:#669900;height:24px;color: #FFFFFF;cursor:pointer;'".' title="'.date("d-m",strtotime("$fecha")).' '.$hora.' '.$cantdispley.'"'." >".$hora.' <input type="checkbox" name="campos['.FechaMySql($fecha).'|'.$hora.'|'.$varagenda.'|'.$idturno.']" >'."</td></tr>";
					$idturno=$idturno+1;
				} 
			}else{
				${'sturnosdispdiario'.$i}=${'sturnosdispdiario'.$i}+$cantdisp;//sumo turnos disponibles del dia		
				for ($k=1; $k <=$cantdisp; $k= $k +1) {//turnos disponibles
					if($cantdisp==1){$cantdispley='(disponible)';}else{$cantdispley='(disponible)';}
					$tablaclientes .="<tr><td "." class="."TablaDato2"."  style='text-align:center;background-color:#4285F4;height:24px;color: #FFFFFF;cursor:pointer;'".' title="'.date("d-m",strtotime("$fecha")).' '.$hora.' '.$cantdispley.'"'." >".$hora.' <input type="checkbox" name="campos['.FechaMySql($fecha).'|'.$hora.'|'.$varagenda.'|'.$idturno.']" >'."</td></tr>";
					$idturno=$idturno+1;
				} 
			}
			$varocupados=$varturnos-$cantdisp;
			for ($k=1; $k <=$varocupados; $k= $k +1) {//turnos ocupados
				$tablaclientes .="<tr><td "." class="."TablaDato2"."  style='text-align:center;background-color:#cc9966;height:24px;color: #FFFFFF;cursor:pointer;' ".' title="'.date("d-m",strtotime("$fecha")).' '.$hora.' '.'(ocupado)'.'"'.">".$hora."</td></tr>";
			}
		}
		//sumo 15 minutos
		$hora=GLO_TURSumo15Min($hora); 
	}
	//fin td contiene horarios del dia 
	$fecha=date("d-m-Y", strtotime("$fecha +1 day"));
	$tablaclientes .="</table></td>"; 	
	$tablaclientes .="<td class="."TablaTituloRight"." style='width:1px;'> </td>"; //cierra columna dia
}	
//fin Tabla general de los 14 dias
$tablaclientes .='</tr>';
include("Includes/zCerrarTMasivo.php");//cerrar tabla
}







GLO_InitHTML($_SESSION["NivelArbol"],'TxtExCriterio','BannerConMenuHVCMIT','TurnosCMIT/zMasivoL',0,0,0,0);
GLO_tituloypath(0,760,'InicioCMIT.php','TURNOS - ASIGNACION MASIVA','linksalir'); 
?>


<table width="760" border="0"  cellspacing="0" class="Tabla" >
<tr> <td width="110" height="3"  ></td><td width="200"></td> <td width="100"></td><td width="230"></td><td width="120"></td> </tr>
<tr><td height="18"  align="right"  >Raz&oacute;n Social:</td><td  valign="top"  colspan="3">&nbsp; 
<? 
	echo '<input name="TxtExCriterio" type="text" class="TextBox" style="width:160px" maxlength="20" value="';echo $_SESSION['TxtExCriterio']; echo'" tabindex="1" onKeyPress="if(event.keyCode==13){document.Formulario.CmdExBuscar.click();}"> <button name="CmdExBuscar"  type="submit" class="iconbtn2" tabindex="1" title="Buscar" value="" onClick="document.Formulario.target='."'_self'".'"><i class="fa fa-search iconsmallbt iconlgray"></i></button>&nbsp;<select name="CbIdRSF"  class="campos" id="CbIdRSF" style="width:250px" tabindex="1">'; 
	if ($_SESSION['TxtExCriterio']!=""){	GLO_CbClienteTurno("CbIdRSF",mysql_real_escape_string($_SESSION['TxtExCriterio']),$conn);}
	echo '</select>';
?><input  name="TxtId"  type="hidden"  value="<? echo $_SESSION['TxtId']; ?>"><input  name="IdConsulta"  type="hidden"   value="<? echo $_SESSION['IdConsulta']; ?>"></td><td align="right"><? echo GLO_FAButton('CmdGuardar','submit','80','self','Grabar','save',''); ?>&nbsp;</td></tr>
<tr><td height="18"  align="right"  >Tipo de Examen:</td><td  valign="top" >&nbsp; <select name="CbIdTipoEx" style="width:160px" class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("tipoexamen","CbIdTipoEx","Id","","",$conn); ?></select></td><td align="right"></td><td  valign="top" colspan="2">&nbsp;</tr>
<tr><td height="18"  align="right"  valign="top" >Observaciones:</td><td  valign="top" colspan="4">&nbsp; <textarea name="TxtObs" style="width:600px" rows="1" class="TextBox" onKeyPress="event.cancelBubble=true;" tabindex="1"><? echo $_SESSION['TxtObs']; ?></textarea></td></tr>
</table>

<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	

<?
GLO_mensajeerror();
MostrarTabla($conn,intval($_SESSION['IdConsulta']));
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(910,0);
echo 'Enviar&aacute; <font class="comentario3">Mail</font>  de aviso al Cliente si el turno: tiene cliente asignado, no est&aacute; atendido y est&aacute; vigente<br>
Al pi&eacute; de cada d&iacute;a se muestra la cantidad de turnos <font class="comentario2">disponibles</font>';
GLO_endcomment();

include ("Codigo/FooterConUsuario.php");
?>