<? include("../Codigo/Seguridad.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";


if (isset($_POST['CmdAceptar'])){
	if ( (empty($_POST['TxtRSF'])) or (empty($_POST['TxtDomiF']))  or (empty($_POST['TxtPciaF']))  ){
		foreach($_POST as $key => $value){	$_SESSION[$key] = $value;	}	
		GLO_feedback(3);header("Location:ModificarRS.php?id=".encrypt($_POST['TxtNumero'],'elcrucedelosandes2016'));		
	}else{
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		$cuit=mysql_real_escape_string(ltrim($_POST['TxtCUITF']));
		$dom=mysql_real_escape_string(ltrim($_POST['TxtDomiF']));
		$pcia=mysql_real_escape_string(ltrim($_POST['TxtPciaF']));
		$nf=mysql_real_escape_string(ltrim($_POST['TxtNFF']));
		//actualizo
		$query="UPDATE usuariosclientes set CUITF='$cuit',DomiF='$dom',PciaF='$pcia',NFF='$nf' Where Id=".intval($_POST['TxtNumero']);	
		$rs=mysql_query($query,$conn);
		if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 
		mysql_close($conn); 	
		//limpiar datos del form anterior
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}
		header("Location:../MiCuenta.php");
	}
}



?>


