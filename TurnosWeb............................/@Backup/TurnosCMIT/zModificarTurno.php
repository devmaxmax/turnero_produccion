<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}


if (isset($_POST[CmdAceptar])){
	if (  ((intval($_POST['CbIdEntidad'])==0) or (empty($_POST['TxtPaciente'])) or (empty($_POST['TxtPuesto'])) or (intval($_POST['CbIdTipoEx'])==0) or (empty($_POST['TxtDetalle'])) or ((empty($_POST['TxtART'])) and (intval($_POST['CbIdEntidad'])==1 or intval($_POST['CbIdEntidad'])==3) ) or ((intval($_POST['OptFPago1'])==0) and (empty($_POST['OptFPago2']))) ) and (intval($_POST['TxtCmit'])==0) ){
		if(empty($_POST['TxtART']) and (intval($_POST['CbIdEntidad'])==1 or intval($_POST['CbIdEntidad'])==3))
		{$feed="&msgE=Por favor complete la ART";}else{$feed="&msgE=Por favor complete los campos requeridos";}		
		if(((intval($_POST['OptFPago1'])==0) and (empty($_POST['OptFPago2'])))){$feed="&msgE=Por favor seleccione la forma de pago";}
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;}		
		header("Location:ModificarTurno.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&ide=".$_POST['TxtIdEncriptado'].$feed);
	}else{ 
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		list($rsf,$usr)=explode("|",$_POST['CbIdRSF']);
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
		$rsf=intval($rsf);
		$usr=mysql_real_escape_string($usr);
		$fpago1=intval($_POST['OptFPago1']);
		$fpago2=intval($_POST['OptFPago2']);
		if($fpago1==1){$fpago2=0;}
		//$ate=intval($_POST['ChkAt']); 
		$fecha=$_POST['TxtFecha'].' '.$_POST['TxtHora'];
		$cmit=intval($_POST['TxtCmit']);
		if($cmit==1 and $_POST['TxtIdUsuario2']=='CMIT' and $usr!=''){//asignacion de usuario
			$query="UPDATE turnos set Obs='$obs',Paciente='$pac',DNIP='$dnip',Puesto='$pto',ObsPuesto='$obsp',IdTipoEx=$tipoe,ObsTipo='$obst',IdEntidad=$ent,Detalle='$det',EnvioMail='$env',ART='$art',IdRSF=$rsf,IdUsuario='$usr',FPago1=$fpago1,FPago2=$fpago2  Where Id=".intval($_POST['TxtNumero']);	
		}else{		
			$query="UPDATE turnos set Obs='$obs',Paciente='$pac',DNIP='$dnip',Puesto='$pto',ObsPuesto='$obsp',IdTipoEx=$tipoe,ObsTipo='$obst',IdEntidad=$ent,Detalle='$det',EnvioMail='$env',ART='$art',IdRSF=$rsf,FPago1=$fpago1,FPago2=$fpago2  Where Id=".intval($_POST['TxtNumero']);	
		}
		$rs=mysql_query($query,$conn);
		if ($rs){
			$feed="msgC="."Los datos se grabaron correctamente";
			InsertarAuditoria(1,3,intval($_POST['TxtNumero']),$conn);
			//busco datos mail (que no sea ngrunmann, turno sin atender y  fecha vigente)
			$hoy=date("d-m-Y");$wfechad="and DATEDIFF(t.Fecha,'".FechaMySql($hoy)."')>=0";
			$a='';$adjunto='';$cuerpo='';	
			$query="Select t.*,tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF as RSF1,u.RSF as RSF0,u.CUITF as CUITF0,uc.CUITF as CUITF1,u.Bloqueado From turnos t,tipoexamen tex,entidades e,usuariosclientes uc,usuarios u Where t.Id<>0 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and uc.Id=t.IdRSF and u.Usuario=t.IdUsuario and t.Estado=0 and t.IdUsuario<>'ngrunmann@gmail.com' $wfechad and t.Id=".intval($_POST['TxtNumero']);$rs2=mysql_query($query,$conn);	
			while($row2=mysql_fetch_array($rs2)){
				$a=$row2['IdUsuario'];$tipoex1=$row2['TipoEx'];$ent1=$row2['Entidad'];
				if($row2['IdRSF']==0){$empresa=$row2['RSF0'];$cuit=$row2['CUITF0'];}else{$empresa=$row2['RSF1'];$cuit=$row2['CUITF1'];}
				$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row2['Fecha'])).' '.FormatoFecha($row2['Fecha']);
				$hora=date("H:i",strtotime($row2['Hora']));
				$art=$row2['ART'];$pac=$row2['Paciente'];$dnip=$row2['DNIP'];$pto=$row2['Puesto'];
				$obsp=$row2['ObsPuesto'];$obst=$row2['ObsTipo'];$det=$row2['Detalle'];$obs=$row2['Obs'];
				$bloq=$row2['Bloqueado'];
			}mysql_free_result($rs2);
			if($a!='' and $bloq==0){	
				$cond=GLO_TURCondicionesMail($conn);//condiciones
				//envio mail cliente
				$nroturno=str_pad($_POST['TxtNumero'], 6, "0", STR_PAD_LEFT);
				$asunto='Turnos CMIT - Mail para el Cliente ('.$pac.')';$adjunto='';$cuerpo='';
				$cuerpo .='<BODY><FONT FACE="arial"><SMALL>';
				$cuerpo .='--------------------------------------------------------------------------------<BR>';
				$cuerpo .='COMPROBANTE DE TURNO PARA CLIENTE<BR>';
				$cuerpo .='--------------------------------------------------------------------------------<BR>';	
				include("../Includes/zMailCliente.php");		
				$cuerpo .='--------------------------------------------------------------------------------<BR>';
				$cuerpo .='SOLO SERA ATENDIDO PRESENTANDO DNI ORIGINAL CON FOTO<BR>';
				$cuerpo .='--------------------------------------------------------------------------------<BR><BR>';	
				$cuerpo .='<I>'.$cond.'</I><BR>';		
				$cuerpo .='</SMALL></FONT></BODY>';			
				//envia mail a usuario y copia oculta a cmit
				$horaturno=$_POST['TxtHora'];
				$asuntobcc=$asunto.' '.GLO_TURSobreturnoLY($horaturno);			
			    $resultenvio=EnviarMailUsuarioBCC($a,$asuntobcc,$cuerpo,$adjunto,0,$conn);
				
				//envio mail paciente
				include("../Includes/zMailPaciente.php");
			}
		
		}else{$feed="msgE="."Los datos NO se grabaron. "; } 
		mysql_close($conn); 	
		//limpiar datos del form anterior
		foreach($_POST as $key => $value){	$_SESSION[$key] = "";	}
		header("Location:ModificarTurno.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&ide=".$_POST['TxtIdEncriptado']."&Flag1=True&".$feed);
	}		
	
}


