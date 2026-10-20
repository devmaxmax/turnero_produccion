<? 

//enviar mail
if($u!='' and $u!='ngrunmann@gmail.com'){	
	$a=$u;
	//recuento de turnos
	$query="SELECT Id,Fecha,Hora,STurno FROM turnos where Id IN(".$listadoturnos.") Order By Fecha,Hora";$rs2=mysql_query($query,$conn);
	while($row2=mysql_fetch_array($rs2)){
	$essobreturno=$row2['STurno'];$nroturno=str_pad($row2['Id'], 6, "0", STR_PAD_LEFT);
	$f=$row2['Fecha'];$h=GLO_TURSobreturnoHora(date("H:i",strtotime($row2['Hora'])),$row2['STurno']);	
	if($f!=$dialistado and $dialistado!=''){$detmail=$detmail.'<BR>';} $dialistado=$f;
	$detmail=$detmail.$nroturno.' '.ObtenerDiaSemanaCorto(FormatoFecha($f)).' '.FormatoFecha($f).' '.$h.' '.GLO_TURSobreturnoLY($essobreturno).'<BR>';
	}mysql_free_result($rs2);
	//envio mail cliente
	$asunto='Turnos CMIT - Mail para el Cliente';
	include("../Includes/zMailCuerpoI.php");
	$cuerpo .='--------------------------------------------------------------------------------<BR>';
	$cuerpo .='COMPROBANTE DE TURNO PARA PACIENTE SIN SINTOMAS<BR>';
	$cuerpo .='--------------------------------------------------------------------------------<BR>';			
	$cuerpo .='<BR>LUGAR: CMIT de Salud Ocupacional SRL<BR>DIRECCION: Juan B Justo 825. Neuquen Capital.<BR><BR>';
	$cuerpo .='- ANUNCIESE POR PORTERO Y AGUARDE INDICACIONES -<BR><BR>';
	$cuerpo .='EMPRESA: '.$empresa.'<BR>';
	$cuerpo .='CUIT: '.$cuit.'<BR><BR>';
	$cuerpo .='DETALLE:<BR>'.$tipoex1.'<BR><BR>';
	$cuerpo .='TURNOS:<BR>'.$detmail.'<BR><BR>';
	$cuerpo .='--------------------------------------------------------------------------------<BR>';
	$cuerpo .='SOLO SERAN ATENDIDOS PRESENTANDO DNI ORIGINAL CON FOTO<BR>';
	$cuerpo .='--------------------------------------------------------------------------------<BR><BR>';	
	include("../Includes/zMailCuerpoF.php");		
	//envia mail a usuario y copia oculta a cmit	
	$resultenvio=EnviarMailUsuarioBCC($a,$asunto,$cuerpo,$adjunto,0,$conn);
}


?>

