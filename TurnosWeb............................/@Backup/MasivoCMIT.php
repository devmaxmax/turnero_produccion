<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
require_once('Codigo/calendar/classes/tc_calendar.php');

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}




$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);



function MostrarTabla($conn,$idconsulta){
include("Includes/zTurnosInicio.php");//variables

$idturno=1;//para q el check reconozca varios registros con misma fecha y hora
$clicksig="'Si cambia de semana perderá los datos seleccionados'";
//Titulos de la tabla
$tablaclientes="";

$tablaclientes .='<table width="910" border="0" cellspacing="0" cellpadding="0" class="Tabla" >';
$tablaclientes .='<tr><td style="text-align:left;font-size:12px;font-weight:bold;color:#45302C;background-color:#9ab7c1;" height="20" width="610">&nbsp;Ingrese los datos de la Empresa, seleccione los Turnos y Grabe</td>';
$tablaclientes .='<td style="text-align:right;font-size:14px;font-weight:bold;color:#45302C;background-color:#9ab7c1;" height="20" width="300">';
if($idconsulta==2){$tablaclientes .='<input name="CmdAnterior" type="submit" class="botonsig"   value="Anterior" onClick="return confirm('.$clicksig.');">';}
else{$tablaclientes .='<input name="CmdSiguiente" type="submit" class="botonsig"   value="Siguiente" onClick="return confirm('.$clicksig.');">';}
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
//limpio variable turnos disp por dia
for ($i=1; $i <=14; $i= $i +1) {${'turnosdispdiario'.$i}=0;}
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
		//busco si hay turno disponible(y cuantos) no eliminado
		$ocupado=0;$cantdisp=$varturnos;
		$query="Select Count(Id) as Cant From turnos Where Estado<>3 and IdAgenda=$varagenda and Fecha='".FechaMySql($fecha)."' and Hora='$hora'";
		$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
		if(mysql_num_rows($rs)!=0){if($row['Cant']>=$varturnos){$ocupado=1;$cantdisp=0;}else{$cantdisp=$cantdisp-$row['Cant'];}}mysql_free_result($rs);
		//busco si es feriado
		$feriado=GLO_TURFeriado($fecha,$conn);
		
		//libre,no domingo,sabado dentro de horario,horariovigente,no feriado
		if($ocupado==0 and $domingo==0 and $sabado==0 and $horavieja==0 and $feriado==0){
			${'turnosdispdiario'.$i}=${'turnosdispdiario'.$i}+$cantdisp;//sumo turnos disponibles del dia	
			//muestro cant disponible
			if($cantdisp==1){$cantdispley='(1 turno disponible)';}else{$cantdispley='('.$cantdisp.' turnos disponibles)';}
			$tablaclientes .="<td "." class="."TablaDato2"."  style='text-align:center;background-color:#669900;height:18px;color: #FFFFFF;cursor:pointer;'".' title="'.date("d-m",strtotime("$fecha")).' '.$hora.' '.$cantdispley.'"'." >".$hora.' <input type="checkbox" name="campos['.FechaMySql($fecha).'|'.$hora.'|'.$varagenda.'|'.$idturno.']" >'."</td>";
			$idturno=$idturno+1;
		}
		//ocupado,domingo,sabado fuera de horario,horario no vigente,feriado
		if($ocupado==1 or $domingo==1 or $sabado==1 or $horavieja==1 or $feriado==1){
			if($ocupado==0){$tablaclientes .="<td "." class="."TablaDato2"."  style='text-align:center;height:18px; '>".$hora."</td>"; }
			else{		
				$tablaclientes .="<td "." class="."TablaDato2"."  style='text-align:center;background-color:#cc9966;height:18px;color: #FFFFFF;cursor:pointer;' ".' title="'.date("d-m",strtotime("$fecha")).' '.$hora.' '.'(ocupado)'.'"'.">".$hora."</td>";
			}
		} 
		
		
		$fecha=date("d-m-Y", strtotime("$fecha +1 day"));
	} 
	$tablaclientes .="<td class="."TablaMostrarRight"."> </td></tr>"; 
	//sumo 15 minutos 
	list($h1,$m1)=explode(":",$hora);$minutos1=$m1+($h1*60)+$varminentreturnos;
	$H= intval($minutos1/60);$M = ($minutos1-($H*60));$hora=date("H:i",strtotime($H.":".$M));  
}

//Cerrar tabla
$tablaclientes .="</table>"; 

//leyenda turnos disponibles por dia
$tablaclientes .='<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="2"></td></tr></table>';	
$tablaclientes .="<table width="."925"." border="."0"." cellspacing="."0"." cellpadding="."0"." class="."fondo"." ><tr> ";
for ($i=1; $i <=14; $i= $i +1) {
	$tablaclientes .="<td class="."TablaTituloLeft"." style='width:1px;'> </td>"; 
	$tablaclientes .="<td style='text-align:center;color: #666666;width:65px;'>"; 	
	$tablaclientes .=${'turnosdispdiario'.$i}.' turnos';
}	
$tablaclientes .="<td class="."TablaMostrarRight"." style='width:1px;'> </td></tr></table>";  

echo $tablaclientes;
}



function ComboLocalRSFCMIT($campo,$criterio,$conn){
$idcombo=intval($_SESSION[$campo]);
//busco RSF de usuarios y usuariosclientes
$query1="SELECT 0 as Id,u.RSF,u.Usuario FROM usuarios u Where usuario <>'ngrunmann@gmail.com' and u.Bloqueado=0 and u.RSF Like '%".$criterio."%'";
$query2="SELECT uc.Id,uc.RSF,uc.IdUsuario as Usuario FROM usuariosclientes uc,usuarios u where uc.Id<>0 and uc.IdUsuario=u.Usuario and u.Bloqueado=0 and uc.RSF Like '%".$criterio."%'";
$query="Select uu.* From ($query1 UNION ALL $query2)uu Order by uu.RSF";$rs=mysql_query($query,$conn);
$combo='<option value=""></option>';
while($row=mysql_fetch_array($rs)){ 
	$combo .= " <option value='".$row['Id'].'|'.$row['Usuario']."'>".$row['RSF'].' ('.$row['Usuario'].')'."</option>\n";   
}mysql_free_result($rs);
echo $combo;
}



