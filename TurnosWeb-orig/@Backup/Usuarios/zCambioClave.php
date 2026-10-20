<? 
include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php") ;

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

	
if (isset($_POST[CmdAceptar])){
	//valido
	$requerido=1;
	if ((empty($_POST['TxtClave'])) or (empty($_POST['TxtConfirmar']))){$requerido=2;$feed='&msgE='.'Por favor complete los campos requeridos';}
	if ($_POST['TxtClave']!=$_POST['TxtConfirmar']){$requerido=2;$feed='&msgE='.'La clave y su confirmación no coinciden';}
	if (strlen($_POST['TxtClave'])<8){$requerido=2;$feed='&msgE='.'La clave debe tener 8 caracteres';}
	if (!preg_match('`[0-9]`',$_POST['TxtClave'])){$requerido=2;$feed='&msgE='.'La clave debe tener al menos un caracter numérico';}
	if ((!preg_match('`[a-z]`',$_POST['TxtClave'])) and (!preg_match('`[A-Z]`',$_POST['TxtClave']))){$requerido=2;$feed='&msgE='.'La clave debe tener al menos una letra';}
	//grabo o vuelvo
	if (($requerido!=1)) { 	
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;	}		
		header("Location:CambioClave.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016').$feed);
	}else{ 
		//grabar los datos en la tabla
		$clave=crypt(trim($_POST['TxtClave']), 'otro@letra8'); 	
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
		$query="UPDATE usuarios set Password='".$clave."' Where Usuario<>'admin' and Usuario='".mysql_real_escape_string($_POST['TxtUsuario'])."'";
		$rs=mysql_query($query,$conn);
		if ($rs){$feed="&msgC="."Los datos se grabaron correctamente";}else{$feed="&msgE="."Los datos NO se grabaron"; } 
		//limpiar datos del form anterior
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}	
		header("Location:../Usuarios.php?".$feed);		
	}	
}




elseif (isset($_POST[CmdCancelar])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../Usuarios.php");
}


?>