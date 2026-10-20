<? include("../Codigo/Seguridad.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");

if (isset($_POST[CmdBorrar])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
	$a='';$adjunto='';$cuerpo='';
	//busco datos mail	
	$query="Select t.*,tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF as RSF1,u.RSF as RSF0,u.CUITF as CUITF0,uc.CUITF as CUITF1,u.Riesgo,u.FPago From turnos t,tipoexamen tex,entidades e,usuariosclientes uc,usuarios u Where t.Id<>0 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and uc.Id=t.IdRSF and u.Usuario=t.IdUsuario and t.Id=".intval($_POST['TxtId']);$rs2=mysql_query($query,$conn);	
	while($row2=mysql_fetch_array($rs2)){		
		$a=$row2['IdUsuario'];$tipoex1=$row2['TipoEx'];$ent1=$row2['Entidad'];
		if($row2['IdRSF']==0){$empresa=$row2['RSF0'];$cuit=$row2['CUITF0'];}else{$empresa=$row2['RSF1'];$cuit=$row2['CUITF1'];}
		$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row2['Fecha'])).' '.FormatoFecha($row2['Fecha']);
		$hora=date("H:i",strtotime($row2['Hora']));
		$art=$row2['ART'];$pac=$row2['Paciente'];$dnip=$row2['DNIP'];$pto=$row2['Puesto'];
		$obsp=$row2['ObsPuesto'];$obst=$row2['ObsTipo'];$det=$row2['Detalle'];$obs=$row2['Obs'];
		$nroturno=str_pad($row2['Id'], 6, "0", STR_PAD_LEFT);
		$alerta=GLO_TURRiesgo($row2['Riesgo'],$row2['FPago']);
	}mysql_free_result($rs2);
	//borro
	$query="Update turnos Set Estado=3 Where Id=".intval($_POST['TxtId']);$rs=mysql_query($query,$conn);
	if ($rs){
		$feed="msgC="."Los datos se grabaron correctamente";		
		if($a!=''){		
			//envio mail cliente
			$asunto='Turnos CMIT - Turno Eliminado ('.$pac.')';
			$cuerpo .='<BODY><FONT FACE="arial"><SMALL>';
			$cuerpo .='Usted ha eliminado un turno en CMIT, con los siguientes datos:<BR><BR>';
			include("../Includes/zMailCliente.php");
			$cuerpo .='</SMALL></FONT></BODY>';	
			//envia mail a usuario y copia oculta a cmit
			$horaturno=$hora;
			$asuntobcc=$asunto.' '.GLO_TURSobreturnoLY($horaturno);			
			$resultenvio=EnviarMailUsuarioBCC($a,$asuntobcc,$cuerpo,$adjunto,$alerta,$conn);	
		}
	
	}else{$feed="msgE="."No se grabó el cambio"; } 
	mysql_close($conn); 
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../MisTurnos.php?".$feed); 	
}



if (isset($_POST[CmdVer])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:ModificarTurno.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016')."&Flag1=True");	
}

if (isset($_POST[CmdSoloVer])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:VerTurno.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016')."&Flag1=True");	
}


if (isset($_POST[CmdSalir])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../Inicio.php");
}

if (isset($_POST[CmdExcel])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	//trae turnos vigentes del usuario
	$hoy=date("d-m-Y");$fecha=date("d-m-Y", strtotime("$hoy -7 day"));
	$wfechad="and DATEDIFF(t.Fecha,'".FechaMySql($fecha)."')>=0";
	$usr=$_SESSION["login"];
	//trae RSF de usuarios
	$query="SELECT u.RSF FROM usuarios u where u.Usuario='$usr'";$rs=mysql_query($query,$conn);
	while($row=mysql_fetch_array($rs)){$rsf0=$row['RSF'];}mysql_free_result($rs);
	//muestra turnos+sobreturnos (sobreturnos los muestra a las 8:00)
	//turnos
	$query1="Select t.*,tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF,t.Hora as Hora2 From turnos t,tipoexamen tex,entidades e,usuariosclientes uc Where t.Id<>0 and t.Estado<>3 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and t.IdUsuario='$usr' and uc.Id=t.IdRSF $wfechad and t.Hora<>'13:00:00'";
	//sobreturnos
	$query2="Select t.*,tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF,'08:00:00' as Hora2 From turnos t,tipoexamen tex,entidades e,usuariosclientes uc Where t.Id<>0 and t.Estado<>3 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and t.IdUsuario='$usr' and uc.Id=t.IdRSF $wfechad and t.Hora='13:00:00'";
	//turnos+sobreturnos
	$query="Select x.* From($query1 UNION ALL $query2)x Order by x.Fecha,x.Hora2";
	if ($query!=""){
		$rs=mysql_query($query,$conn);
		if(mysql_num_rows($rs)!=0){	
			//Titulos excel
			include("../Codigo/ExcelHeader.php");
			echo "<table border=0 ".'style="font-size:10px"'.">\n ";	
			echo "<tr><td ".'colspan="4"'."><strong>MIS TURNOS PENDIENTES</strong></td></tr>\n </table>\n";
			echo "<table border=1 ".'style="font-size:10px"'.">\n ";
			echo '<tr style="background:#FFCC00">'."\n";
			echo "<th>N°Turno</th>\n";
			echo "<th>Día</th>\n";
			echo "<th>Fecha</th>\n";			
			echo "<th>Hora</th>\n";	
			echo "<th>Razón Social</th>\n";	
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
			echo "<th>FPago</th>\n";	
			echo "</tr>\n";				
			//datos excel	
			while($row=mysql_fetch_array($rs)){ 
				if($row['IdRSF']==0){$empresa=$rsf0;}else{$empresa=$row['RSF'];}
				if($row['Estado']==0){$estado='Sin Atender';$colorest='';$colorfila='';}
				if($row['Estado']==1){$estado='Atendido';$colorest=' style="font-weight:bold;color:#4CAF50"';$colorfila='';}
				if($row['Estado']==2){$estado='Bloqueado';$colorest='';$colorfila=' style=";color:#f5f4eb"';}
				if($row['FPago1']==0){$fpago='Contado';}else{$fpago='Cta.Cte';}
				//si es sobreturno lo muestra a las 08:00
				if(GLO_TURSobreturno(date("H:i",strtotime($row['Hora'])))==1){$hora='08:00';}else{$hora=date("H:i",strtotime($row['Hora']));}
				//
				echo "<tr>\n";
				echo "<td>".$row['Id']."</td>\n";
				echo "<td>".ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha']))."</td>\n";
				echo "<td>".FormatoFecha($row['Fecha'])."</td>\n";
				echo "<td>".$hora."</td>\n";
				echo "<td>".$empresa."</td>\n";
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
				echo "<td>".$fpago."</td>\n";
				echo "</tr>\n";			
			}	
			//Cierra tabla excel
			echo "</table>\n";				
		}mysql_free_result($rs);	
	}mysql_close($conn); 

 }
 
 
?>