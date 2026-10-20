<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

if (isset($_POST[CmdBorrar])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	//busco datos mail (que no sea ngrunmann, turno sin atender y  fecha vigente)
	$hoy=date("d-m-Y");$wfechad="and DATEDIFF(t.Fecha,'".FechaMySql($hoy)."')>=0";
	$a='';$adjunto='';$cuerpo='';	
	$query="Select t.*,tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF as RSF1,u.RSF as RSF0,u.CUITF as CUITF0,uc.CUITF as CUITF1,u.Bloqueado From turnos t,tipoexamen tex,entidades e,usuariosclientes uc,usuarios u Where t.Id<>0 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and uc.Id=t.IdRSF and u.Usuario=t.IdUsuario and t.Estado=0 and t.IdUsuario<>'ngrunmann@gmail.com' $wfechad and t.Id=".intval($_POST['TxtId']);$rs2=mysql_query($query,$conn);	
	while($row2=mysql_fetch_array($rs2)){
		$a=$row2['IdUsuario'];$tipoex1=$row2['TipoEx'];$ent1=$row2['Entidad'];
		if($row2['IdRSF']==0){$empresa=$row2['RSF0'];$cuit=$row2['CUITF0'];}else{$empresa=$row2['RSF1'];$cuit=$row2['CUITF1'];}
		$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row2['Fecha'])).' '.FormatoFecha($row2['Fecha']);
		$hora=date("H:i",strtotime($row2['Hora']));
		$art=$row2['ART'];$pac=$row2['Paciente'];$dnip=$row2['DNIP'];$pto=$row2['Puesto'];
		$obsp=$row2['ObsPuesto'];$obst=$row2['ObsTipo'];$det=$row2['Detalle'];$obs=$row2['Obs'];
		$nroturno=str_pad($row2['Id'], 6, "0", STR_PAD_LEFT);
		$bloq=$row2['Bloqueado'];
	}mysql_free_result($rs2);
	//borro
	$query="Update turnos Set Estado=3 Where Id=".intval($_POST['TxtId']);$rs=mysql_query($query,$conn);
	if ($rs){
		$feed="msgC="."Los datos se grabaron correctamente";
		InsertarAuditoria(1,2,intval($_POST['TxtId']),$conn);		
		if($a!='' and $bloq==0){	
			//envio mail cliente
			$asunto='Turnos CMIT - Turno Eliminado ('.$pac.')';
			$cuerpo .='<BODY><FONT FACE="arial"><SMALL>';
			$cuerpo .='Usted ha eliminado un turno en CMIT, con los siguientes datos:<BR><BR>';
			include("../Includes/zMailCliente.php");
			$cuerpo .='</SMALL></FONT></BODY>';		
			//envia mail a usuario y copia oculta a cmit	
			$horaturno=$hora;
			$asuntobcc=$asunto.' '.GLO_TURSobreturnoLY($horaturno);		
			$resultenvio=EnviarMailUsuarioBCC($a,$asuntobcc,$cuerpo,$adjunto,0,$conn);
		}
	
	}else{$feed="msgE="."No se grabó el cambio"; } 
	mysql_close($conn); 
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../VerTurnosCMIT.php?Id=".$_POST['TxtIdEncriptado'].'&'.$feed);	
}

if (isset($_POST[CmdAtender])){
	$query="Update turnos Set Estado=1 Where Id=".intval($_POST['TxtId']);
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);
	if ($rs){$feed="msgC="."Los datos se grabaron correctamente";InsertarAuditoria(1,4,intval($_POST['TxtId']),$conn);}
	else{$feed="msgE="."No se grabó el cambio"; } 
	mysql_close($conn); 
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../VerTurnosCMIT.php?Id=".$_POST['TxtIdEncriptado'].'&'.$feed);	
}


if (isset($_POST[CmdVer])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:VerTurno.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016')."&Flag1=True&ide=".$_POST['TxtIdEncriptado']);	
}

if (isset($_POST[CmdModificar])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:ModificarTurno.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016')."&Flag1=True&ide=".$_POST['TxtIdEncriptado']);	
}


if (isset($_POST[CmdAgregar])){	
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:Alta.php?Id=".$_POST['TxtIdEncriptado']);	
}


if (isset($_POST[CmdSalir])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../InicioCMIT.php");
}

