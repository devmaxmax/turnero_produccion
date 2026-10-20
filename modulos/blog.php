<?php
if (!defined('IN_SITE')){
  die('Hacking attempt');
}

$idCategoria = (isset($_VARS[2])) ? intval($_VARS[2]) : 1;

$temas = sql_query("SELECT * FROM articulos WHERE idcategoria = $idCategoria ORDER BY fecha DESC LIMIT 500");

$blogt = sql_query("SELECT * FROM articulos WHERE id = 15 LIMIT 1", true);
$fblogt = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='15'  ORDER BY id ASC");

include('modulos/vista/layout0.php');

?>