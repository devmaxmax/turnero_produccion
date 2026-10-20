<? include("../Codigo/Seguridad.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");


if (isset($_POST[CmdBuscar])){	
	//trae turnos vigentes del usuario
	if((empty($_POST['TxtFechaDCP']))){$wfechad="";}else{$wfechad="and DATEDIFF(t.Fecha,'".FechaMySql($_POST['TxtFechaDCP'])."')>=0";}
	if((empty($_POST['TxtFechaHCP']))){$wfechah="";}else$wfechah={"and DATEDIFF(t.Fecha,'".FechaMySql($_POST['TxtFechaHCP'])."')<=0";}
	$tipoex=intval($_POST['CbEx']);if($tipoex!=0){$wtipoex="and t.IdTipoEx=$tipoex";}else{$wtipoex='';}
	$fhoy=FechaMySql(date("d-m-Y"));
	$usr=$_SESSION["login"];
	//consulta
	$consulta="Select t.*,te.Nombre as TipoEx,e.Nombre as Entidad,v.Nombre as Valor From turnos t,tipoexamen te,entidades e,valores v Where t.Id<>0 and t.IdTipoEx=te.Id and t.IdEntidad=e.Id and t.IdVal=v.Id and t.Usuario='$usr' $wfechad $wfechah $wtipoex Order by t.Fecha,t.Hora";
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION[TxtConsulta]=$consulta;
	header("Location:../MisTurnos.php");
}




if (isset($_POST[CmdSalir])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../Inicio.php");
}

if (isset($_POST[CmdExcel])){
	$query=$_POST['TxtConsulta'];$query=str_replace("\\", "", $query);
	if ($query!=""){
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);
		if(mysql_num_rows($rs)!=0){	
			//Titulos excel
			include("../Codigo/ExcelHeader.php");
			echo "<table border=0 ".'style="font-size:10px"'.">\n ";	
			echo "<tr><td ".'colspan="11" align="center"'."><strong>MIS TURNOS PENDIENTES</strong></td></tr>\n </table>\n";
			echo "<table border=1 ".'style="font-size:10px"'.">\n ";
			echo '<tr style="background:#FFCC00">'."\n";
			echo "<th>Nº OP</th>\n";			
			echo "<th>Fecha Emisión</th>\n";		
			echo "<th>Sector</th>\n";
			echo "<th>Cliente</th>\n";
			echo "<th>Origen</th>\n";
			echo "<th>Descripción</th>\n";
			echo "<th>Acción</th>\n";
			echo "<th>Responsable</th>\n";
			echo "<th>Fecha</th>\n";
			echo "<th>Norma</th>\n";
			echo "<th>Requisito</th>\n";
			echo "</tr>\n";				
			//datos excel	
			while($row=mysql_fetch_array($rs)){ 
				if($row['FechaEmision']!='0000-00-00'){$fechae =FormatoFecha($row['FechaEmision']);}else{$fechae='';}
				if($row['FechaCierre']!='0000-00-00'){$fechac =FormatoFecha( $row['FechaCierre']);}else{$fechac='';}
				//norma
				$norma='';
				if($row['IdNorma']!=0) {$norma=$norma.$row['Norma1'].', ';}
				if($row['IdNorma2']!=0){$norma=$norma.$row['Norma2'].', ';}
				if($row['IdNorma3']!=0){$norma=$norma.$row['Norma3'];}
				//req
				$requi='';
				if($row['IdRequisito']!=0) {$requi=$requi.$row['NReq1'].' '.$row['Req1'].', ';}
				if($row['IdRequisito2']!=0){$requi=$requi.$row['NReq2'].' '.$row['Req2'].', ';}
				if($row['IdRequisito3']!=0){$requi=$requi.$row['NReq3'].' '.$row['Req3'].', ';}
				if($row['IdRequisito4']!=0){$requi=$requi.$row['NReq4'].' '.$row['Req4'].', ';}
				if($row['IdRequisito5']!=0){$requi=$requi.$row['NReq5'].' '.$row['Req5'].', ';}
				if($row['IdRequisito6']!=0){$requi=$requi.$row['NReq6'].' '.$row['Req6'];}
				
				//excel
				echo "<tr>\n";
				echo "<td>".str_pad($row['NroNC'], 5, "0", STR_PAD_LEFT)."</td>\n";
				echo "<td>".$fechae."</td>\n";
				echo "<td>".$row['Sector']."</td>\n";
				echo "<td>".$row['Cliente']."</td>\n";
				echo "<td>".$row['Origen']."</td>\n";
				echo "<td>".$row['Descripcion']."</td>\n";
				echo "<td>".$row['Accion']."</td>\n";
				echo "<td>".substr($row['Apellido'].' '.$row['Nombre'],0,25)."</td>\n";				
				echo "<td>".$fechac."</td>\n";
				echo "<td>".$norma."</td>\n";
				echo "<td>".$requi."</td>\n";				
				echo "</tr>\n";			
			}	
			//Cierra tabla excel
			echo "</table>\n";				
		}	
		mysql_free_result($rs);	mysql_close($conn); 
	}

 }
 
 
?>