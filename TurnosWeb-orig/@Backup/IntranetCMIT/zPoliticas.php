<? include("../Codigo/SeguridadCMIT.php"); include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}


if (isset($_POST[CmdAceptar])){
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		$texto=mysql_real_escape_string($_POST['TxtTexto']);  
		$query="UPDATE parametros set Texto='$texto'"; $rs=mysql_query($query,$conn);
		if ($rs){$feed="&msgC="."Los datos se grabaron correctamente";}else{$feed="&msgE="."Los datos NO se grabaron"; } 
		mysql_close($conn); 		
		header("Location:../Politicas.php?".$feed);
}		



elseif (isset($_POST[CmdCancelar])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../InicioCMIT.php");
}
 
 
 
 
 



?>

