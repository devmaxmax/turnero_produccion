<?php
if (!defined('IN_SITE')){
  die('Hacking attempt');
}


$novedades = sql_query("SELECT * FROM articulos WHERE idcategoria = 4 AND aprobado = 1 ORDER BY id DESC LIMIT 2");

$imgli = sql_query("SELECT * FROM articulos WHERE id = 16 LIMIT 1", true);

include('modulos/vista/layout.php');

?>