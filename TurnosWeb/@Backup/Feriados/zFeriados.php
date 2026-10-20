<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}




if (isset($_POST[CmdBuscar])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	//fechas
	if ((empty($_POST['TxtFechaD']))){$wfechad="";}
	else{$wfechad="and DATEDIFF(f.Fecha,'".FechaMySql($_POST['TxtFechaD'])."')>=0";}
	if ((empty($_POST['TxtFechaH']))){$wfechah="";}
	else{$wfechah="and DATEDIFF(f.Fecha,'".FechaMySql($_POST['TxtFechaH'])."')<=0";}	
	$consulta="SELECT f.* From feriados f Where f.Id<>0 $wfechad $wfechah Order by f.Fecha";
	$_SESSION[TxtQuery23]=$consulta;
	mysql_close($conn); 
	header("Location:../Feriados.php");
}


if (isset($_POST[CmdAgregar])){	
	$varquery=$_POST['TxtQuery23'];
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	$_SESSION['TxtQuery23']=$varquery;
	header("Location:Alta.php");
}


if (isset($_POST[CmdBorrarFila])){
	$id=intval($_POST['TxtId']);
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$query="Delete From feriados Where Id=$id";	$rs=mysql_query($query,$conn);
	if ($rs){$feed="msgC="."Los datos se grabaron correctamente";}else{$feed="msgE="."No se grabó el cambio."; } 
	mysql_close($conn); 	
	header("Location:../Feriados.php");
}

elseif (isset($_POST[CmdSalir])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../Inicio.php");
}

if (isset($_POST[CmdExcel])){
$query=$_POST['TxtQuery23'];$query=str_replace("\\", "", $query);
if ($query!=""){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		include("../Codigo/ExcelHeader.php");	
		echo "<table border=0>\n <tr><strong>FERIADOS</strong></tr>\n </table>\n";
		echo "<table border=1 ".'style="font-size:10px"'.">\n ";	
		echo '<tr style="background:#FFCC00">'."\n";
		echo "<th>Numero</th>\n";
		echo "<th>Fecha</th>\n";
		echo "<th>Nombre</th>\n";
		echo "</tr>\n";	
		while($row=mysql_fetch_array($rs)){ 
			$fecha = FormatoFecha($row['Fecha']);if ($fecha=='00-00-0000'){$fecha="";}
			echo "<tr>\n";
			echo "<td>".$row['Id']."</td>\n";
			echo "<td>".$fecha."</td>\n";
			echo "<td >".$row['Nombre']."</td>\n";
			echo "</tr>\n";			
		}	
		echo "</table>\n";				
	}	
	mysql_free_result($rs);	mysql_close($conn); 
}

 }




?>