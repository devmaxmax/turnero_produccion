<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}


if (isset($_POST['CmdSiguiente'])){ 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION['IdConsulta']=2;
	header("Location:../ReagendarCMIT.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&ide=".$_POST['TxtIdEncriptado']."&idv=".intval($_POST['TxtIdVolver']));
}


if (isset($_POST['CmdAnterior'])){ 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION['IdConsulta']=1;
	header("Location:../ReagendarCMIT.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&ide=".$_POST['TxtIdEncriptado']."&idv=".intval($_POST['TxtIdVolver']));
}


if (isset($_POST['CmdTurno'])){	
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	//obtengo datos
	list($fecha,$hora,$varagenda)=explode("|",mysql_real_escape_string($_POST['TxtId']));	
	$idturno=intval($_POST['TxtIdTurno']);
	//variables
	include("../Includes/zVariables.php");
	//hora	
	list($h1,$m1)=explode(":",$hora);$horamin=$m1+($h1*60);
	//tipo dia y turnos disponibles
	include("../Includes/zTipoDia.php");
	//si no esta ocupado grabo	
	if($ocupado==0){
		$fecha=FechaMySql($fecha);
		$sturno=GLO_TURSobreturnoES($hora);
		$query="UPDATE turnos set Fecha='$fecha',Hora='$hora',STurno=$sturno Where Id=$idturno";$rs=mysql_query($query,$conn);
		if ($rs){
			//busco datos mail (turno sin atender y  fecha vigente)
			$hoy=date("d-m-Y");$wfechad="and DATEDIFF(t.Fecha,'".FechaMySql($hoy)."')>=0";
			$a='';$adjunto='';$cuerpo='';	
			$query="Select t.*,tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF as RSF1,u.RSF as RSF0,u.CUITF as CUITF0,uc.CUITF as CUITF1,u.Bloqueado From turnos t,tipoexamen tex,entidades e,usuariosclientes uc,usuarios u Where t.Id<>0 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and uc.Id=t.IdRSF and u.Usuario=t.IdUsuario and t.Estado=0 and t.IdUsuario<>'ngrunmann@gmail.com' $wfechad and t.Id=".intval($_POST['TxtIdTurno']);$rs2=mysql_query($query,$conn);	
			while($row2=mysql_fetch_array($rs2)){
				$essobreturno=$row2['STurno'];$a=$row2['IdUsuario'];$tipoex1=$row2['TipoEx'];$ent1=$row2['Entidad'];
				if($row2['IdRSF']==0){$empresa=$row2['RSF0'];$cuit=$row2['CUITF0'];}else{$empresa=$row2['RSF1'];$cuit=$row2['CUITF1'];}
				$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row2['Fecha'])).' '.FormatoFecha($row2['Fecha']);
				$hora=GLO_TURSobreturnoHora(date("H:i",strtotime($row2['Hora'])),$row2['STurno']);
				$art=$row2['ART'];$pac=$row2['Paciente'];$dnip=$row2['DNIP'];$pto=$row2['Puesto'];
				$obsp=$row2['ObsPuesto'];$obst=$row2['ObsTipo'];$det=$row2['Detalle'];$obs=$row2['Obs'];
				$nroturno=str_pad($row2['Id'], 6, "0", STR_PAD_LEFT);
				$bloq=$row2['Bloqueado'];
			}mysql_free_result($rs2);
			if($a!='' and $bloq==0){		
				//envio mail cliente
				$asunto='Turnos CMIT - Turno Modificado ('.$pac.')';
				include("../Includes/zMailCuerpoI.php");
				$cuerpo .='Usted ha modificado la fecha de un turno en CMIT, con los siguientes datos:<BR><BR>';
				include("../Includes/zMailCliente.php");
				include("../Includes/zMailCuerpoF.php");		
				//envia mail a usuario y copia oculta a cmit
				$asunto=$asunto.' '.GLO_TURSobreturnoLY($essobreturno);
			    $resultenvio=EnviarMailUsuarioBCC($a,$asunto,$cuerpo,$adjunto,0,$conn);
			}
		}else{GLO_feedback(2);} 
	}else{GLO_feedback(29);}
	mysql_close($conn); 
	//volver
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}	
	if(intval($_POST['TxtIdVolver'])==1){
		header("Location:Modificar.php?id=".encrypt($_POST['TxtIdTurno'],'elcrucedelosandes2016')."&Flag1=True");}
	else{
		header("Location:ModificarTurno.php?id=".encrypt($_POST['TxtIdTurno'],'elcrucedelosandes2016')."&ide=".$_POST['TxtIdEncriptado']."&Flag1=True");}
}
 
 
 if (isset($_POST['CmdSalir'])){	
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}	
	if(intval($_POST['TxtIdVolver'])==1){
		header("Location:Modificar.php?id=".encrypt($_POST['TxtIdTurno'],'elcrucedelosandes2016')."&Flag1=True");}
	else{
		header("Location:ModificarTurno.php?id=".encrypt($_POST['TxtIdTurno'],'elcrucedelosandes2016')."&ide=".$_POST['TxtIdEncriptado']."&Flag1=True");}
}

?>