elseif (isset($_POST[CmdExBuscar])){//buscar empresa
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
	header("Location:ModificarTurno.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&ide=".$_POST['TxtIdEncriptado']);
}

elseif (isset($_POST[CmdReagendar])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
	header("Location:../ReagendarCMIT.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&ide=".$_POST['TxtIdEncriptado']."&idv=2");
}

elseif (isset($_POST[CmdAtender])){
	//busco estado
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	$query="SELECT Estado FROM turnos WHERE  Id=".intval($_POST['TxtNumero']);$rs=mysql_query($query,$conn);
	$row=mysql_fetch_array($rs);if(mysql_num_rows($rs)!=0){$estado=$row['Estado'];}else{$estado=0;}mysql_free_result($rs);
	//actualizo
	if($estado==0){$query="Update turnos Set Estado=1 Where Id=".intval($_POST['TxtNumero']);$rs=mysql_query($query,$conn);}
	else{$query="Update turnos Set Estado=0 Where Id=".intval($_POST['TxtNumero']);$rs=mysql_query($query,$conn);}
	//vuelvo
	if ($rs){$feed="msgC="."Los datos se grabaron correctamente";}else{$feed="msgE="."No se grabó el cambio"; } 
	mysql_close($conn); 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	header("Location:ModificarTurno.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&ide=".$_POST['TxtIdEncriptado']."&Flag1=True");	
}



elseif (isset($_POST[CmdCancelar])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../VerTurnosCMIT.php?Id=".$_POST['TxtIdEncriptado']);
}

?>


