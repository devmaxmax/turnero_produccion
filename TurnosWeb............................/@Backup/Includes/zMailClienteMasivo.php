<? 

//enviar mail
if($u!='' and $u!='ngrunmann@gmail.com'){	
	$a=$u;
	//recuento de turnos
	$query="SELECT Id,Fecha,Hora FROM turnos where Id IN(".$listadoturnos.") Order By Fecha,Hora";$rs2=mysql_query($query,$conn);
	while($row2=mysql_fetch_array($rs2)){
	$f=$row2['Fecha'];$h=$row2['Hora'];$nroturno=str_pad($row2['Id'], 6, "0", STR_PAD_LEFT);
	if($f!=$dialistado and $dialistado!=''){$detmail=$detmail.'<BR>';} $dialistado=$f;
	$detmail=$detmail.$nroturno.' '.ObtenerDiaSemanaCorto(FormatoFecha($f)).' '.FormatoFecha($f).' '.date("H:i",strtotime($h)).'<BR>';
	}mysql_free_result($rs2);
	$cond=GLO_TURCondicionesMail($conn);//condiciones
	//envio mail cliente
	$asunto='Turnos CMIT - Mail para el Cliente';
	$cuerpo .='<BODY><FONT FACE="arial"><SMALL>';
	$cuerpo .='--------------------------------------------------------------------------------<BR>';
	$cuerpo .='COMPROBANTE DE TURNO PARA CLIENTE<BR>';
	$cuerpo .='--------------------------------------------------------------------------------<BR>';			
	$cuerpo .='<BR>LUGAR: CMIT de Salud Ocupacional SRL<BR>DIRECCION: Bouquet Roldan 116. Neuquen Capital.<BR><BR>';
	$cuerpo .='EMPRESA: '.$empresa.'<BR>';
	$cuerpo .='CUIT: '.$cuit.'<BR>';
	$cuerpo .='ART: '.$art.'<BR><BR>';
	$cuerpo .='TIPO: '.$tipoex1.' '.$obst.'<BR>';
	$cuerpo .='DETALLE: '.$det.'<BR><BR>';
	$cuerpo .='OBSERVACIONES: '.$obs.'<BR><BR>';
	$cuerpo .='TURNOS:<BR>'.$detmail.'<BR><BR>';
	$cuerpo .='--------------------------------------------------------------------------------<BR>';
	$cuerpo .='SOLO SERAN ATENDIDOS PRESENTANDO DNI ORIGINAL CON FOTO<BR>';
	$cuerpo .='--------------------------------------------------------------------------------<BR><BR>';	
	$cuerpo .='<I>'.$cond.'</I><BR>';		
	$cuerpo .='</SMALL></FONT></BODY>';			
	//envia mail a usuario y copia oculta a cmit
	$horaturno=date("H:i",strtotime($h));		
	$asuntobcc=$asunto.' '.GLO_TURSobreturnoLY($horaturno);		
	$resultenvio=EnviarMailUsuarioBCC($a,$asuntobcc,$cuerpo,$adjunto,0,$conn);
}


?>

