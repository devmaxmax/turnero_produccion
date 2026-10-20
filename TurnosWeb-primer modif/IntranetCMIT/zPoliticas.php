<? include("../Codigo/SeguridadCMIT.php"); include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}


if (isset($_POST['CmdAceptar'])){
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		$texto=mysql_real_escape_string($_POST['TxtTexto']);  
		$query="UPDATE parametros set Texto='$texto'"; $rs=mysql_query($query,$conn);
		if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 
		mysql_close($conn); 		
		header("Location:../Politicas.php");
}		






?>

