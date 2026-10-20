<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}


if (isset($_POST['CmdAceptar'])){
	if( ( empty($_POST['TxtPaciente']) or ( empty($_POST['ChkE1']) and empty($_POST['ChkE2']) and empty($_POST['ChkE3']) and empty($_POST['ChkE4']) and empty($_POST['ChkE5']) ) ) and intval($_POST['TxtCmit'])==0 ){
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
		GLO_feedback(3);	
		header("Location:Modificar.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016'));
	}else{ 
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		list($rsf,$usr)=explode("|",$_POST['CbIdRSF']);	$rsf=intval($rsf);
		$usr=mysql_real_escape_string($usr);
		//
		include ("../Includes/zDatosTurno.php");
		$fecha=$_POST['TxtFecha'].' '.$_POST['TxtHora'];
		$cmit=intval($_POST['TxtCmit']);
		if($cmit==1 and $_POST['TxtIdUsuario2']=='CMIT' and $usr!=''){//asignacion de usuario
			$query="UPDATE turnos set Obs='$obs',Paciente='$pac',DNIP='$dnip',IdRSF=$rsf,IdUsuario='$usr',E1=$e1,E2=$e2,E3=$e3,E4=$e4,E5=$e5 Where Id=".intval($_POST['TxtNumero']);
		}else{
			$query="UPDATE turnos set Obs='$obs',Paciente='$pac',DNIP='$dnip',IdRSF=$rsf,E1=$e1,E2=$e2,E3=$e3,E4=$e4,E5=$e5  Where Id=".intval($_POST['TxtNumero']);
		}$rs=mysql_query($query,$conn);
		if ($rs){
			GLO_feedback(1);
			//busco datos mail (que no sea ngrunmann, turno sin atender y  fecha vigente)
			$hoy=date("d-m-Y");$wfechad="and DATEDIFF(t.Fecha,'".FechaMySql($hoy)."')>=0";
			$a='';$adjunto='';$cuerpo='';	
			$query="Select t.*,e.Nombre as Entidad,uc.RSF as RSF1,u.RSF as RSF0,u.CUITF as CUITF0,uc.CUITF as CUITF1,u.Bloqueado From turnos t,entidades e,usuariosclientes uc,usuarios u Where t.Id<>0 and t.IdEntidad=e.Id and uc.Id=t.IdRSF and u.Usuario=t.IdUsuario and t.Estado=0 and t.IdUsuario<>'ngrunmann@gmail.com' $wfechad and t.Id=".intval($_POST['TxtNumero']);$rs2=mysql_query($query,$conn);	
			while($row2=mysql_fetch_array($rs2)){
				$mostrartipoex=1;include("../Includes/zTipoExamen.php");			
				$essobreturno=$row2['STurno'];$a=$row2['IdUsuario'];
				if($row2['IdRSF']==0){$empresa=$row2['RSF0'];$cuit=$row2['CUITF0'];}else{$empresa=$row2['RSF1'];$cuit=$row2['CUITF1'];}
				$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row2['Fecha'])).' '.FormatoFecha($row2['Fecha']);
				$hora=GLO_TURSobreturnoHora(date("H:i",strtotime($row2['Hora'])),$row2['STurno']);
				$pac=$row2['Paciente'];$dnip=$row2['DNIP'];$obs=$row2['Obs'];
				$bloq=$row2['Bloqueado'];
			}mysql_free_result($rs2);
			if($a!='' and $bloq==0){		
				//envio mail cliente
				$nroturno=str_pad($_POST['TxtNumero'], 6, "0", STR_PAD_LEFT);
				$asunto='Turnos CMIT - Mail para el Cliente ('.$pac.')';$adjunto='';$cuerpo='';
				include("../Includes/zMailCuerpoI.php");
				$cuerpo .='--------------------------------------------------------------------------------<BR>';
				$cuerpo .='COMPROBANTE DE TURNO PARA PACIENTE SIN SINTOMAS<BR>';
				$cuerpo .='--------------------------------------------------------------------------------<BR>';
				include("../Includes/zMailCliente.php");			
				$cuerpo .='--------------------------------------------------------------------------------<BR>';
				$cuerpo .='SOLO SERA ATENDIDO PRESENTANDO DNI ORIGINAL CON FOTO<BR>';
				$cuerpo .='--------------------------------------------------------------------------------<BR><BR>';	
				include("../Includes/zMailCuerpoF.php");		
				//envia mail a usuario y copia oculta a cmit	
				$asunto=$asunto.' '.GLO_TURSobreturnoLY($essobreturno);
				$resultenvio=EnviarMailUsuarioBCC($a,$asunto,$cuerpo,$adjunto,0,$conn);
				
				//envio mail paciente				
				//include("../Includes/zMailPaciente.php");
			}
		}else{GLO_feedback(2); } 
		mysql_close($conn); 	
		//limpiar datos del form anterior
		foreach($_POST as $key => $value){	$_SESSION[$key] = "";	}
		header("Location:Modificar.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&Flag1=True");
	}		
	
}


elseif (isset($_POST['CmdExBuscar'])){//buscar empresa
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
	header("Location:Modificar.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016'));
}


elseif (isset($_POST['CmdReagendar'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
	header("Location:../ReagendarCMIT.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&idv=1");
}

elseif (isset($_POST['CmdAtender'])){
	//busco estado
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	$query="SELECT Estado FROM turnos WHERE  Id=".intval($_POST['TxtNumero']);$rs=mysql_query($query,$conn);
	$row=mysql_fetch_array($rs);if(mysql_num_rows($rs)!=0){$estado=$row['Estado'];}else{$estado=0;}mysql_free_result($rs);
	//actualizo
	if($estado==0){$query="Update turnos Set Estado=1 Where Id=".intval($_POST['TxtNumero']);$rs=mysql_query($query,$conn);}
	else{$query="Update turnos Set Estado=0 Where Id=".intval($_POST['TxtNumero']);$rs=mysql_query($query,$conn);}
	//vuelvo
	if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 
	mysql_close($conn); 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	header("Location:Modificar.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&Flag1=True");	
}


elseif (isset($_POST['CmdCancelar'])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../ConsultaCMIT.php");	
}

?>


