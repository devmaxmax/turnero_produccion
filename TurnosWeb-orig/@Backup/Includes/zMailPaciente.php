<? 

//datos
$asunto='Turnos CMIT - Mail para el Paciente ('.$pac.')';$adjunto='';$cuerpo='';
//cuerpo
$cuerpo .='<BODY><FONT FACE="arial"><SMALL>';
$cuerpo .='--------------------------------------------------------------------------------<BR>';
$cuerpo .='COMPROBANTE DE TURNO PARA CLIENTE<BR>';
$cuerpo .='--------------------------------------------------------------------------------<BR>';			
$cuerpo .='<BR>LUGAR: CMIT de Salud Ocupacional SRL<BR>DIRECCION: Bouquet Roldan 116. Neuquen Capital.<BR><BR>';
$cuerpo .='N°TURNO: '.$nroturno.'<BR>';
$cuerpo .='FECHA: '.$fecha.'<BR>';
$cuerpo .='HORA: '.$hora.'<BR><BR>';
$cuerpo .='EMPRESA: '.$empresa.'<BR>';
$cuerpo .='CUIT: '.$cuit.'<BR>';
$cuerpo .='ART: '.$art.'<BR><BR>';
$cuerpo .='DATOS DEL PACIENTE:<BR>';			
$cuerpo .='APELLIDO Y NOMBRE: '.$pac.'<BR>';
$cuerpo .='DNI: '.$dnip.'<BR>';
$cuerpo .='PUESTO: '.$pto.'<BR><BR>';
$cuerpo .='--------------------------------------------------------------------------------<BR>';
$cuerpo .='SOLO SERA ATENDIDO PRESENTANDO DNI ORIGINAL CON FOTO<BR>';
$cuerpo .='--------------------------------------------------------------------------------<BR>';			
$cuerpo .='</SMALL></FONT></BODY>';	
//enviar mail a paciente
$resultenvio=EnviarMailUsuario($a,$asunto,$cuerpo,$adjunto,$conn);	

	
?>

