<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}


if (isset($_POST['CmdSiguiente'])){ 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION['IdConsulta']=2;
	header("Location:../InicioCMIT.php");
}


if (isset($_POST['CmdAnterior'])){ 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION['IdConsulta']=1;
	header("Location:../InicioCMIT.php");
}


if (isset($_POST['CmdTurno'])){	
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../VerTurnosCMIT.php?Id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016'));	
}
 
?>