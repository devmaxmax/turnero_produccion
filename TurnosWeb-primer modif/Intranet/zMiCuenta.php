<? include("../Codigo/Seguridad.php"); include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

if (isset($_POST['CmdAceptar'])){
	if ((empty($_POST['TxtNombre'])) or (empty($_POST['TxtApellido']))  or (empty($_POST['TxtTel']))  or (empty($_POST['TxtRSF'])) or (empty($_POST['TxtDomiF']))  or (empty($_POST['TxtPciaF']))  ){
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;}		
		GLO_feedback(3);header("Location:../MiCuenta.php");
	}else{
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		//grabar los datos en la tabla
		$usr=mysql_real_escape_string($_POST['TxtUsuario']);
		$tel=mysql_real_escape_string(ltrim($_POST['TxtTel']));
		$cuit=mysql_real_escape_string(ltrim($_POST['TxtCUITF']));
		$dom=mysql_real_escape_string(ltrim($_POST['TxtDomiF']));
		$pcia=mysql_real_escape_string(ltrim($_POST['TxtPciaF']));
		$nf=mysql_real_escape_string(ltrim($_POST['TxtNFF']));
	    //update
		$query="UPDATE usuarios set Tel='$tel',CUITF='$cuit',DomiF='$dom',PciaF='$pcia',NFF='$nf'  Where Usuario='$usr'"; 
		$rs=mysql_query($query,$conn);
		if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 
		mysql_close($conn); 		
		header("Location:../MiCuenta.php");
	}		
}


elseif (isset($_POST['CmdVerRS'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:ModificarRS.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016')."&Flag1=True");	
}

elseif (isset($_POST['CmdAddRS'])){	
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:AltaRS.php");
}


elseif (isset($_POST['CmdBorrarRS'])){
	$query="Delete From usuariosclientes Where Id=".intval($_POST['TxtId']);
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);
	if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 
	mysql_close($conn); 
	header("Location:../MiCuenta.php");	
}






?>


