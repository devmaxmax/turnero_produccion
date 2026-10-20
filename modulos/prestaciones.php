<?php
if (!defined('IN_SITE')){
  die('Hacking attempt');
}

$prestaciones = sql_query("SELECT * FROM articulos WHERE id = 7 LIMIT 1", true);
$fprestaciones = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='7'  ORDER BY id ASC");

$box1 = sql_query("SELECT * FROM articulos WHERE id = 8 LIMIT 1", true);
$fotos1 = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='8'  AND id !=".$box1['idfoto']." ORDER BY id ASC");
  
$box2 = sql_query("SELECT * FROM articulos WHERE id = 9 LIMIT 1", true);
$fotos2 = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='9' AND id !=".$box2['idfoto']." ORDER BY id ASC");

$box3 = sql_query("SELECT * FROM articulos WHERE id = 11 LIMIT 1", true);
$fotos3 = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='11'  AND id !=".$box3['idfoto']." ORDER BY id ASC");
  
$box4 = sql_query("SELECT * FROM articulos WHERE id = 12 LIMIT 1", true);
$fotos4 = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='12' AND id !=".$box4['idfoto']." ORDER BY id ASC");

$box5 = sql_query("SELECT * FROM articulos WHERE id = 13 LIMIT 1", true);
$fotos5 = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='13' AND id !=".$box5['idfoto']." ORDER BY id ASC");

$box6 = sql_query("SELECT * FROM articulos WHERE id = 14 LIMIT 1", true);
$fotos6 = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='14' AND id !=".$box5['idfoto']." ORDER BY id ASC");

$titulogal = sql_query("SELECT * FROM articulos WHERE id = 17 LIMIT 1", true);

include('modulos/vista/layout0.php');

?>