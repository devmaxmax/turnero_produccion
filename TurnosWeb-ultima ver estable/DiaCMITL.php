<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
require_once('Codigo/calendar/classes/tc_calendar.php');

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

function MostrarTabla($conn,$idconsulta){
//variables
include("Includes/zVariables.php");
//tabla
include("Includes/zInitTDia.php");
//titulos columnas dias de la semana

	//inicializo hora para cada dia	
	$hora=GLO_horainicioLV();
	$tablaclientes .="<td class="."TablaTituloLeft"." style='width:0px;'> </td>"; //inicia columna dia
	$tablaclientes .="<td style='text-align:center;border:none;padding:0px;width:1120;vertical-align:top'>"; //td contiene horarios del dia
	$tablaclientes .="<table style='text-align:center;border:none;padding:0px;width:1120px;'>"; //td contiene horarios del dia	
	//Titulo dia	

	$tablaclientes .="<tr><td "."width="."90"." class="."TablaTituloDato"." style='text-align:center;border-top:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc; background:#ccc;'>";	
	$tablaclientes .="Horario</td>";
	$tablaclientes .="</td><td "."width="."70"." style='text-align:center;border-right:1px solid #ffffff;border-top:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc; background:#f9f9f9;'>Turno</td>";
	$tablaclientes .="</td><td "."width="."210"." style='text-align:center;border-right:1px solid #ffffff;border-top:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc; background:#f9f9f9;'>Razón Social</td>";
	$tablaclientes .="</td><td "."width="."130"." style='text-align:center;border-top:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc; background:#f9f9f9;'>CUIT</td>";
	$tablaclientes .="</td><td "."width="."210"." style='text-align:center;border-top:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc; background:#f9f9f9;'>Paciente</td>";
	$tablaclientes .="</td><td "."width="."130"." style='text-align:center;border-top:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc; background:#f9f9f9;'>Exámen</td>";
	$tablaclientes .="</td><td "."width="."110"." style='text-align:center;border-top:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc; background:#f9f9f9;'>Estado</td>";
	$tablaclientes .="</td><td "."width="."170"." style='text-align:center;border-top:1px solid #ccc; border-bottom:1px solid #ccc; background:#f9f9f9;'>Opciones</td></tr>";
	//Horarios
	for ($j=1; $j <=$varhorariosst; $j= $j +1) {
		//hora (segun sea turno/sobreturno)
		if($j>$varhorarios){$hora=$varhorast;}
		list($h1,$m1)=explode(":",$hora);$horamin=$m1+($h1*60);
		list($h1,$m1)=explode(":",date("H:i"));$horaminactual=$m1+($h1*60);
		//tipo dia y turnos disponibles
		include("Includes/zTipoDia.php");
		//domingo,sabado fuera de horario,horario no vigente,feriado
		if($domingo==1 or $sabado==1 or $feriado==1){			
			for ($k=1; $k <=$varturnos; $k= $k +1) {//5 turnos de cada hora
				$tablaclientes .="<tr><td "." class="."TablaDato2"." style='border-right:1px solid #ccc; text-align:center;height:28px; '>".$hora."</td>";
				$tablaclientes .="<td "." class="."TablaDato2"." colspan="."7"." style='text-align:center;height:28px; '>Turno No Disponible</td></tr>";
			}

		} elseif ($horavieja==1) {

			if($j<=$varhorarios){			
				${'turnosdispdiario'.$i}=${'turnosdispdiario'.$i}+$cantdisp;//sumo turnos disponibles del dia		
				for ($k=1; $k <=$cantdisp; $k= $k +1) {//turnos disponibles
					if($cantdisp==1){$cantdispley='(disponible)';}else{$cantdispley='(disponible)';}

				$tablaclientes .="<tr><td "." class="."TablaDato2"." style='border-right:1px solid #ccc; text-align:center;height:28px; '>".$hora."</td>";
				$tablaclientes .="<td "." class="."TablaDato2"." colspan="."7"." style='text-align:center;height:28px; '>Turno No Disponible</td></tr>";
			}} 


			$hoyr = date("Y-m-d",strtotime("$hoy_rw"));

			$query="SELECT 
					turnos.Id,
					turnos.Paciente,
					turnos.DNIP,
					turnos.Fecha,
					turnos.Hora,
					turnos.Puesto,
					turnos.IdRSF,
					turnos.Estado,
					usuariosclientes.RSF,
					usuarios.RSF as RSF0,
					usuarios.CUITF,
					tipoexamen.Nombre
					FROM turnos
					LEFT JOIN usuariosclientes ON turnos.IdRSF = usuariosclientes.Id
					LEFT JOIN usuarios ON turnos.IdUsuario = usuarios.Usuario 
					LEFT JOIN tipoexamen ON turnos.IdTipoEx = tipoexamen.Id WHERE Fecha = '$hoyr' AND Hora = '$hora' ORDER BY id DESC";

			$rs=mysql_query($query,$conn);
			while($row=mysql_fetch_array($rs)){ 

			if($row['IdRSF']==0){$empresa=$row['RSF0'];$cuit=$row['CUITF'];} else {$empresa=$row['RSF'];$cuit=$row['DNIP']; }
			$clickatender="'Desea atender el turno ".date('H:i',strtotime($row['Hora']))."?'";
			if($row['Estado']==0){$estado='Sin Atender';}
			if($row['Estado']==1){$estado='Atendido';}
			if($row['Estado']==3){$estado='Eliminado';}

				$tablaclientes .="<tr><td class='TablaDato2' title='Hora' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".date('H:i',strtotime($row['Hora']))."</td>";

				$tablaclientes .="<td class='TablaDato2' title='N° Turno' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".$row['Id']."</td>";

				$tablaclientes .="<td class="."TablaDato2"." title='Paciente' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".$empresa."</td>";

				$tablaclientes .="<td class="."TablaDato2"." title='CUIT' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".$cuit."</td>";

				$tablaclientes .="<td class="."TablaDato2"." title='Empresa' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".$row['Paciente']."</td>";

				$tablaclientes .="<td class="."TablaDato2"." title='Empresa' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".$row['Nombre']."</td>";

				$tablaclientes .="<td class="."TablaDato2"." title='Empresa' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".$estado."</td>";

				$tablaclientes .="<td class="."TablaDato2"." title='Tipo de Exámen' style='text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>";


					if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2  or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10){ 			
						if($row['Estado']==0){
							$tablaclientes .='<button name="CmdAtender" type="submit" class="iconbtn2"   value="" data-toggle="tooltip" data-placement="top" title="Atender" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickatender.');"><i class="fa fa-check iconsmallbt iconlwhite"></i></button>';
						}
					}	


					$tablaclientes .='&nbsp; <button name="CmdVer" type="submit" class="iconbtn2" value="" data-toggle="tooltip" data-placement="top" title="Ver" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"><i class="fa fa-search iconsmallbt iconwhite"></i></button>';

					if($row['Estado']!=3){	
					$tablaclientes .='&nbsp; <button name="CmdModificar" type="submit" class="iconbtn2"   value="" data-toggle="tooltip" data-placement="top" title="Modificar" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"><i class="fa fa-edit iconsmallbt iconwhite; font-weight:400"></i></button>';
					}

				$tablaclientes .="</td></tr>";

			}



		} else { //no domingo,sabado dentro de horario,horario vigente,no feriado	
			if($j<=$varhorarios){			
				${'turnosdispdiario'.$i}=${'turnosdispdiario'.$i}+$cantdisp;//sumo turnos disponibles del dia		
				for ($k=1; $k <=$cantdisp; $k= $k +1) {//turnos disponibles
					if($cantdisp==1){$cantdispley='(disponible)';}else{$cantdispley='(disponible)';}
					$tablaclientes .="<tr><td "." class="."TablaDato2"."  style='border-right:1px solid #ccc; text-align:center; background-color:#669900; height:28px;color: #FFFFFF;cursor:pointer;'".' title="'.date("d-m",strtotime("$fecha")).' '.$hora.' '.$cantdispley.'"'." >".$hora.' <input type="checkbox" class="casety" name="campos['.FechaMySql($fecha).'|'.$hora.'|'.$varagenda.'|'.$idturno.']">'."</td>";
					$tablaclientes .="<td "." class="."TablaDato2"." colspan="."7"." style='border-right:1px solid #ccc; text-align:center; background-color:#669900; height:28px;color: #FFFFFF;'".' title=" "'." >Turno Disponible</td></tr>";

					$idturno=$idturno+1;
				} 
			} else {
				${'sturnosdispdiario'.$i}=${'sturnosdispdiario'.$i}+$cantdisp;//sumo turnos disponibles del dia		
				for ($k=1; $k <=$cantdisp; $k= $k +1) {//turnos disponibles
					if($cantdisp==1){$cantdispley='(disponible)';}else{$cantdispley='(disponible)';}
					$tablaclientes .="<tr><td "." class="."TablaDato2"."  style='border-right:1px solid #ccc; text-align:center; background-color:#4285F4; height:28px; color: #FFFFFF; cursor:pointer;'".' title="'.date("d-m",strtotime("$fecha")).' '.$hora.' '.$cantdispley.'"'." >".$hora.' <input type="checkbox" name="campos['.FechaMySql($fecha).'|'.$hora.'|'.$varagenda.'|'.$idturno.']" >'."</td>";
					$tablaclientes .="<td "." class="."TablaDato2"." colspan="."7"." style='border-right:1px solid #ccc; text-align:center; background-color:#4285F4; height:28px; color: #FFFFFF;'".' title=" "'." >Sobreturno Disponible</td></tr>";

					$idturno=$idturno+1;
				} 
			}
			$varocupados=$varturnos-$cantdisp;

			$hoyr = date("Y-m-d",strtotime("$hoy_rw"));

			$query="SELECT 
					turnos.Id,
					turnos.Paciente,
					turnos.DNIP,
					turnos.Fecha,
					turnos.Hora,
					turnos.Puesto,
					turnos.IdRSF,
					turnos.Estado,
					usuariosclientes.RSF,
					usuarios.RSF as RSF0,
					usuarios.CUITF,
					tipoexamen.Nombre
					FROM turnos
					LEFT JOIN usuariosclientes ON turnos.IdRSF = usuariosclientes.Id
					LEFT JOIN usuarios ON turnos.IdUsuario = usuarios.Usuario 
					LEFT JOIN tipoexamen ON turnos.IdTipoEx = tipoexamen.Id WHERE Fecha = '$hoyr' AND Hora = '$hora' ORDER BY id DESC";

			$rs=mysql_query($query,$conn);
			while($row=mysql_fetch_array($rs)){ 

			if($row['IdRSF']==0){$empresa=$row['RSF0'];$cuit=$row['CUITF'];} else {$empresa=$row['RSF'];$cuit=$row['DNIP']; }
			$clickatender="'Desea atender el turno ".date('H:i',strtotime($row['Hora']))."?'";
			if($row['Estado']==0){$estado='Sin Atender';}
			if($row['Estado']==1){$estado='Atendido';}
			if($row['Estado']==3){$estado='Eliminado';}

				$tablaclientes .="<tr><td class='TablaDato2' title='Hora' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".date('H:i',strtotime($row['Hora']))."</td>";

				$tablaclientes .="<td class='TablaDato2' title='N° Turno' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".$row['Id']."</td>";

				$tablaclientes .="<td class="."TablaDato2"." title='Paciente' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".$empresa."</td>";

				$tablaclientes .="<td class="."TablaDato2"." title='CUIT' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".$cuit."</td>";

				$tablaclientes .="<td class="."TablaDato2"." title='Empresa' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".$row['Paciente']."</td>";

				$tablaclientes .="<td class="."TablaDato2"." title='Empresa' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".$row['Nombre']."</td>";

				$tablaclientes .="<td class="."TablaDato2"." title='Empresa' style='border-right:1px solid #ccc; text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>".$estado."</td>";

				$tablaclientes .="<td class="."TablaDato2"." title='Tipo de Exámen' style='text-align:center; background-color:#cc9966; height:28px; color: #FFFFFF;'>";


					if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2  or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10){ 			
						if($row['Estado']==0){
							$tablaclientes .='<button name="CmdAtender" type="submit" class="iconbtn2"   value="" data-toggle="tooltip" data-placement="top" title="Atender" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickatender.');"><i class="fa fa-check iconsmallbt iconlwhite"></i></button>';
						}
					}	


					$tablaclientes .='&nbsp; <button name="CmdVer" type="submit" class="iconbtn2" value="" data-toggle="tooltip" data-placement="top" title="Ver" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"><i class="fa fa-search iconsmallbt iconwhite"></i></button>';

					if($row['Estado']!=3){	
					$tablaclientes .='&nbsp; <button name="CmdModificar" type="submit" class="iconbtn2"   value="" data-toggle="tooltip" data-placement="top" title="Modificar" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"><i class="fa fa-edit iconsmallbt iconwhite; font-weight:400"></i></button>';
					}

				$tablaclientes .="</td></tr>"; 


			}
			
		}
		//sumo 15 minutos
		$hora=GLO_TURSumo15Min($hora); 
	}
	//fin td contiene horarios del dia 

	$tablaclientes .="</table></td>"; 	
	$tablaclientes .="<td class="."TablaTituloRight"." style='width:0px;'> </td>"; //cierra columna dia
	