?>

<? include ("Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css" >
</head>




<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['TxtExCriterio'].focus()">
<? include ("Codigo/BannerConMenuHVCMIT.php");?>


<form  name="Formulario" action="TurnosCMIT/zMasivo.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"   >
<tr> <td height="5"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="920" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >TURNOS - ASIGNACIÓN MASIVA</td></tr>
</table>




<table width="760" border="0"  cellspacing="0" class="Tabla" >
<tr> <td width="110" height="3"  ></td><td width="200"></td> <td width="100"></td><td width="250"></td><td width="100"></td> </tr>
<tr><td height="18"  align="right"  >Razón Social:</td><td  valign="top"  colspan="3">&nbsp; 
<? 
	echo '<input name="TxtExCriterio" type="text" class="TextBox" style="width:160px" maxlength="20" value="';echo $_SESSION[TxtExCriterio]; echo'" tabindex="1" onKeyPress="if(event.keyCode==13){document.Formulario.CmdExBuscar.click();}"> <input name="CmdExBuscar"  type="submit" class="botonbuscarG" tabindex="1" title="Buscar" value="" onClick="document.Formulario.target='."'_self'".'"> &nbsp; &nbsp;<select name="CbIdRSF"  class="campos" id="CbIdRSF" style="width:250px" tabindex="1">'; 
	if ($_SESSION[TxtExCriterio]!=""){	ComboLocalRSFCMIT("CbIdRSF",mysql_real_escape_string($_SESSION[TxtExCriterio]),$conn);}
	echo '</select>';
?>

 <input  name="TxtId"  type="hidden"  value="<? echo $_SESSION[TxtId]; ?>"><input  name="IdConsulta"  type="hidden"   value="<? echo $_SESSION[IdConsulta]; ?>"></td><td align="right">
 <? $click="'Por favor aguarde. Grabará los cambios y enviará mail al Cliente'";
 echo '<input name="CmdGuardar" type="submit" class="botongrabar"  title="Guardar" value="" onClick="return confirm('.$click.');">';
 ?>&nbsp; <input name="CmdSalir"  type="submit" class="botonsalirG"   value="" onClick="document.Formulario.target='_self'">&nbsp;</td></tr>
<tr><td height="18"  align="right"  >Facturar A:</td><td  valign="top">&nbsp; <select name="CbIdEntidad" style="width:160px; " class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("entidades","CbIdEntidad","Nombre","","",$conn); ?></select></td><td align="right">ART que lo envía:</td><td  valign="top" colspan="2">&nbsp;<input name="TxtART"  type="text"  class="TextBox"  style="width:300px" maxlength="50" tabindex="1"  value="<? echo $_SESSION[TxtART];?>"></td></tr>
<tr><td height="18"  align="right"  >Tipo de Examen:</td><td  valign="top" >&nbsp; <select name="CbIdTipoEx" style="width:160px" class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("tipoexamen","CbIdTipoEx","Nombre","","",$conn); ?></select></td><td align="right">Si es otro aclarar:</td><td  valign="top" colspan="2">&nbsp;<input name="TxtObsTipo"  type="text"  class="TextBox"  style="width:300px" maxlength="50" tabindex="1"  value="<? echo $_SESSION[TxtObsTipo];?>"></tr>
<tr><td height="18"  align="right"  valign="top" >Detalle:</td><td  valign="top"  colspan="4">&nbsp; <textarea name="TxtDetalle" style="width:600px" rows="1" class="TextBox" onKeyPress="event.cancelBubble=true;" tabindex="1"><? echo $_SESSION[TxtDetalle]; ?></textarea></td></tr>
<tr><td height="18"  align="right"  valign="top" >Observaciones:</td><td  valign="top" colspan="4">&nbsp; <textarea name="TxtObs" style="width:600px" rows="1" class="TextBox" onKeyPress="event.cancelBubble=true;" tabindex="1"><? echo $_SESSION[TxtObs]; ?></textarea></td></tr>
</table>


<table  width="500" border="0" cellspacing="0" cellpadding="0" >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
<tr> <td height="3"></td></tr>
</table>







<table  width="910" border="0" cellspacing="0" cellpadding="0" >
<tr><td  height=3 ></td></tr>
<tr valign="top"> 	<td  align="center" valign="top" > 	<?php MostrarTabla($conn,intval($_SESSION['IdConsulta'])); ?>	</td>	</tr>
</table>


</td></tr>      
</table>
<? mysql_close($conn);

$_SESSION[TxtId]=""; 
$_SESSION['IdConsulta']="";
$_SESSION['TxtDetalle']="";
$_SESSION['TxtObs']="";
$_SESSION['CbIdTipoEx']="";
$_SESSION['TxtObsTipo']="";
$_SESSION['CbIdEntidad']="";
$_SESSION['TxtART']="";



?>
</Form>		
<!-- Comentario-->
<table  width="920" border="0" cellspacing="0" cellpadding="0"  >
<tr><td class="comentario1">
Enviará <font class="comentario3">Mail</font>  de aviso al Cliente si el turno: tiene cliente asignado, no está atendido y está vigente<br>
Al pié de cada día se muestra la cantidad de turnos <font class="comentario2">disponibles</font>

</td></tr>
</table>
<!-- fin Comentario-->


<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>
