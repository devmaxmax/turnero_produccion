<? include("FuncionesCOD.php");include("FuncionesCOM.php");include("FuncionesTUR.php");

//seguridad
function GLO_ValidaGETTUR($varget,$var1,$var2,$volver){//valida que no se acceda con GET vacio a esta pgina
	if($varget==''){ header("Location:".$_SESSION["NivelArbol"].$volver.".php");}
}
function GLO_ValidaUSERTUR($usuario,$id,$volver,$conn){
	//valida que acceda a turno de su usuario, que no est borrado, vigentes
	$hoy=date("d-m-Y");$fecha=date("d-m-Y", strtotime("$hoy -7 day"));	$wfechad="and DATEDIFF(t.Fecha,'".FechaMySql($fecha)."')>=0";
	//
	$query="SELECT t.Id From turnos t where t.IdUsuario='$usuario' $wfechad and t.Estado<>3 and t.Id=$id";
	$rs10=mysql_query($query,$conn);$row10=mysql_fetch_array($rs10);
	if(mysql_num_rows($rs10)==0){$existe=0;}else{$existe=1;}mysql_free_result($rs10);
	if($existe==0){ mysql_close($conn);header("Location:".$_SESSION["NivelArbol"].$volver.".php");}
}
function GLO_ValidaUSERCLI($usuario,$id,$volver,$conn){
	//valida que acceda a cli de su usuario
	$query="SELECT t.Id From usuariosclientes t where t.IdUsuario='$usuario' and t.Id=$id";
	$rs10=mysql_query($query,$conn);$row10=mysql_fetch_array($rs10);
	if(mysql_num_rows($rs10)==0){$existe=0;}else{$existe=1;}mysql_free_result($rs10);
	if($existe==0){ mysql_close($conn);header("Location:".$_SESSION["NivelArbol"].$volver.".php");}
}

function GLO_windowclose($v1){
	echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}






//nuevo id
function GLO_generoID($tabla,$conn){
	$query="SELECT Max(Id) as UltimoId FROM $tabla";$rs10=mysql_query($query,$conn);$row10=mysql_fetch_array($rs10);
	if(mysql_num_rows($rs10)==0){$nroId=1;}else{$nroId=$row10['UltimoId']+1;}mysql_free_result($rs10);
	return $nroId;
}



//fecha
function GLO_calendario($fecha,$ruta,$tipo,$tab){ 
	if($tab!=0){$tab='tabindex="'.$tab.'"';}else{$tab='';}
	echo '<input name="'.$fecha.'"  id="'.$fecha.'" type="text" class="TextBox"  style="width:100px" maxlength="10" '.$tab.' onchange="this.value=validarFecha(this.value);" value="'.$_SESSION[$fecha].'">';
	calendario($fecha,$ruta,$tipo);
}
function calendario($fecha,$ruta,$tipo){
  $myCalendar = new tc_calendar($fecha, true, false);
  $myCalendar->setIcon($ruta."calendar/images/calendario.png");
  $myCalendar->setDate(date('d'), date('m'), date('Y')); $myCalendar->setPath("./");
  if($tipo=='actual'){$myCalendar->setYearInterval(2000, 2030);$myCalendar->dateAllow('2000-01-01', '2030-01-01');}
  if($tipo=='nac'){$myCalendar->setYearInterval(1920, 2030);$myCalendar->dateAllow('1920-01-01', '2030-01-01');}
  $myCalendar->setDateFormat('j F Y'); $myCalendar->writeScript();
}
function LugarFechaLargo($fecha){ 
	list($d,$m,$a)=explode("-",$fecha);
	switch ($m) {
		case 1:	$mes="Enero";break;
		case 2:	$mes="Febrero";break;
		case 3:	$mes="Marzo";break;
		case 4:	$mes="Abril";break;
		case 5:	$mes="Mayo";break;	
		case 6:	$mes="Junio";break;	
		case 7:	$mes="Julio";break;	
		case 8:	$mes="Agosto";break;	
		case 9:	$mes="Septiembre";break;	
		case 10:$mes="Octubre";break;	
		case 11:$mes="Noviembre";break;	
		case 12:$mes="Diciembre";break;	
	}
	$lugaru = utf8_decode(Neuquén);
	return "$lugaru, $d de $mes de $a";
}


