<? include("../Codigo/Seguridad.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";

if (isset($_POST['CmdBorrar'])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
	$a='';$adjunto='';$cuerpo='';
	//busco datos mail	
	$query="Select t.*,e.Nombre as Entidad,uc.RSF as RSF1,u.RSF as RSF0,u.CUITF as CUITF0,uc.CUITF as CUITF1,u.Riesgo,u.FPago From turnos t,entidades e,usuariosclientes uc,usuarios u Where t.Id<>0 and t.IdEntidad=e.Id and uc.Id=t.IdRSF and u.Usuario=t.IdUsuario and t.Id=".intval($_POST['TxtId']);$rs2=mysql_query($query,$conn);
	while($row2=mysql_fetch_array($rs2)){	
		$mostrartipoex=1;include("../Includes/zTipoExamen.php");		
		$essobreturno=$row2['STurno'];$a=$row2['IdUsuario'];
		if($row2['IdRSF']==0){$empresa=$row2['RSF0'];$cuit=$row2['CUITF0'];}else{$empresa=$row2['RSF1'];$cuit=$row2['CUITF1'];}
		$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row2['Fecha'])).' '.FormatoFecha($row2['Fecha']);
		$hora=GLO_TURSobreturnoHora(date("H:i",strtotime($row2['Hora'])),$row2['STurno']);
		$pac=$row2['Paciente'];$dnip=$row2['DNIP'];$obs=$row2['Obs'];
		$nroturno=str_pad($row2['Id'], 6, "0", STR_PAD_LEFT);
		$alerta=GLO_TURRiesgo2($row2['Riesgo'],$row2['FPago']);
	}mysql_free_result($rs2);
	//borro
	$query="Update turnos Set Estado=3 Where Id=".intval($_POST['TxtId']);$rs=mysql_query($query,$conn);
	if ($rs){
		GLO_feedback(1);		
		if($a!=''){		
			//envio mail cliente
			$asunto='Turnos CMIT - Turno Eliminado ('.$pac.')';
			include("../Includes/zMailCuerpoI.php");
			$cuerpo .='Usted ha eliminado un turno en CMIT, con los siguientes datos:<BR><BR>';
			include("../Includes/zMailCliente.php");
			include("../Includes/zMailCuerpoF.php");
			//envia mail a usuario y copia oculta a cmit
			if($alerta==1){$asuntobcc=$asunto.' '.GLO_TURSobreturnoLY($essobreturno);}else{$asuntobcc=$asunto;}		
			$resultenvio=EnviarMailUsuarioBCC($a,$asuntobcc,$cuerpo,$adjunto,$alerta,$conn);	
		}
	
	}else{GLO_feedback(2);} 
	mysql_close($conn); 
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../MisTurnos.php"); 	
}



elseif (isset($_POST['CmdVer'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:ModificarTurno.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016')."&Flag1=True");	
}

elseif (isset($_POST['CmdSoloVer'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:VerTurno.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016')."&Flag1=True");	
}



elseif (isset($_POST['CmdExcel'])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	//trae turnos vigentes del usuario
	$hoy=date("d-m-Y");$fecha=date("d-m-Y", strtotime("$hoy -7 day"));
	$wfechad="and DATEDIFF(t.Fecha,'".FechaMySql($fecha)."')>=0";
	$usr=$_SESSION["login"];
	//trae RSF de usuarios
	$query="SELECT u.RSF FROM usuarios u where u.Usuario='$usr'";$rs=mysql_query($query,$conn);
	while($row=mysql_fetch_array($rs)){$rsf0=$row['RSF'];}mysql_free_result($rs);
//muestra turnos+sobreturnos 
	$horasobreturnover=GLO_horasobreturnovermysql();
	//turnos
	$query1="Select t.*,e.Nombre as Entidad,uc.RSF,t.Hora as Hora2 From turnos t,entidades e,usuariosclientes uc Where t.Id<>0 and t.Estado<>3 and t.IdEntidad=e.Id and t.IdUsuario='$usr' and uc.Id=t.IdRSF $wfechad and t.STurno<>1";
	//sobreturnos
	$query2="Select t.*,e.Nombre as Entidad,uc.RSF,'".$horasobreturnover."' as Hora2 From turnos t,entidades e,usuariosclientes uc Where t.Id<>0 and t.Estado<>3 and t.IdEntidad=e.Id and t.IdUsuario='$usr' and uc.Id=t.IdRSF $wfechad and t.STurno=1";
	//turnos+sobreturnos
	$query="Select x.* From($query1 UNION ALL $query2)x Order by x.Fecha,x.Hora2";
	if ($query!=""){
		$rs=mysql_query($query,$conn);
		if(mysql_num_rows($rs)!=0){	
			//Titulos excel
			include("../Codigo/ExcelHeader.php");
			include("../Codigo/ExcelStyle.php");
			echo "<th>Nro.Turno</th>\n";
			echo "<th>Dia</th>\n";
			echo "<th>Fecha</th>\n";			
			echo "<th>Hora</th>\n";	
			echo "<th>Razon Social</th>\n";	
			echo "<th>Paciente</th>\n";
			echo "<th>DNI</th>\n";
			echo "<th>Estado</th>\n";	
			echo "<th>FPago</th>\n";	
			echo "</tr>\n";				
			//datos excel	
			while($row=mysql_fetch_array($rs)){ 
				if($row['IdRSF']==0){$empresa=$rsf0;}else{$empresa=$row['RSF'];}
				if($row['Estado']==0){$estado='Sin Atender';$colorest='';$colorfila='';}
				if($row['Estado']==1){$estado='Atendido';$colorest=' style="font-weight:bold;color:#0F9D58"';$colorfila='';}
				if($row['Estado']==2){$estado='Bloqueado';$colorest='';$colorfila=' style=";color:#f5f4eb"';}
				if($row['FPago1']==0){$fpago='Contado';}else{$fpago='Cta.Cte';}
				//si es sobreturno lo muestra en otro horario
				$hora=GLO_TURSobreturnoHora(date("H:i",strtotime($row['Hora'])),$row['STurno']);
				//
				echo "<tr>\n";
				echo "<td>".$row['Id']."</td>\n";
				echo "<td>".ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha']))."</td>\n";
				echo "<td>".FormatoFecha($row['Fecha'])."</td>\n";
				echo "<td>".$hora."</td>\n";
				echo "<td>".$empresa."</td>\n";
				echo "<td>".$row['Paciente']."</td>\n";
				echo "<td>".$row['DNIP']."</td>\n";
				echo "<td ".$colorest.">".$estado."</td>\n";		
				echo "<td>".$fpago."</td>\n";
				echo "</tr>\n";			
			}	
			//Cierra tabla excel
			echo "</table>\n";				
		}mysql_free_result($rs);	
	}mysql_close($conn); 

 }
 
elseif (isset($_POST['CmdPDF'])){ 
	$idturno=intval($_POST['TxtId']);
	include("../FPDF/fpdf.php");  
	$pdf=new FPDF('P','mm','A4');
	//conecto
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	GLO_PDFTurno($pdf,$idturno,$_SESSION["NivelArbol"],$conn);
	//desconecto
	mysql_close($conn); 		
	$pdf->SetY(0);$pdf->SetDisplayMode('real');$pdf->Output();
}




else{GLO_windowclose(0);}
?>