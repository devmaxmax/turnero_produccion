<? 

//datos
$asunto='Turnos CMIT - Mail para el Paciente ('.$pac.')';$adjunto='';$cuerpo='';
$asunto=$asunto.' '.GLO_TURSobreturnoLY($essobreturno);
//cuerpo
include("../Includes/zMailCuerpoI.php");
$cuerpo .='--------------------------------------------------------------------------------<BR>';
$cuerpo .='COMPROBANTE DE TURNO PARA CLIENTE<BR>';
$cuerpo .='--------------------------------------------------------------------------------<BR>';			
$cuerpo .='<BR>LUGAR: CMIT de Salud Ocupacional SRL<BR>DIRECCION: Juan B Justo 825. Neuquen Capital.<BR><BR>';
$cuerpo .='NRO.TURNO: '.$nroturno.'<BR>';
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
include("../Includes/zMailCuerpoF.php");
//enviar mail a paciente
$resultenvio=EnviarMailUsuario($a,$asunto,$cuerpo,$adjunto,$conn);	

	
?>