//auditoria
function InsertarAuditoria($tablaaudi,$accionaudi,$regaudi,$conn){
	$fechaaudit=FechaMySqlHora(date("d-m-Y H:i:s"));$user=$_SESSION["login"];
	//generoid
	$query="SELECT Max(Id) as UltimoId FROM auditoria";	$rsvf=mysql_query($query,$conn);$rowvf=mysql_fetch_array($rsvf);
	if(mysql_num_rows($rsvf)==0){$nroIdvf=1;}else{$nroIdvf=$rowvf['UltimoId']+1;}	mysql_free_result($rsvf);
	//inserto
	$query="INSERT INTO auditoria (Id,IdTabla,IdAccion,IdRegistro,IdUsuario,Fecha) VALUES ($nroIdvf,$tablaaudi,$accionaudi,$regaudi,'$user','$fechaaudit')";	
	$rsvf=mysql_query($query,$conn);		
}


//utf
function GLO_textoFPDF($texto){
	//$texto=utf8_decode($texto);
	return $texto;
}


//encriptar
function encrypt($string, $key) {
   return base64_encode($string);
}

function decrypt($string, $key) {
   return base64_decode($string);
}




//dia semana
function ObtenerDiaSemana($fecha){//0=domingo	
	$numdia=date('w',strtotime($fecha));
	switch ($numdia) {
	case 0:
		$nomdia='Domingo';break;
	case 1:
		$nomdia='Lunes';break;
	case 2:
		$nomdia='Martes';break;
	case 3:
		$nomdia='Mi&eacute;rcoles';break;
	case 4:
		$nomdia='Jueves';break;
	case 5:
		$nomdia='Viernes';break;	
	case 6:
		$nomdia='S&aacute;bado';break;	
	}
	return $nomdia;
}	

function ObtenerDiaSemanaCorto($fecha){//0=domingo	
	$numdia=date('w',strtotime($fecha));
	switch ($numdia) {
	case 0:
		$nomdia='Do';break;
	case 1:
		$nomdia='Lu';break;
	case 2:
		$nomdia='Ma';break;
	case 3:
		$nomdia='Mi';break;
	case 4:
		$nomdia='Ju';break;
	case 5:
		$nomdia='Vi';break;	
	case 6:
		$nomdia='Sa';break;	
	}
	return $nomdia;
}	

function CompararFechas($fecha1,$fecha2){
	$fecha1 = strtotime($fecha1);
	$fecha2 = strtotime($fecha2);	
	if($fecha1 > $fecha2){$res=1;}
	if($fecha1 < $fecha2){$res=2;}
	if($fecha1 == $fecha2){$res=0;}	
	return $res;
}	



//cuit
function cuitValido($cuit,&$cuit_rearmado){

	$coeficiente[0]=5;
	$coeficiente[1]=4;
	$coeficiente[2]=3;
	$coeficiente[3]=2;
	$coeficiente[4]=7;
	$coeficiente[5]=6;
	$coeficiente[6]=5;
	$coeficiente[7]=4;
	$coeficiente[8]=3;
	$coeficiente[9]=2;

	$resultado=1;
	$resultadofuncion=1;

	for ($i=0; $i < strlen($cuit); $i= $i +1) {    //separo cualquier caracter que no tenga que ver con numeros
		if ((Ord(substr($cuit, $i, 1)) >= 48) && (Ord(substr($cuit, $i, 1)) <= 57)){
			$cuit_rearmado = $cuit_rearmado . substr($cuit, $i, 1);
		}
	}

	If (strlen($cuit_rearmado) <> 11) {  // si to estan todos los digitos
		$resultado=0;
		$resultadofuncion=0;
	} Else {
		$sumador = 0;
		$verificador = substr($cuit_rearmado, 10, 1); //tomo el digito verificador
		

		For ($i=0; $i <=9; $i=$i+1) { //separo cada digito y lo multiplico por el coeficiente
			$sumador = $sumador + (substr($cuit_rearmado, $i, 1)) * $coeficiente[$i];
		}

		$resultado = $sumador % 11;
		$resultado = 11 - $resultado;  //saco el digito verificador
		if ($resultado==11){$resultado=0;}
		$veri_nro = intval($verificador);
		If ($veri_nro <> $resultado) {
			$resultado=0;
			$resultadofuncion=0;
		} else { 
			$cuit_rearmado = substr($cuit_rearmado, 0, 2) . "-" . substr($cuit_rearmado, 2, 8) . "-" . substr($cuit_rearmado, 10, 1); 
		}
	}
	return $resultadofuncion;
}



