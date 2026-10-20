<? include("../Codigo/Seguridad.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

if (isset($_POST[CmdAceptar])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	$obs=mysql_real_escape_string($_POST['TxtObs']);
	$pac=mysql_real_escape_string($_POST['TxtPaciente']);
	$dnip=mysql_real_escape_string($_POST['TxtDNIP']);
	$pto=mysql_real_escape_string($_POST['TxtPuesto']);
	$obsp=mysql_real_escape_string($_POST['TxtObsPuesto']);
	$tipoe=intval($_POST['CbIdTipoEx']);
	$obst=mysql_real_escape_string($_POST['TxtObsTipo']);
	$ent=intval($_POST['CbIdEntidad']);
	$det=mysql_real_escape_string($_POST['TxtDetalle']);
	$env=mysql_real_escape_string($_POST['OptEnvioMail']);
	$art=mysql_real_escape_string($_POST['TxtART']);
	$rsf=intval($_POST['CbIdRSF']);
	$usr=mysql_real_escape_string($_POST['TxtIdUsuario']);
	$fecha=$_POST['TxtFecha'];$hora=$_POST['TxtHora'];
	$fpago1=intval($_POST['OptFPago1']);
	$fpago2=intval($_POST['OptFPago2']);
	if($fpago1==1){$fpago2=0;}
	$query="UPDATE turnos set Obs='$obs',Paciente='$pac',DNIP='$dnip',Puesto='$pto',ObsPuesto='$obsp',IdTipoEx=$tipoe,ObsTipo='$obst',IdEntidad=$ent,Detalle='$det',EnvioMail='$env',ART='$art',IdRSF=$rsf,FPago1=$fpago1,FPago2=$fpago2  Where Id=".intval($_POST['TxtNumero']);	
	$rs=mysql_query($query,$conn);
	if ($rs){	
		//verifica si muestra campos faltantes
		$feedinc="";$feedincmail="";$feedincmail2="";
		if(intval($_POST['CbIdEntidad'])==0){$feedinc=$feedinc."FACTURAR A, ";}
		if(empty($_POST['TxtPaciente'])){$feedinc=$feedinc."PACIENTE, ";}
		if(empty($_POST['TxtPuesto'])){$feedinc=$feedinc."PUESTO, ";}
		if(intval($_POST['CbIdTipoEx'])==0){$feedinc=$feedinc."EXAMEN, ";}
		if(empty($_POST['TxtDetalle'])){$feedinc=$feedinc."DETALLE, ";}
		if(empty($_POST['TxtART']) and (intval($_POST['CbIdEntidad'])==1 or intval($_POST['CbIdEntidad'])==3)){$feedinc=$feedinc."ART, ";}
		if(((intval($_POST['OptFPago1'])==0) and (empty($_POST['OptFPago2'])))){$feedinc=$feedinc."FORMA DE PAGO";}			
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
		$query="Select tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF,uc.CUITF  From turnos t,tipoexamen tex,entidades e,usuariosclientes uc Where t.Id<>0 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and uc.Id=t.IdRSF and t.Id=".intval($_POST['TxtNumero']);$rs2=mysql_query($query,$conn);	
		while($row2=mysql_fetch_array($rs2)){$tipoex1=$row2['TipoEx'];$ent1=$row2['Entidad'];$rsf1=$row2['RSF'];$cuit1=$row2['CUITF'];}mysql_free_result($rs2);
		if($rsf==0){$empresa=$rsf0;$cuit=$cuit0;}else{$empresa=$rsf1;$cuit=$cuit1;}
		$cond=GLO_TURCondicionesMail($conn);//condiciones
		//envio mail cliente
		$nroturno=str_pad($_POST['TxtNumero'], 6, "0", STR_PAD_LEFT);
		$a=$_POST['TxtIdUsuario'];$asunto='Turnos CMIT - Mail para el Cliente ('.$pac.')';$adjunto='';$cuerpo='';
		$cuerpo .='<BODY><FONT FACE="arial"><SMALL>';
		$cuerpo .='--------------------------------------------------------------------------------<BR>';
		$cuerpo .='COMPROBANTE DE TURNO PARA CLIENTE<BR>';
		$cuerpo .='--------------------------------------------------------------------------------<BR><BR>';		
		$cuerpo .=$feedincmail;
		include("../Includes/zMailCliente.php");
		$cuerpo .='--------------------------------------------------------------------------------<BR>';
		$cuerpo .='SOLO SERA ATENDIDO PRESENTANDO DNI ORIGINAL CON FOTO<BR>';
		$cuerpo .='--------------------------------------------------------------------------------<BR><BR>';	
		$cuerpo .='<I>'.$cond.'</I><BR>';		
		$cuerpo .='</SMALL></FONT></BODY>';	
		//envia mail a usuario y copia oculta a cmit
		$horaturno=$hora;
		$asuntobcc=$asunto.' '.GLO_TURSobreturnoLY($horaturno);			
		$resultenvio=EnviarMailUsuarioBCC($a,$asuntobcc,$cuerpo,$adjunto,$alerta,$conn);		
		
		//envio mail paciente
		include("../Includes/zMailPaciente.php");		
		//confirma
		$feed="msgC="."Los datos se grabaron correctamente"."&msgE=".$feedinc;
	}else{$feed="msgE="."Los datos NO se grabaron. "; } 
	mysql_close($conn); 
	//limpiar datos del form anterior
	foreach($_POST as $key => $value){	$_SESSION[$key] = "";	}
	header("Location:ModificarTurno.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&Flag1=True&".$feed);
	
}


elseif (isset($_POST[CmdReagendar])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
	header("Location:../Reagendar.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&idv=2");
}


elseif (isset($_POST[CmdCancelar])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../MisTurnos.php");
}

?>


