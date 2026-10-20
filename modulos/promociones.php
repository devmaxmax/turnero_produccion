<?php
if (!defined('IN_SITE')){
  die('Hacking attempt');
}

$promociones = sql_query("SELECT * FROM articulos WHERE id = 8 LIMIT 1", true);
$fpromociones = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='8'  ORDER BY id ASC");

$promrender = sql_query("SELECT * FROM art WHERE idcategoria = 9 ORDER BY id DESC LIMIT 10");

include('modulos/vista/layout3.php');

?>