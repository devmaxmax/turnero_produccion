<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

if (isset($_POST['CmdAceptar'])){
	//grabar los datos en la tabla
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	$fecha=$_POST['TxtFecha'];
	$hora=$_POST['TxtHora'];
	$varagenda=intval($_POST['TxtIdAgenda']);
	$u='ngrunmann@gmail.com';
	$nomuser=substr($_SESSION["NombreUsuario"],0,45);
	//variables
	include("../Includes/zVariables.php");
	//hora
	list($h1,$m1)=explode(":",$hora);$horamin=$m1+($h1*60);
	//tipo dia y turnos disponibles
	include("../Includes/zTipoDia.php");
	//si no esta ocupado grabo	
	if($ocupado==0){
		$fecha=FechaMySql($_POST['TxtFecha']);
		$sturno=GLO_TURSobreturnoES($hora);
		//inserto
		$nroId=GLO_generoID("turnos",$conn);
		$query="INSERT INTO turnos (Id,IdAgenda,IdUsuario,Obs,Paciente,DNIP,Puesto,ObsPuesto,IdTipoEx,ObsTipo,IdEntidad,Detalle,EnvioMail,ART,IdRSF,Fecha,Hora,Cmit,Estado,Acepto,Carga,FPago1,FPago2,STurno) VALUES ($nroId,$varagenda,'$u','','','','','',0,'',0,'','','',0,'$fecha','$hora',1,0,1,'$nomuser',0,0,$sturno)";
		$rs=mysql_query($query,$conn);
		if ($rs){$grabook=1;InsertarAuditoria(1,1,$nroId,$conn);}else{GLO_feedback(2);$grabook=0; } 
	}else{GLO_feedback(29);$grabook=0;}
	mysql_close($conn); 
	//volver
	if($grabook==1){
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}
		header("Location:ModificarTurno.php?id=".encrypt($nroId,'elcrucedelosandes2016')."&Flag1=True&ide=".$_POST['TxtIdEncriptado']);	
	}else{
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
		header("Location:../VerTurnosCMIT.php?Id=".$_POST['TxtIdEncriptado']);	
	}		
	
}

elseif (isset($_POST['CmdCancelar']) or isset($_POST['CmdSalir']) ){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../VerTurnosCMIT.php?Id=".$_POST['TxtIdEncriptado']);
}


?>

