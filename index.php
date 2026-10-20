<?php
define("IN_SITE", true);
$root_path = "./";
include ($root_path."conf/config.php");
include ($root_path."conf/funciones.php");

$paginas = array ('inicio', 'nosotros', 'prestaciones', 'blog', 'contacto', 'turnos', 'presupuesto', 'e-estudio', 'apto-fisico');

$t = array_keys($_GET);
$_VARS =  explode("/", $t[0]);

$pagina = (in_array($_VARS[1], $paginas)) ? $_VARS[1] : 'inicio';


include('modulos/'.$pagina.'.php');


?>



