<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

if (isset($_POST['CmdBuscar'])){	
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
	//razon social
	if ((empty($_POST['TxtBusqueda']))){$wrs="";}
	else{$cri=mysql_real_escape_string($_POST['TxtBusqueda']);$wrs="and (u.RSF Like '%".$cri."%')";	}
	//usuario
	if ((empty($_POST['TxtBusquedaU']))){$wusr="";}
	else{$cri=mysql_real_escape_string($_POST['TxtBusquedaU']);$wusr="and (u.Usuario Like '%".$cri."%')";	}
	mysql_close($conn); 
	//
	$bloq=intval($_POST['ChkBloq']);if($bloq!=0){$wbloq="and u.Bloqueado<>0";}else{$wbloq='';}
	$bloqaa=intval($_POST['ChkBloqAA']);if($bloqaa!=0){$wbloqaa="and u.Bloqueado=2";}else{$wbloqaa='';}
	$fpago=intval($_POST['CbFP']);if($fpago!=99){$wfpago="and u.FPago=$fpago";}else{$wfpago='';}
	$riesgo=intval($_POST['ChkR']);if($riesgo!=0){$wriesgo="and (u.Riesgo<>0 or u.FPago=0)";}else{$wriesgo='';}
	$sat=intval($_POST['ChkSA']);if($sat!=0){$wsat="and (u.SA=1)";}else{$wsat='';}//sinalta 
	//
	$query="Select u.* From usuarios u Where u.Usuario<>'ngrunmann@gmail.com' and u.IdPerfil=5 $wrs $wfpago $wbloq $wbloqaa $wusr $wriesgo $wsat Order by u.RSF";
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION['TxtConsultaCli']=$query;
	header("Location:../Clientes.php");
}




if (isset($_POST['CmdBorrar'])){	
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	$query="Delete From usuarios Where Usuario='".mysql_real_escape_string($_POST['TxtId'])."'";$rs=mysql_query($query,$conn);
	if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 
	mysql_close($conn); 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
	header("Location:../Clientes.php");	
}



if (isset($_POST['CmdVer'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	$_SESSION['TxtConsultaCli']=$_POST['TxtConsultaCli'];
	header("Location:Modificar.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016')."&Flag1=True");	
}

if (isset($_POST['CmdAgregar'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../LoginRegistrarCMIT.php");	
}

if (isset($_POST['CmdEmpresas'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	$_SESSION['TxtConsultaCli']=$_POST['TxtConsultaCli'];
	header("Location:../Empresas.php");
}

if (isset($_POST['CmdAcciones'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	$_SESSION['TxtConsultaCli']=$_POST['TxtConsultaCli'];
	header("Location:../ClientesA.php");
}

if (isset($_POST['CmdClave'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	$_SESSION['TxtConsultaCli']=$_POST['TxtConsultaCli'];
	header("Location:CambioClave.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016'));	
}



if (isset($_POST['CmdExcel'])){
	$query=$_POST['TxtConsultaCli'];$query=str_replace("\\", "", $query);
	if ($query!=""){
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);
		if(mysql_num_rows($rs)!=0){	
			//Titulos excel
			include("../Codigo/ExcelHeader.php");
			include("../Codigo/ExcelStyle.php");
			echo "<th>Usuario</th>\n";
			echo "<th>Apellido</th>\n";	
			echo "<th>Nombre</th>\n";	
			echo "<th>Telefono</th>\n";	
			echo "<th>Razon Social</th>\n";					
			echo "<th>CUIT</th>\n";	
			echo "<th>Nombre Fantasia</th>\n";
			echo "<th>Domicilio Real</th>\n";	
			echo "<th>Ciudad/Provincia</th>\n";	
			echo "<th>Empresa Planilla</th>\n";	
			echo "<th>Forma de Pago</th>\n";	
			echo "<th>Alta</th>\n";		
			echo "<th>Bloqueado</th>\n";	
			echo "<th>Cliente Riesgo</th>\n";	
			echo "</tr>\n";				
			while($row=mysql_fetch_array($rs)){ 
				if($row['FPago']==0){$fpago='Contado';}else{$fpago='Contado y Cta.Cte';}
				if ($row['Bloqueado']==0){$inac="";}else{$inac="Bloqueado";}
				if (GLO_TURRiesgo($row['Riesgo'],$row['FPago'])==0){$riesgo="";}else{$riesgo="Riesgo";}
				echo "<tr>\n";
				echo "<td>".$row['Usuario']."</td>\n";
				echo "<td>".$row['Apellido']."</td>\n";
				echo "<td>".$row['Nombre']."</td>\n";				
				echo "<td>".$row['Tel']."</td>\n";				
				echo "<td>".$row['RSF']."</td>\n";
				echo "<td>".$row['CUITF']."</td>\n";
				echo "<td>".$row['NFF']."</td>\n";
				echo "<td>".$row['DomiF']."</td>\n";
				echo "<td>".$row['PciaF']."</td>\n";				
				echo "<td>".$row['RSPF']."</td>\n";
				echo "<td>".$fpago."</td>\n";
				echo "<td>".FormatoFecha($row['FechaA'])."</td>\n";
				echo "<td>".$inac."</td>\n";
				echo "<td>".$riesgo."</td>\n";
				echo "</tr>\n";			
			}	
			//Cierra tabla excel
			echo "</table>\n";				
		}mysql_free_result($rs);
		mysql_close($conn); 	
	}
 }
 
 
?>