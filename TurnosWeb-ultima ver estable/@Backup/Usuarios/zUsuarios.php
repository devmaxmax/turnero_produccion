<? 
include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php") ;

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

	
if (isset($_POST[CmdBorrar])){	
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	$query="Delete From usuarios Where Usuario<>'ngrunmann@gmail.com' and Usuario='".mysql_real_escape_string($_POST['TxtId'])."'"; 
	$rs=mysql_query($query,$conn);
	if ($rs){$feed="msgC="."Los datos se grabaron correctamente";}else{$feed="msgE="."No se grabó el cambio"; } 
	mysql_close($conn); 
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../Usuarios.php?".$feed);	
}
	
	
elseif (isset($_POST[CmdSalir])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../InicioCMIT.php");
}



if (isset($_POST[CmdAgregar])){	
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:Alta.php");	
}


if (isset($_POST[CmdClave])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:CambioClave.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016'));	
}

?>