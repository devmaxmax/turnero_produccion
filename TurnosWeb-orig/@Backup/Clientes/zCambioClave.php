<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

	
if (isset($_POST[CmdAceptar])){
	//genero nueva contraseña
	$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";$longitudCadena=strlen($cadena);$pass="";$longitudPass=8;
	for($i=1 ; $i<=$longitudPass ; $i++){$pos=rand(0,$longitudCadena-1);$pass .= substr($cadena,$pos,1);}		
	$clave=crypt($pass,'otro@letra8');//encripto
	//grabar los datos en la tabla
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
	$query="UPDATE usuarios set Password='".$clave."' Where Usuario='".mysql_real_escape_string($_POST['TxtUsuario'])."'";
	$rs=mysql_query($query,$conn);
	if ($rs){$feed="&msgC="."La nueva Clave es: ".$pass;}else{$feed="&msgE="."Los datos NO se grabaron"; } 
	//limpiar datos del form anterior
	foreach($_POST as $key => $value){$_SESSION[$key] = "";}	
	header("Location:../Clientes.php?".$feed);
}




elseif (isset($_POST[CmdCancelar])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../Clientes.php?".$feed);
}


?>