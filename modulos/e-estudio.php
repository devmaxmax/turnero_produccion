<?php
if (!defined('IN_SITE')){
  die('Hacking attempt');
}

$eestudio = sql_query("SELECT * FROM articulos WHERE id = 18 LIMIT 1", true);
$feestudio = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='18'  ORDER BY id ASC");


$columna01 = sql_query("SELECT * FROM articulos WHERE id = 19 LIMIT 1", true);
$columna02 = sql_query("SELECT * FROM articulos WHERE id = 20 LIMIT 1", true);
$columna03 = sql_query("SELECT * FROM articulos WHERE id = 21 LIMIT 1", true);
$columna04 = sql_query("SELECT * FROM articulos WHERE id = 22 LIMIT 1", true);
$columna05 = sql_query("SELECT * FROM articulos WHERE id = 23 LIMIT 1", true);
$columna06 = sql_query("SELECT * FROM articulos WHERE id = 24 LIMIT 1", true);

include('modulos/vista/layout_e.php');

?>