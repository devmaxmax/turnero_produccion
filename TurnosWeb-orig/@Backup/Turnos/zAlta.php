<? include("../Codigo/Seguridad.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

if (isset($_POST[CmdAceptar])){
	if ( (empty($_POST['TxtPaciente']))  ){
		foreach($_POST as $key => $value){	$_SESSION[$key] = $value;}		
		header("Location:Alta.php?Id=".encrypt($_POST['TxtVarGet'],'elcrucedelosandes2016')."&msgE= No se grabó. Por favor complete el Paciente");	
	}else{
		//grabar los datos en la tabla
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		$fecha=$_POST['TxtFecha'];
		$hora=$_POST['TxtHora'];
		$varagenda=intval($_POST['TxtIdAgenda']);
		$u=mysql_real_escape_string($_POST['TxtIdUsuario']);
		$rsf=intval($_POST['CbIdRSF']);
		$pac=mysql_real_escape_string($_POST['TxtPaciente']);
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
			$query="INSERT INTO turnos (Id,IdAgenda,IdUsuario,Obs,Paciente,DNIP,Puesto,ObsPuesto,IdTipoEx,ObsTipo,IdEntidad,Detalle,EnvioMail,ART,IdRSF,Fecha,Hora,Cmit,Estado,Acepto,Carga,FPago1,FPago2) VALUES ($nroId,$varagenda,'$u','','$pac','','','',0,'',0,'','','',$rsf,'$fecha','$hora',0,0,1,'',0,0)";$rs=mysql_query($query,$conn);
			if ($rs){$feed="msgC="."El turno se grabó correctamente";$grabook=1;}else{$feed="msgE="."No se grabó. Intente nuevamente.";$grabook=0; } 
		}else{$feed="msgE="."No se grabó. El Turno fue ocupado en el último minuto.";$grabook=0;}
		mysql_close($conn); 
		//volver
		if($grabook==1){
			foreach($_POST as $key => $value){$_SESSION[$key] = "";}
			header("Location:Modificar.php?id=".encrypt($nroId,'elcrucedelosandes2016')."&Flag1=True&".$feed);
		}else{
			foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
			header("Location:../Inicio.php?".$feed);
		}		
	}
}

elseif (isset($_POST[CmdCancelar])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../Inicio.php");
}


?>