//fin Tabla general de los 14 dias
$tablaclientes .='</tr>';
include("Includes/zCerrarTDia.php");//cerrar tabla
}


GLO_InitHTML($_SESSION["NivelArbol"],'TxtExCriterio','BannerConMenuHVCMIT','TurnosCMIT/zDiaL',0,0,0,0);
GLO_tituloypath(0,1134,'DiaCMIT.php','TURNOS DIA','linksalir'); 
?>

<table width="900" border="0"  cellspacing="0" class="Tabla" >
<tr>
	<td width="150" height="3"></td>
	<td width="230"></td>
	<td width="130"></td>
	<td width="190"></td>
	<td width="200"></td>
</tr>
<tr>
	<td height="18"  align="right">Raz&oacute;n Social:</td>
	<td  valign="middle"  colspan="3"> 
<? 
	echo '<input name="TxtExCriterio" type="text" class="TextBox" style="width:200px" maxlength="20" value="';echo $_SESSION['TxtExCriterio']; echo'" tabindex="1" onKeyPress="if(event.keyCode==13){document.Formulario.CmdExBuscar.click();}"> <button name="CmdExBuscar"  type="submit" class="iconbtn2" tabindex="1" title="Buscar" value="" onClick="document.Formulario.target='."'_self'".'"><i class="fa fa-search iconsmallbt iconlgray"></i></button>&nbsp;<select name="CbIdRSF"  class="campos" id="CbIdRSF" style="width:280px" tabindex="1">'; 
	if ($_SESSION['TxtExCriterio']!=""){	GLO_CbClienteTurno("CbIdRSF",mysql_real_escape_string($_SESSION['TxtExCriterio']),$conn);}
	echo '</select>';