function GLO_FormatoHora($var){
	$var=date("H:i",strtotime($var)); if ($var=='00:00'){$var="";}
    return $var;
}
function GLO_FormatoFecha($f){
	list($a,$m,$d)=explode("-",$f);$var=$d."-".$m."-".$a;
	if ($var=='00-00-0000'){$var ="";}
    return $var;
}
function GLO_FechaMySql($var){
	if ($var==''){$var ="0000-00-00";}
	else{list($d,$m,$a)=explode("-",$var);$var=$a."-".$m."-".$d;}
	return $var;
}



function FormatoFecha($f){
    list($a,$m,$d)=explode("-",$f);
    return $d."-".$m."-".$a;
}
	
function FechaMySql($fechavieja){
    list($d,$m,$a)=explode("-",$fechavieja);
    return $a."-".$m."-".$d;}

function FechaMySqlHora($fechavieja){
	list($f,$h)=explode(" ",$fechavieja);
    list($d,$m,$a)=explode("-",$f);
    return $a."-".$m."-".$d.' '.$h;}

function FormatoFechaHora($fechavieja){
	list($f,$h)=explode(" ",$fechavieja);
    list($a,$m,$d)=explode("-",$f);
    return $d."-".$m."-".$a.' '.$h;
}
	
function edad($edad){
list($anio,$mes,$dia) = explode("-",$edad);
$anio_dif = date("Y") - $anio;$mes_dif = date("m") - $mes;$dia_dif = date("d") - $dia;
if (($mes_dif < 0) or($dia_dif < 0 and $mes_dif == 0))
$anio_dif--;
return $anio_dif;
}	

function dias_transcurridos($fecha_i,$fecha_f){//sin signo
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias;
}
function GLO_diastranscurridosCS($fecha_i,$fecha_f){//con signo
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= $dias; $dias = floor($dias);		
	return $dias;
}


function G_NombreMes($m){ 
	switch ($m) {
	case 1:
		$mes="Enero";break;
	case 2:
		$mes="Febrero";break;
	case 3:
		$mes="Marzo";break;
	case 4:
		$mes="Abril";break;
	case 5:
		$mes="Mayo";break;	
	case 6:
		$mes="Junio";break;	
	case 7:
		$mes="Julio";break;	
	case 8:
		$mes="Agosto";break;	
	case 9:
		$mes="Septiembre";break;	
	case 10:
		$mes="Octubre";break;	
	case 11:
		$mes="Noviembre";break;	
	case 12:
		$mes="Diciembre";break;	
	}		
	return $mes;
}





//tabla
function ComboTablaRFX($tabla,$campo,$orden,$arbol,$where,$conn){
$query="SELECT Id,Nombre FROM $tabla where Id<>0 $where Order by $orden";$rs=mysql_query($query,$conn);
$combo="";
while($row=mysql_fetch_array($rs)){ 
  if( $row['Id'] == $_SESSION[$campo]) {$combo .= " <option value='".$row['Id']."' selected='"."selected"."'>".$row['Nombre']."</option>\n";
  }else{ $combo .= " <option value='".$row['Id']."'>".$row['Nombre']."</option>\n";   }}
echo $combo;mysql_free_result($rs);
}


