<? include("FuncionesCOD.php");include("FuncionesCOM.php");

function GLO_generoID($tabla,$conn){
	$query="SELECT Max(Id) as UltimoId FROM $tabla";$rs10=mysql_query($query,$conn);$row10=mysql_fetch_array($rs10);
	if(mysql_num_rows($rs10)==0){$nroId=1;}else{$nroId=$row10['UltimoId']+1;}mysql_free_result($rs10);
	return $nroId;
}



//////////////////////////////////////////////////////
function calendario($fecha,$ruta,$tipo){
  $myCalendar = new tc_calendar($fecha, true, false);
  $myCalendar->setIcon($ruta."calendar/images/calendario.png");
  $myCalendar->setDate(date(d), date(m), date(Y)); $myCalendar->setPath("./");
  if($tipo=='actual'){$myCalendar->setYearInterval(2000, 2030);$myCalendar->dateAllow('2000-01-01', '2030-01-01');}
  if($tipo=='nac'){$myCalendar->setYearInterval(1920, 2030);$myCalendar->dateAllow('1920-01-01', '2030-01-01');}
  $myCalendar->setDateFormat('j F Y'); $myCalendar->writeScript();
}



/////////////////////////////////////////


function InsertarAuditoria($tablaaudi,$accionaudi,$regaudi,$conn){
	$fechaaudit=FechaMySqlHora(date("d-m-Y H:i:s"));$user=$_SESSION["login"];
	//generoid
	$query="SELECT Max(Id) as UltimoId FROM auditoria";	$rsvf=mysql_query($query,$conn);$rowvf=mysql_fetch_array($rsvf);
	if(mysql_num_rows($rsvf)==0){$nroIdvf=1;}else{$nroIdvf=$rowvf['UltimoId']+1;}	mysql_free_result($rsvf);
	//inserto
	$query="INSERT INTO auditoria (Id,IdTabla,IdAccion,IdRegistro,IdUsuario,Fecha) VALUES ($nroIdvf,$tablaaudi,$accionaudi,$regaudi,'$user','$fechaaudit')";	
	$rsvf=mysql_query($query,$conn);		
}




function encrypt($string, $key) {
   return base64_encode($string);
}


function decrypt($string, $key) {
   return base64_decode($string);
}




function CalcularHorasTranscurridas($hora1,$hora2,$fecha1,$fecha2){
if ($fecha1=='' or $fecha2==''){$res="00:00";}
else{
		list($h1,$m1,$s1)=explode(":",$hora1);
		list($h2,$m2,$s2)=explode(":",$hora2);
		$minutos1=$m1+$h1*60;
		$minutos2=$m2+$h2*60;
		$dia1=date('d',strtotime($fecha1));
		$dia2=date('d',strtotime($fecha2));
		if($dia1==$dia2){$diasiguiente=0;}//mismo dia
		if($dia1<$dia2){$diasiguiente=1;}//dia anterior
		if($dia1>$dia2){$diasiguiente=2;$res="00:00";}//error
		//verifico mismo dia
		if($diasiguiente==0){$minutosdif=$minutos2-$minutos1;}
		if($diasiguiente==1){$minutosdif=24*60-$minutos1+$minutos2;}
		//construyo resultado
		if($diasiguiente!=2){
				$H = intval($minutosdif / 60);$M = ($minutosdif - ($H * 60)); 
				$res = $H.":".$M; 
		}
	}
	//fin
	return $res;
}	

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
		$nomdia='Miercoles';break;
	case 4:
		$nomdia='Jueves';break;
	case 5:
		$nomdia='Viernes';break;	
	case 6:
		$nomdia='Sabado';break;	
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

function CalcularHoras($hora1,$hora2){
	list($h1,$m1,$s1)=explode(":",$hora1);
	list($h2,$m2,$s2)=explode(":",$hora2);
	$res=24-$h1+$h2;
	return $res;
}	