?><input  name="TxtId"  type="hidden"  value="<? echo $_SESSION['TxtId']; ?>"><input  name="IdConsulta"  type="hidden"   value="<? echo $_SESSION['IdConsulta']; ?>">
	</td>
	<td align="left">
		<? echo GLO_FAButton('CmdGuardar','submit','110','self','Grabar','save',''); ?>
	</td>
</tr>
<tr>
	<td height="18"  align="right"  >Facturar A:</td>
	<td  valign="middle">
		<select name="CbIdEntidad" style="width:200px; " class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("entidades","CbIdEntidad","Nombre","","",$conn); ?></select>
	</td>
	<td align="right">ART que lo env&iacute;a:</td>
	<td  valign="middle" colspan="2">
		<input name="TxtART"  type="text"  class="TextBox"  style="width:300px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtART'];?>">
	</td>
</tr>
<tr>
	<td height="18"  align="right">Tipo de Examen:</td>
	<td  valign="middle" >
		<select name="CbIdTipoEx" style="width:200px" class="campos" tabindex="1"><option value=""></option><? ComboTablaRFX("tipoexamen","CbIdTipoEx","Id","","",$conn); ?></select>
	</td>
	<td align="right">Si es otro aclarar:</td>
	<td valign="middle" colspan="2">
		<input name="TxtObsTipo"  type="text"  class="TextBox"  style="width:300px" maxlength="50" tabindex="1"  value="<? echo $_SESSION['TxtObsTipo'];?>">
	</tr>
