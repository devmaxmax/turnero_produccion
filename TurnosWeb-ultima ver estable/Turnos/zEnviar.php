<? include("../Codigo/Seguridad.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

if (isset($_POST['CmdAceptar'])){
	//limpiar datos del form anterior
	foreach($_POST as $key => $value){	$_SESSION[$key] = "";	}
	header("Location:ModificarTurno.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016')."&Flag1=True");
}


?>