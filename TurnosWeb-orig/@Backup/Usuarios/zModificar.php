<? 
include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php") ;

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

if (isset($_POST[CmdAceptar])){
	if ( (intval($_POST['CbPerfil'])==0) ){
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
		$feed="&msgE=Por favor complete los campos requeridos";	
		header("Location:Modificar.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016').$feed);
		
	}else{
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		$perf=intval($_POST['CbPerfil']); 
		$usr=mysql_real_escape_string($_POST['TxtUsuario']);
		$query="UPDATE usuarios set IdPerfil=$perf Where Usuario='".$usr."'";$rs=mysql_query($query,$conn);
		if ($rs){$feed="&msgC="."Los datos se grabaron correctamente";}else{$feed="&msgE="."Los datos NO se grabaron"; } 
		mysql_close($conn);	
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}
		header("Location:../Usuarios.php?".$feed);
}}


elseif (isset($_POST[CmdCancelar])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../Usuarios.php");
}


?>