//mails
function EnviarMailRoot($para,$asunto,$cuerpo,$adjunto,$mailcopia,$de,$pass,$usuario,$servidor,$mailalertas){ 
	//las direcciones deben separarse con coma
	require_once('PHPMailer/class.phpmailer.php'); 
	error_reporting(0);
	$fadjuntos = explode( ",", $adjunto);
	//enviar
	$mail = new phpmailer();
	$mail->Mailer = "smtp";
	$mail->Host = $servidor;
	$mail->SMTPAuth = true;
	$mail->Username = $usuario;
	$mail->Password = $pass;
	$mail->IsHTML(true);
	$mail->From = $de;
	$mail->FromName = $de;
	$mail->Subject = $asunto;
	$body = $cuerpo;
	 //---
	$mail->Body = $body;
	$mail->AltBody = $altbody;
	$mail->Timeout=300;
	//destinatarios
	foreach( $para as $destino ) {if ($destino!=''){$mail->addAddress( $destino );}}
	//copia oculta
	if($mailcopia!=''){$mail->AddBCC( $mailcopia );}
	if($mailalertas!=''){$mail->AddBCC( $mailalertas );}
	//adjuntos
	if($adjunto!=''){foreach( $fadjuntos as $adj ) {if ($adj!=''){$mail->AddAttachment($adj);}}	} 	
	$exito = $mail->Send();
    $intentos=1; 
    while((!$exito)&&($intentos<2)&&($mail->ErrorInfo!="SMTP Error: Data not accepted")){//hace un intento de envo
        sleep(5);$exito = $mail->Send();$intentos=$intentos+1;                
    }
    if ($mail->ErrorInfo=="SMTP Error: Data not accepted") { $exito=true;}
	return $exito; //devuelve 1 si envi ok
}


function EnviarMailAlerta($asunto,$cuerpo,$adjunto,$conn){ //envia mail a facturacion@		
	$query="SELECT * From parametros";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
	if(mysql_num_rows($rs)!=0){
		$de=$row['MailFrom'];$pass=$row['Password'];$usuario=$row['Usuario'];$servidor=$row['ServerSMTP'];$mailalertas=$row['MailToAlertas'];		
	}mysql_free_result($rs);	
	//envia $para y $mailcopia ya separados por comas
	$para=explode( ",", $mailalertas );$mailcopia='';$mailalertas='';
	$exito=EnviarMailRoot($para,$asunto,$cuerpo,$adjunto,$mailcopia,$de,$pass,$usuario,$servidor,$mailalertas);
	return $exito; 
}

function EnviarMailUsuario($a,$asunto,$cuerpo,$adjunto,$conn){ //envia mail al cliente		
	$query="SELECT * From parametros";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
	if(mysql_num_rows($rs)!=0){
		$de=$row['MailFrom'];$pass=$row['Password'];$usuario=$row['Usuario'];$servidor=$row['ServerSMTP'];	
	}mysql_free_result($rs);	
	//envia $para y $mailcopia ya separados por comas
	$para = explode( ",", $a );$mailcopia='';$mailalertas='';
	$exito=EnviarMailRoot($para,$asunto,$cuerpo,$adjunto,$mailcopia,$de,$pass,$usuario,$servidor,$mailalertas);
	return $exito; 
}


function EnviarMailUsuarioBCC($a,$asunto,$cuerpo,$adjunto,$alerta,$conn){ //envia mail al cliente y copia oculta cmit	
	$query="SELECT * From parametros";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
	if(mysql_num_rows($rs)!=0){
		$de=$row['MailFrom'];$pass=$row['Password'];$usuario=$row['Usuario'];$servidor=$row['ServerSMTP'];
		$mailalertas=$row['MailToAlertas'];$mailcopia=$row['MailCopia'];	
	}mysql_free_result($rs);
	//valida si corresponde tambien mailcopia a facturacion@ x cliente riesgo($alerta=0 no lo valida)
	//alerta trae checkriesgo del usuario, en mails generados por el usuario, no por cmit
	if($alerta==0){$mailalertas='';}				
	//envia $para y $mailcopia ya separados por comas
	$para = explode( ",", $a );
	$exito=EnviarMailRoot($para,$asunto,$cuerpo,$adjunto,$mailcopia,$de,$pass,$usuario,$servidor,$mailalertas);
	return $exito; 
}



?>