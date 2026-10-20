<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

if (isset($_POST[CmdBuscar])){		
	if ((empty($_POST['TxtBusqueda']))){$wrs="";}
	else{
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		$cri=mysql_real_escape_string($_POST['TxtBusqueda']);$wrs="and (u.RSF Like '%".$cri."%')";
		mysql_close($conn); 
	}
	$bloq=intval($_POST['ChkBloq']);if($bloq!=0){$wbloq="and u.Bloqueado<>0";}else{$wbloq='';}
	$bloqaa=intval($_POST['ChkBloqAA']);if($bloqaa!=0){$wbloqaa="and u.Bloqueado=2";}else{$wbloqaa='';}
	$fpago=intval($_POST['CbFP']);if($fpago!=99){$wfpago="and u.FPago=$fpago";}else{$wfpago='';}
	$query="Select u.* From usuarios u Where u.Usuario<>'ngrunmann@gmail.com' and u.IdPerfil=5 $wrs $wfpago $wbloq $wbloqaa Order by u.RSF";
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION[TxtConsultaCli]=$query;
	header("Location:../Clientes.php");
}




if (isset($_POST[CmdBorrar])){	
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	$query="Delete From usuarios Where Usuario='".mysql_real_escape_string($_POST['TxtId'])."'";$rs=mysql_query($query,$conn);
	if ($rs){$feed="msgC="."Los datos se grabaron correctamente";}else{$feed="msgE="."No se grabó el cambio"; } 
	mysql_close($conn); 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	header("Location:../Clientes.php?".$feed);	
}



if (isset($_POST[CmdVer])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:Modificar.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016')."&Flag1=True");	
}

if (isset($_POST[CmdAgregar])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../LoginRegistrarCMIT.php");	
}

if (isset($_POST[CmdEmpresas])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../Empresas.php");
}

if (isset($_POST[CmdClave])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:CambioClave.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016'));	
}


if (isset($_POST[CmdSalir])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../InicioCMIT.php");
}

if (isset($_POST[CmdExcel])){
	$query=$_POST['TxtConsultaCli'];$query=str_replace("\\", "", $query);
	if ($query!=""){
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);
		if(mysql_num_rows($rs)!=0){	
			//Titulos excel
			include("../Codigo/ExcelHeader.php");
			echo "<table border=0 ".'style="font-size:10px"'.">\n ";	
			echo "<tr><td ".'colspan="4"'."><strong>USUARIOS DE CLIENTES REGISTRADOS</strong></td></tr>\n </table>\n";
			echo "<table border=1 ".'style="font-size:10px"'.">\n ";
			echo '<tr style="background:#FFCC00">'."\n";
			echo "<th>Usuario</th>\n";
			echo "<th>Apellido</th>\n";	
			echo "<th>Nombre</th>\n";	
			echo "<th>Teléfono</th>\n";	
			echo "<th>Razón Social</th>\n";					
			echo "<th>CUIT</th>\n";	
			echo "<th>Nombre Fantasia</th>\n";
			echo "<th>Domicilio Real</th>\n";	
			echo "<th>Ciudad/Provincia</th>\n";	
			echo "<th>Empresa Planilla</th>\n";	
			echo "<th>Forma de Pago</th>\n";	
			echo "<th>Alta</th>\n";		
			echo "<th>Bloqueado</th>\n";		
			echo "</tr>\n";				
			while($row=mysql_fetch_array($rs)){ 
				if($row['FPago']==0){$fpago='Contado';}else{$fpago='Contado y Cta.Cte';}
				if ($row['Bloqueado']==0){$inac="";}else{$inac="Bloqueado";}
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
				echo "</tr>\n";			
			}	
			//Cierra tabla excel
			echo "</table>\n";				
		}mysql_free_result($rs);
		mysql_close($conn); 	
	}
 }
 
 
?>