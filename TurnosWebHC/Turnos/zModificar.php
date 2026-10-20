<? include("../Codigo/Seguridad.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

if (isset($_POST['CmdAceptar'])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	$rsf=intval($_POST['CbIdRSF']);
	$usr=mysql_real_escape_string($_POST['TxtIdUsuario']);		
	$fecha=$_POST['TxtFecha'];$hora=$_POST['TxtHora'];
	//
	include ("../Includes/zDatosTurno.php");
	//
	$query="UPDATE turnos set Obs='$obs',Paciente='$pac',DNIP='$dnip',IdRSF=$rsf,E1=$e1,E2=$e2,E3=$e3,E4=$e4,E5=$e5  Where Id=".intval($_POST['TxtNumero']);$rs=mysql_query($query,$conn);
	if ($rs){		
		//verifica si muestra campos faltantes
		$feedinc="";$feedincmail="";$feedincmail2="";
		if(empty($_POST['TxtPaciente'])){$feedinc=$feedinc."PACIENTE, ";}
		if(empty($_POST['ChkE1']) and empty($_POST['ChkE2']) and empty($_POST['ChkE3']) and empty($_POST['ChkE4']) and empty($_POST['ChkE5'])){$feedinc=$feedinc."EXAMEN, ";}
		if($feedinc!=""){
			$feedincmail="Su turno se encuentra incompleto. Por favor, no olvide agregar: ".$feedinc;
			$feedincmail2="Para ello ingrese a MIS TURNOS y luego seleccione editar en el Turno a completar.";
			$feedincmail='<strong><font color="#FF0000">'.$feedincmail.'</font></strong><BR>'.$feedincmail2.'<BR><BR>DATOS REGISTRADOS:<BR><BR>';
			$feedinc="Por favor, no olvide completar: ".$feedinc;
		}
		//trae RSF de usuarios
		$query="SELECT u.RSF,u.CUITF,u.Riesgo,u.FPago FROM usuarios u where u.Usuario='$usr'";$rs2=mysql_query($query,$conn);
		while($row2=mysql_fetch_array($rs2)){$rsf0=$row2['RSF'];$cuit0=$row2['CUITF'];$alerta=GLO_TURRiesgo($row2['Riesgo'],$row2['FPago']);}mysql_free_result($rs2);
		//trae datos combos
		$query="Select e.Nombre as Entidad,uc.RSF,uc.CUITF,t.STurno,t.Hora,t.E1,t.E2,t.E3,t.E4,t.E5  From turnos t,entidades e,usuariosclientes uc Where t.Id<>0 and t.IdEntidad=e.Id and uc.Id=t.IdRSF and t.Id=".intval($_POST['TxtNumero']);
		$rs2=mysql_query($query,$conn);	
		while($row2=mysql_fetch_array($rs2)){
			$mostrartipoex=1;include("../Includes/zTipoExamen.php");			
			$essobreturno=$row2['STurno'];$ent1=$row2['Entidad'];$rsf1=$row2['RSF'];$cuit1=$row2['CUITF'];
			$hora=GLO_TURSobreturnoHora(date("H:i",strtotime($row2['Hora'])),$row2['STurno']);
		}mysql_free_result($rs2);
		if($rsf==0){$empresa=$rsf0;$cuit=$cuit0;}else{$empresa=$rsf1;$cuit=$cuit1;}
		$cond=GLO_TURCondicionesMail($conn);//condiciones
		//envio mail cliente
		$nroturno=str_pad($_POST['TxtNumero'], 6, "0", STR_PAD_LEFT);
		$a=$_POST['TxtIdUsuario'];$asunto='Turnos CMIT - Mail para el Cliente ('.$pac.')';$adjunto='';$cuerpo='';
		include("../Includes/zMailCuerpoI.php");
		$cuerpo .='--------------------------------------------------------------------------------<BR>';
		$cuerpo .='COMPROBANTE DE TURNO PARA PACIENTE SIN SINTOMAS<BR>';
		$cuerpo .='--------------------------------------------------------------------------------<BR><BR>';	
		//$cuerpo .=$feedincmail;
		include("../Includes/zMailCliente.php");
		$cuerpo .='--------------------------------------------------------------------------------<BR>';
		$cuerpo .='SOLO SERA ATENDIDO PRESENTANDO DNI ORIGINAL CON FOTO<BR>';
		$cuerpo .='--------------------------------------------------------------------------------<BR><BR>';	
		//$cuerpo .='<I>'.$cond.'</I><BR>';	
		include("../Includes/zMailCuerpoF.php");	
		//envia mail a usuario y copia oculta a cmit
		$asunto=$asunto.' '.GLO_TURSobreturnoLY($essobreturno);
		$resultenvio=EnviarMailUsuarioBCC($a,$asunto,$cuerpo,$adjunto,$alerta,$conn);		
			
		//envio mail paciente
		//include("../Includes/zMailPaciente.php");		
		//confirma
		GLO_feedback(1);$_SESSION['GLO_msgE']=$feedinc;		
	}else{GLO_feedback(2);} 
	mysql_close($conn); 	
	//limpiar datos del form anterior
	foreach($_POST as $key => $value){	$_SESSION[$key] = "";	}
	header("Location:Enviar.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016'));
	
}



elseif (isset($_POST['CmdReagendar'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
	header("Location:../Reagendar.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&idv=1");
}



?>


