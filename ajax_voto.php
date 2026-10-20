<?php
define("IN_SITE", true);
$root_path = "./";

include ($root_path."conf/config.php");
include ($root_path."conf/funciones.php");

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$db = new mysqli($db_host, $db_username, $db_password,$db_name) or die('could not connect to database');

if($_POST)
{
	$voto = trim($_POST["voto"]);
	$id = filter_var(trim($_POST["id"]),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
	
	if (isset($_COOKIE["votado_".$id]))
	{
		echo "voto_duplicado";
	}
	else
	{
		$total_votos=$db->query("select ".$voto." from articulos WHERE id='$id' limit 1");
		if ($fila=$total_votos->fetch_array()) $numero=$fila[$voto];
		
		$votado=$db->query("UPDATE articulos SET ".$voto."=".$voto."+1 WHERE id='$id'");
		setcookie("votado_".$id, 1, time()+7200);
		echo ($numero+1);
	}

}
?>