<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

if (isset($_POST[CmdBuscar])){		
	if ((empty($_POST['TxtBusqueda']))){$wrs1="";$wrs2="";}
	else{
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		$cri=mysql_real_escape_string($_POST['TxtBusqueda']);$wrs1="and (u.RSF Like '%".$cri."%')";$wrs2="and (uc.RSF Like '%".$cri."%')";
		mysql_close($conn); 
	}
	$query1="SELECT u.Usuario,u.Apellido,u.Nombre,u.Tel,u.FechaA,u.RSF,u.CUITF,u.NFF,u.DomiF,u.PciaF,u.RSPF FROM usuarios u Where u.usuario <>'ngrunmann@gmail.com' and u.IdPerfil=5 $wrs1";
	$query2="SELECT u.Usuario,u.Apellido,u.Nombre,u.Tel,u.FechaA,uc.RSF,uc.CUITF,uc.NFF,uc.DomiF,uc.PciaF,uc.RSPF FROM usuariosclientes uc,usuarios u Where uc.Id<>0 and uc.IdUsuario=u.Usuario and u.usuario <>'ngrunmann@gmail.com' and u.IdPerfil=5 $wrs2";
	$query="Select uu.* From ($query1 UNION ALL $query2)uu Order by uu.RSF,uu.Usuario";
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION[TxtConsultaEmpre]=$query;
	header("Location:../Empresas.php");
}


if (isset($_POST[CmdSalir])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../Clientes.php");
}

if (isset($_POST[CmdExcel])){
	$query=$_POST['TxtConsultaEmpre'];$query=str_replace("\\", "", $query);
	if ($query!=""){
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);
		if(mysql_num_rows($rs)!=0){	
			//Titulos excel
			include("../Codigo/ExcelHeader.php");
			echo "<table border=0 ".'style="font-size:10px"'.">\n ";	
			echo "<tr><td ".'colspan="4"'."><strong>EMPRESAS DE CLIENTES REGISTRADOS</strong></td></tr>\n </table>\n";
			echo "<table border=1 ".'style="font-size:10px"'.">\n ";
			echo '<tr style="background:#FFCC00">'."\n";
			echo "<th>Razón Social</th>\n";					
			echo "<th>CUIT</th>\n";	
			echo "<th>Nombre Fantasia</th>\n";
			echo "<th>Domicilio Real</th>\n";	
			echo "<th>Ciudad/Provincia</th>\n";	
			echo "<th>Empresa Planilla</th>\n";	
			echo "<th>Usuario</th>\n";
			echo "<th>Apellido</th>\n";	
			echo "<th>Nombre</th>\n";	
			echo "<th>Teléfono</th>\n";	
			echo "<th>Alta</th>\n";				
			echo "</tr>\n";				
			while($row=mysql_fetch_array($rs)){ 
				echo "<tr>\n";
				echo "<td>".$row['RSF']."</td>\n";
				echo "<td>".$row['CUITF']."</td>\n";
				echo "<td>".$row['NFF']."</td>\n";
				echo "<td>".$row['DomiF']."</td>\n";
				echo "<td>".$row['PciaF']."</td>\n";				
				echo "<td>".$row['RSPF']."</td>\n";
				echo "<td>".$row['Usuario']."</td>\n";
				echo "<td>".$row['Apellido']."</td>\n";
				echo "<td>".$row['Nombre']."</td>\n";				
				echo "<td>".$row['Tel']."</td>\n";				
				echo "<td>".FormatoFecha($row['FechaA'])."</td>\n";
				echo "</tr>\n";			
			}	
			//Cierra tabla excel
			echo "</table>\n";				
		}mysql_free_result($rs);
		mysql_close($conn); 	
	}
 }
 
 
?>