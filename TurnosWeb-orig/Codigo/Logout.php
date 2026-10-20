<?php  
session_start();
if(!isset($_SESSION)){//no existe session
header("location:../TurnosWeb.php");
} else {
//borro session
session_unset();
session_destroy();
header("location:../TurnosWeb.php");
}
?>

