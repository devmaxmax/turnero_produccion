<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

if (isset($_POST[CmdBorrar])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	list($a,$m)=explode("|",mysql_real_escape_string($_POST['TxtId']));
	$query="Delete From turnos Where month(Fecha)=$m and year(Fecha)=$a";$rs=mysql_query($query,$conn);
	if ($rs){$feed="msgC="."Los datos se grabaron correctamente";}else{$feed="msgE="."No se grabó el cambio"; } 
	mysql_close($conn); 
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../Eliminar.php?".$feed); 	
}




if (isset($_POST[CmdSalir])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../InicioCMIT.php");
}

if (isset($_POST[CmdExcel])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	list($a,$m)=explode("|",mysql_real_escape_string($_POST['TxtId']));
	$query="Select t.*,tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF,uc.CUITF,uc.NFF,uc.DomiF,uc.PciaF,uc.RSPF,u.Nombre,u.Apellido,u.Tel,u.RSF as RSF0,u.CUITF as CUITF0,u.NFF as NFF0,u.DomiF as DomiF0,u.PciaF as PciaF0,u.RSPF as RSPF0 From turnos t,tipoexamen tex,entidades e,usuariosclientes uc,usuarios u Where t.Id<>0 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and uc.Id=t.IdRSF and u.Usuario=t.IdUsuario and t.Estado<>2 and month(Fecha)=$m and year(Fecha)=$a Order by t.Fecha,t.Hora";$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//Titulos excel
		include("../Codigo/ExcelHeader.php");
		echo "<table border=0 ".'style="font-size:10px"'.">\n ";	
		echo "<tr><td ".'colspan="4"'."><strong>TURNOS ".G_NombreMes($m).' '.$a."</strong></td></tr>\n </table>\n";
		echo "<table border=1 ".'style="font-size:10px"'.">\n ";
		echo '<tr style="background:#FFCC00">'."\n";
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
			if($row['Estado']==3){$estado='Eliminado';$colorest='';}
			echo "<tr>\n";
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
			echo "</tr>\n";			
		}	
		//Cierra tabla excel
		echo "</table>\n";				
	}mysql_free_result($rs);
	mysql_close($conn); 	
 }


?>