<tr>
	<td height="18"  align="right" valign="middle" >Detalle:</td>
	<td  valign="middle"  colspan="4">
		<textarea name="TxtDetalle" style="width:660px" rows="1" class="TextBox" onKeyPress="event.cancelBubble=true;" tabindex="1"><? echo $_SESSION['TxtDetalle']; ?></textarea>
	</td>
</tr>
<tr>
	<td height="18"  align="right"  valign="middle" >Observaciones:</td>
	<td valign="middle" colspan="4">
		<textarea name="TxtObs" style="width:660px" rows="1" class="TextBox" onKeyPress="event.cancelBubble=true;" tabindex="1"><? echo $_SESSION['TxtObs']; ?></textarea>
	</td>
</tr>
<tr>
	<td width="150" height="3"></td>
	<td width="230"></td>
	<td width="130"></td>
	<td width="190"></td>
	<td width="200"></td>
</tr>
</table>




<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="40"></td>
	</tr>
</table>

<?

GLO_mensajeerror();
MostrarTabla($conn,intval($_SESSION['IdConsulta']));
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(1120,0);
echo 'Enviar&aacute; <font class="comentario3">Mail</font>  de aviso al Cliente si el turno: tiene cliente asignado, no est&aacute; atendido y est&aacute; vigente<br>
Al pi&eacute; de cada d&iacute;a se muestra la cantidad de turnos <font class="comentario2">disponibles</font>';
GLO_endcomment();

include ("Codigo/FooterConUsuario.php");
?>

<script type="text/javascript">


	function selectAll() 
	{  
	 var items = document.getElementsByClassName('casety');  
	 for (var i=0; i<items.length; i++){  
	    if (items[i].type=='checkbox')
	    items[i].checked=true; 
	  }  
	}

	function UnSelectAll() 
	{  
	 var items = document.getElementsByClassName('casety');  
	 for (var i=0; i<items.length; i++){  
	    if (items[i].type=='checkbox')
	    items[i].checked=false; 
	  }  
	} 



</script>