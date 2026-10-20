<? include("../Codigo/Seguridad.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

if (isset($_POST['CmdAceptar'])){
	if ( empty($_POST['TxtPaciente']) or ( empty($_POST['ChkE1']) and empty($_POST['ChkE2']) and empty($_POST['ChkE3']) and empty($_POST['ChkE4']) and empty($_POST['ChkE5']) ) ){
		foreach($_POST as $key => $value){	$_SESSION[$key] = $value;}	
		$_SESSION['GLO_msgE']="No se grabo. Por favor complete el Paciente y Estudios";	
		header("Location:Alta.php");	
	}else{
		//grabar los datos en la tabla
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		$fecha=$_POST['TxtFecha'];
		$hora=$_POST['TxtHora'];
		$varagenda=intval($_POST['TxtIdAgenda']);
		$u=mysql_real_escape_string($_POST['TxtIdUsuario']);
		$rsf=intval($_POST['CbIdRSF']);
		include ("../Includes/zDatosTurno.php");
		//variables
		include("../Includes/zVariables.php");
		list($h1,$m1)=explode(":",$hora);$horamin=$m1+($h1*60);
		//tipo dia y turnos disponibles
		include("../Includes/zTipoDia.php");
		//si no esta ocupado grabo
		if($ocupado==0){
			$fecha=FechaMySql($_POST['TxtFecha']);
			//inserto
			$nroId=GLO_generoID("turnos",$conn);
			$query="INSERT INTO turnos (Id,IdAgenda,IdUsuario,Obs,Paciente,DNIP,IdTipoEx,IdEntidad,EnvioMail,ART,IdRSF,Fecha,Hora,Cmit,Estado,Acepto,Carga,FPago1,FPago2,STurno,E1,E2,E3,E4,E5) VALUES ($nroId,$varagenda,'$u','$obs','$pac','$dnip',0,0,'','',$rsf,'$fecha','$hora',0,0,1,'',0,0,0,$e1,$e2,$e3,$e4,$e5)";$rs=mysql_query($query,$conn);
			if ($rs){
				GLO_feedback(1);
				//envio mail
				$fecha=$_POST['TxtFecha'];
				//trae RSF de usuarios
				$query="SELECT u.RSF,u.CUITF,u.Riesgo,u.FPago FROM usuarios u where u.Usuario='$u'";
				$rs2=mysql_query($query,$conn);
				while($row2=mysql_fetch_array($rs2)){
					$rsf0=$row2['RSF'];$cuit0=$row2['CUITF'];
					$alerta=GLO_TURRiesgo2($row2['Riesgo'],$row2['FPago']);
				}mysql_free_result($rs2);
				//trae datos combos
				$query="Select e.Nombre as Entidad,uc.RSF,uc.CUITF,t.STurno,t.Hora,t.E1,t.E2,t.E3,t.E4,t.E5  From turnos t,entidades e,usuariosclientes uc Where t.Id<>0 and t.IdEntidad=e.Id and uc.Id=t.IdRSF and t.Id=$nroId";
				$rs2=mysql_query($query,$conn);	
				while($row2=mysql_fetch_array($rs2)){
					$mostrartipoex=1;include("../Includes/zTipoExamen.php");			
					$essobreturno=$row2['STurno'];$rsf1=$row2['RSF'];$cuit1=$row2['CUITF'];
					$hora=GLO_TURSobreturnoHora(date("H:i",strtotime($row2['Hora'])),$row2['STurno']);
				}mysql_free_result($rs2);
				if($rsf==0){$empresa=$rsf0;$cuit=$cuit0;}else{$empresa=$rsf1;$cuit=$cuit1;}
				//envio mail cliente
				$nroturno=str_pad($nroId, 6, "0", STR_PAD_LEFT);
				$a=$_POST['TxtIdUsuario'];$asunto='Turnos CMIT - Mail para el Cliente ('.$pac.')';$adjunto='';$cuerpo='';
				include("../Includes/zMailCuerpoI.php");
				$cuerpo .='--------------------------------------------------------------------------------<BR>';
				$cuerpo .='COMPROBANTE DE TURNO PARA PACIENTE SIN SINTOMAS<BR>';
				$cuerpo .='--------------------------------------------------------------------------------<BR><BR>';	
				include("../Includes/zMailCliente.php");
				$cuerpo .='--------------------------------------------------------------------------------<BR>';
				$cuerpo .='SOLO SERA ATENDIDO PRESENTANDO DNI ORIGINAL CON FOTO<BR>';
				$cuerpo .='--------------------------------------------------------------------------------<BR><BR>';	
				include("../Includes/zMailCuerpoF.php");	
				//envia mail a usuario y copia oculta a cmit
				$asunto=$asunto.' '.GLO_TURSobreturnoLY($essobreturno);
				$resultenvio=EnviarMailUsuarioBCC($a,$asunto,$cuerpo,$adjunto,$alerta,$conn);					
			}else{GLO_feedback(2);} 
		}else{GLO_feedback(29);}
		mysql_close($conn); 
		//volver
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}
		header("Location:../Inicio.php");
	}
}


?>