if (isset($_POST[CmdExcel])){
	$f=FechaMySql($_POST['TxtFecha']);
	$h=$_POST['TxtHora'];
	$a=intval($_POST['TxtIdAgenda']);
	//consulta
	$query="Select t.*,tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF,uc.CUITF,uc.NFF,uc.DomiF,uc.PciaF,uc.RSPF,u.Nombre,u.Apellido,u.Tel,u.RSF as RSF0,u.CUITF as CUITF0,u.NFF as NFF0,u.DomiF as DomiF0,u.PciaF as PciaF0,u.RSPF as RSPF0,tde.Nombre as FP2 From turnos t,tipoexamen tex,entidades e,usuariosclientes uc,usuarios u,turnosdetalle tde Where t.Id<>0 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and uc.Id=t.IdRSF and u.usuario=t.IdUsuario and t.FPago2=tde.Id and t.estado<>2 and t.IdAgenda=$a and t.Fecha='$f' and t.Hora='$h' Order by t.Fecha,t.Hora";
	if ($query!=""){
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);
		if(mysql_num_rows($rs)!=0){	
			//Titulos excel
			include("../Codigo/ExcelHeader.php");
			echo "<table border=0 ".'style="font-size:10px"'.">\n ";	
			echo "<tr><td ".'colspan="4"'."><strong>MIS TURNOS PENDIENTES</strong></td></tr>\n </table>\n";
			echo "<table border=1 ".'style="font-size:10px"'.">\n ";
			echo '<tr style="background:#FFCC00">'."\n";
			echo "<th>Número</th>\n";
			echo "<th>Día</th>\n";
			echo "<th>Fecha</th>\n";			
			echo "<th>Hora</th>\n";	
			echo "<th>Paciente</th>\n";
			echo "<th>DNI</th>\n";
			echo "<th>Puesto</th>\n";
			echo "<th>Obs.Puesto</th>\n";
			echo "<th>Tipo Examen</th>\n";
			echo "<th>Obs.Examen</th>\n";
			echo "<th>Detalle</th>\n";
			echo "<th>Observaciones</th>\n";
			echo "<th>Facturar A</th>\n";
			echo "<th>ART</th>\n";	
			echo "<th>Estado</th>\n";	
			echo "<th>Razón Social</th>\n";					
			echo "<th>CUIT</th>\n";	
			echo "<th>Nombre Fantasia</th>\n";
			echo "<th>Domicilio Real</th>\n";	
			echo "<th>Ciudad/Provincia</th>\n";	
			echo "<th>Empresa Planilla</th>\n";	
			echo "<th>Usuario</th>\n";	
			echo "<th>Nombre</th>\n";	
			echo "<th>Apellido</th>\n";	
			echo "<th>Teléfono</th>\n";	
			echo "<th>FPago</th>\n";	
			echo "<th>FPago Detalle</th>\n";	
			echo "</tr>\n";				
			while($row=mysql_fetch_array($rs)){ 
				//datos empresa
				if($row['IdRSF']==0){
					$empresa=$row['RSF0'];$cuit=$row['CUITF0'];$nff=$row['NFF0'];$dof=$row['DomiF0'];$pcf=$row['PciaF0'];$rspf=$row['RSPF0'];	
				}else{
					$empresa=$row['RSF'];$cuit=$row['CUITF'];$nff=$row['NFF'];$dof=$row['DomiF'];$pcf=$row['PciaF'];$rspf=$row['RSPF'];				
				}
				//estado
				if($row['Estado']==0){$estado='Sin Atender';$colorest='';}
				if($row['Estado']==1){$estado='Atendido';$colorest=' style="font-weight:bold;color:#4CAF50"';}
				if($row['FPago1']==0){$fpago='Contado';}else{$fpago='Cta.Cte';}
				echo "<tr>\n";
				echo "<td>".$row['Id']."</td>\n";
				echo "<td>".ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha']))."</td>\n";
				echo "<td>".FormatoFecha($row['Fecha'])."</td>\n";
				echo "<td>".date("H:i",strtotime($row['Hora']))."</td>\n";
				echo "<td>".$row['Paciente']."</td>\n";
				echo "<td>".$row['DNIP']."</td>\n";
				echo "<td>".$row['Puesto']."</td>\n";
				echo "<td>".$row['ObsPuesto']."</td>\n";
				echo "<td>".$row['TipoEx']."</td>\n";
				echo "<td>".$row['ObsTipo']."</td>\n";
				echo "<td>".$row['Detalle']."</td>\n";
				echo "<td>".$row['Obs']."</td>\n";
				echo "<td>".$row['Entidad']."</td>\n";
				echo "<td>".$row['ART']."</td>\n";
				echo "<td ".$colorest.">".$estado."</td>\n";	
				echo "<td>".$empresa."</td>\n";
				echo "<td>".$cuit."</td>\n";
				echo "<td>".$nff."</td>\n";
				echo "<td>".$dof."</td>\n";
				echo "<td>".$pcf."</td>\n";
				echo "<td>".$rspf."</td>\n";
				if($row['Cmit']==1){echo "<td>CMIT</td>\n";}else{echo "<td>".$row['IdUsuario']."</td>\n";}				
				echo "<td>".$row['Nombre']."</td>\n";
				echo "<td>".$row['Apellido']."</td>\n";
				echo "<td>".$row['Tel']."</td>\n";
				echo "<td>".$fpago."</td>\n";
				echo "<td>".$row['FP2']."</td>\n";
				echo "</tr>\n";			
			}	
			//Cierra tabla excel
			echo "</table>\n";				
		}mysql_free_result($rs);	
		mysql_close($conn); 
	}

 }
 
 
?>