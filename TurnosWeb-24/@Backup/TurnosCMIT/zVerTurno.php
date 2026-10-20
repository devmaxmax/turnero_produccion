<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

elseif (isset($_POST[CmdAtender])){
	//busco estado
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	$query="SELECT Estado FROM turnos WHERE  Id=".intval($_POST['TxtNumero']);$rs=mysql_query($query,$conn);
	$row=mysql_fetch_array($rs);if(mysql_num_rows($rs)!=0){$estado=$row['Estado'];}else{$estado=0;}mysql_free_result($rs);
	//actualizo SI NO ESTÁ ELIMINADO
	if($estado!=3){
		if($estado==0){$query="Update turnos Set Estado=1 Where Id=".intval($_POST['TxtNumero']);$rs=mysql_query($query,$conn);}
		else{$query="Update turnos Set Estado=0 Where Id=".intval($_POST['TxtNumero']);$rs=mysql_query($query,$conn);}
	}
	//vuelvo
	if ($rs){$feed="msgC="."Los datos se grabaron correctamente";}else{$feed="msgE="."No se grabó el cambio"; } 
	mysql_close($conn); 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	header("Location:VerTurno.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&ide=".$_POST['TxtIdEncriptado']."&Flag1=True");	
}

if (isset($_POST[CmdCancelar])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../VerTurnosCMIT.php?Id=".$_POST['TxtIdEncriptado']);
}

?>


