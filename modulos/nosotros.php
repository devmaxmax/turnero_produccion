<?php
if (!defined('IN_SITE')){
  die('Hacking attempt');
}

$nosotros = sql_query("SELECT * FROM articulos WHERE id = 1 LIMIT 1", true);
$fnosotros = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='1'  ORDER BY id ASC");

$box44 = sql_query("SELECT * FROM articulos WHERE id = 5 LIMIT 1", true);
$fotos44 = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='5'  AND id !=".$box44['idfoto']." ORDER BY id ASC");
  
$box55 = sql_query("SELECT * FROM articulos WHERE id = 6 LIMIT 1", true);
$fotos55 = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='6' AND id !=".$box55['idfoto']." ORDER BY id ASC");

include('modulos/vista/layout0.php');

?>