function cuitValido($cuit,&$cuit_rearmado)
{

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


function FormatoFecha($fechavieja){
	list($f,$h)=explode(" ",$fechavieja);
    list($a,$m,$d)=explode("-",$f);
    return $d."-".$m."-".$a;}
	
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
	
function FechaMesAño($fechavieja){
	list($f,$h)=explode(" ",$fechavieja);
	list($a,$m,$d)=explode("-",$f);
	return $m."-".$a;
}

function edad($edad){
list($anio,$mes,$dia) = explode("-",$edad);
$anio_dif = date("Y") - $anio;$mes_dif = date("m") - $mes;$dia_dif = date("d") - $dia;
if (($mes_dif < 0) or($dia_dif < 0 and $mes_dif == 0))
$anio_dif--;
return $anio_dif;
}	

function dias_transcurridos($fecha_i,$fecha_f){
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
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



function LugarFechaLargo($fecha){ 
	list($d,$m,$a)=explode("-",$fecha);
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
	return "Neuquén, $d de $mes de $a";
}

function ComboMes(){
$combo="";
if( "1" == $_SESSION[CbMes]) { $combo .= " <option value="."'1'"." selected='selected'>"."Enero"."</option>\n";}
else{$combo .= " <option value="."'1'"." >"."Enero"."</option>\n";}
if( "2" == $_SESSION[CbMes]) { $combo .= " <option value="."'2'"." selected='selected'>"."Febrero"."</option>\n";}
else{$combo .= " <option value="."'2'"." >"."Febrero"."</option>\n";}
if( "3" == $_SESSION[CbMes]) { $combo .= " <option value="."'3'"." selected='selected'>"."Marzo"."</option>\n";}
else{$combo .= " <option value="."'3'"." >"."Marzo"."</option>\n";}
if( "4" == $_SESSION[CbMes]) { $combo .= " <option value="."'4'"." selected='selected'>"."Abril"."</option>\n";}
else{$combo .= " <option value="."'4'"." >"."Abril"."</option>\n";}
if( "5" == $_SESSION[CbMes]) { $combo .= " <option value="."'5'"." selected='selected'>"."Mayo"."</option>\n";}
else{$combo .= " <option value="."'5'"." >"."Mayo"."</option>\n";}
if( "6" == $_SESSION[CbMes]) { $combo .= " <option value="."'6'"." selected='selected'>"."Junio"."</option>\n";}
else{$combo .= " <option value="."'6'"." >"."Junio"."</option>\n";}
if( "7" == $_SESSION[CbMes]) { $combo .= " <option value="."'7'"." selected='selected'>"."Julio"."</option>\n";}
else{$combo .= " <option value="."'7'"." >"."Julio"."</option>\n";}
if( "8" == $_SESSION[CbMes]) { $combo .= " <option value="."'8'"." selected='selected'>"."Agosto"."</option>\n";}
else{$combo .= " <option value="."'8'"." >"."Agosto"."</option>\n";}
if( "9" == $_SESSION[CbMes]) { $combo .= " <option value="."'9'"." selected='selected'>"."Septiembre"."</option>\n";}
else{$combo .= " <option value="."'9'"." >"."Septiembre"."</option>\n";}
if( "10" == $_SESSION[CbMes]) { $combo .= " <option value="."'10'"." selected='selected'>"."Octubre"."</option>\n";}
else{$combo .= " <option value="."'10'"." >"."Octubre"."</option>\n";}
if( "11" == $_SESSION[CbMes]) { $combo .= " <option value="."'11'"." selected='selected'>"."Noviembre"."</option>\n";}
else{$combo .= " <option value="."'11'"." >"."Noviembre"."</option>\n";}
if( "12" == $_SESSION[CbMes]) { $combo .= " <option value="."'12'"." selected='selected'>"."Diciembre"."</option>\n";}
else{$combo .= " <option value="."'12'"." >"."Diciembre"."</option>\n";}
echo $combo;
}



function ComboAño(){
$combo="";
if( "2012" == $_SESSION[CbAño]) { $combo .= " <option value="."'2012'"." selected='selected'>"."2012"."</option>\n";}
else{$combo .= " <option value="."'2012'"." >"."2012"."</option>\n";}
if( "2013" == $_SESSION[CbAño]) { $combo .= " <option value="."'2013'"." selected='selected'>"."2013"."</option>\n";}
else{$combo .= " <option value="."'2013'"." >"."2013"."</option>\n";}
if( "2014" == $_SESSION[CbAño]) { $combo .= " <option value="."'2014'"." selected='selected'>"."2014"."</option>\n";}
else{$combo .= " <option value="."'2014'"." >"."2014"."</option>\n";}
if( "2015" == $_SESSION[CbAño]) { $combo .= " <option value="."'2015'"." selected='selected'>"."2015"."</option>\n";}
else{$combo .= " <option value="."'2015'"." >"."2015"."</option>\n";}
if( "2016" == $_SESSION[CbAño]) { $combo .= " <option value="."'2016'"." selected='selected'>"."2016"."</option>\n";}
else{$combo .= " <option value="."'2016'"." >"."2016"."</option>\n";}
echo $combo;
}


function ComboTablaRFX($tabla,$campo,$orden,$arbol,$where,$conn){
$query="SELECT Id,Nombre FROM $tabla where Id<>0 $where Order by $orden";$rs=mysql_query($query,$conn);
$combo="";
while($row=mysql_fetch_array($rs)){ 
  if( $row['Id'] == $_SESSION[$campo]) {$combo .= " <option value='".$row['Id']."' selected='"."selected"."'>".$row['Nombre']."</option>\n";
  }else{ $combo .= " <option value='".$row['Id']."'>".$row['Nombre']."</option>\n";   }}
echo $combo;mysql_free_result($rs);
}


/////////////////////////MAILS ///////////////////////////////
function EnviarMailRoot($para,$asunto,$cuerpo,$adjunto,$mailcopia){ 
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
	//adjuntos
	if($adjunto!=''){foreach( $fadjuntos as $adj ) {if ($adj!=''){$mail->AddAttachment($adj);}}	} 	
	$exito = $mail->Send();
    $intentos=1; 
    while((!$exito)&&($intentos<2)&&($mail->ErrorInfo!="SMTP Error: Data not accepted")){//hace un intento de envío
        sleep(5);$exito = $mail->Send();$intentos=$intentos+1;                
    }
    if ($mail->ErrorInfo=="SMTP Error: Data not accepted") { $exito=true;}
	return $exito; //devuelve 1 si envió ok
}





function EnviarMail($a,$asunto,$cuerpo,$adjunto,$conn){ 		
	$para = explode( ",", $a );
	
	$query="SELECT * From parametros";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
	if(mysql_num_rows($rs)!=0){
		$de=$row['MailFrom'];$pass=$row['Password'];$usuario=$row['Usuario'];$servidor=$row['ServerSMTP'];		
	}mysql_free_result($rs);
	
	EnviarMailRoot($para,$asunto,$cuerpo,$adjunto,$mailcopia);
}


function EnviarMailBCC($a,$asunto,$cuerpo,$adjunto,$conn,$mailcopia){ 
	$para = explode( ",", $a );

	$query="SELECT * From parametros";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
	if(mysql_num_rows($rs)!=0){
		$de=$row['MailFrom'];$pass=$row['Password'];$usuario=$row['Usuario'];$servidor=$row['ServerSMTP'];		
	}mysql_free_result($rs);
	
	EnviarMailRoot($para,$asunto,$cuerpo,$adjunto,$mailcopia);

}



?>