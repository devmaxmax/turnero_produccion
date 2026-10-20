<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

if (isset($_POST['CmdBorrar'])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	list($a,$m)=explode("|",mysql_real_escape_string($_POST['TxtId']));
	$query="Delete From auditoria Where month(Fecha)=$m and year(Fecha)=$a";$rs=mysql_query($query,$conn);
	if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 
	mysql_close($conn); 
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:Eliminar.php"); 	
}





if (isset($_POST['CmdExcel'])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	list($a,$m)=explode("|",mysql_real_escape_string($_POST['TxtId']));
	$query="Select a.*,aa.Nombre as Accion,at.Nombre as Modulo FROM auditoria a, auditoriaacciones aa, auditoriatablas at Where a.IdAccion=aa.Id and a.IdTabla=at.Id and month(a.Fecha)=$m and year(a.Fecha)=$a Order by a.Id";$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//Titulos excel
		include("../Codigo/ExcelHeader.php");
		include("../Codigo/ExcelStyle.php");
		echo "<th>Fecha</th>\n";			
		echo "<th>Modulo</th>\n";	
		echo "<th>Accion</th>\n";
		echo "<th>Registro</th>\n";
		echo "<th>Usuario</th>\n";
		echo "</tr>\n";				
		while($row=mysql_fetch_array($rs)){ 
			echo "<tr>\n";
			echo "<td>".FormatoFechaHora($row['Fecha'])."</td>\n";
			echo "<td>".$row['Modulo']."</td>\n";
			echo "<td>".$row['Accion']."</td>\n";
			echo "<td>".str_pad($row['IdRegistro'], 6, "0", STR_PAD_LEFT)."</td>\n";
			echo "<td>".$row['IdUsuario']."</td>\n";
			echo "</tr>\n";			
		}	
		echo "</table>\n";				
	}mysql_free_result($rs);
	mysql_close($conn); 	
 }


?>