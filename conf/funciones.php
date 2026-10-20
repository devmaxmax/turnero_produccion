<?php

$t = array_keys($_GET);
$_VARS =  explode("/", $t[0]);

$_ERROR == "";

@ini_set("session.use_only_cookies","1");
@ini_set("session.use_trans_sid","0");
session_start();


if (!isset($_COOKIE['PID'])) {
	$CARTID = md5(uniqid(rand(),1));
	setcookie("PID", $CARTID, time()+ (3600 * 12));  // 12 HORAS	
}
else {
	$CARTID = substr(addslashes($_COOKIE['PID']), 0, 32);
}

include ($root_path."modulos/includes/carrito.class.php");
$carrito = new carrito($CARTID);

/* vista catalogo */

if(empty($_SESSION['vista'])) {
  $_SESSION['vista'] = 'vista';
}
elseif( in_array($_VARS[4], array('lista','galeria'))) {
  $_SESSION['vista'] = $_VARS[4];
}
elseif (!in_array($_SESSION['vista'], array('lista','galeria'))) {
  $_SESSION['vista'] = 'galeria';
}

$_VISTA = $_SESSION['vista'];




function clean($t){
  return preg_replace("/[^A-Za-z0-9Ññ ]/", "", $t );
}


function cleanXSS($t){
 // alert String fromCharCode
 $r = '~`"!+/<>¬´¨$%^&_\'\\[]¡¢£¤¥¦§¨©ª«¬­®¯‘’‚“”„†‡•…‰ª·º^€™ŒœŠšŸƒðñòóôõö÷øùúûüýþÿàáâãäåæçèéêëìíîïÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏ°±²³´µ¶·¸¹º»¼½¾¿¡¢£¤¥¦§¨©ª«¬­®¯';
 $len = strlen($r);
 for ($i = 0; $i < $len; $i++) {
    $t = str_replace($r[$i], " ", $t);
 }
 return trim($t);
}

function url_friendly($t){
  return str_replace(' ', '-', $t);
}

function url_friendly2($t){
  return str_replace('_', ' ', $t);
}

function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}

function formato_fecha($date, $formato = "corto")
{
  $meses = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
  ereg( "([0-9]{4})-([0-9]{2})-([0-9]{2})", $date, $fecha);
  $text = ($formato != "corto") ? ($fecha[3]." de ".$meses[intval($fecha[2])]." de ".$fecha[1]) : ($fecha[3]."/".$fecha[2]."/".$fecha[1]);
  return $text;
}

function url_amigable($url)
{
  $url = trim($url); //strtolower(trim($url));
  $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ', 'Ñ', '/');
  $repl = array('a', 'e', 'i', 'o', 'u', 'n', 'N', '-');
  $url = str_replace ($find, $repl, $url);
  $find = array(' ', '&', '\r\n', '\n', '+');
  $url = str_replace ($find, '-', $url);
  $find = array('/[^a-zA-Z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
  $repl = array('', '-', '');
  $url = preg_replace ($find, $repl, $url);
  return $url;
}

function thumb ($from, $to, $tnw, $tnh)
{
	$im = ImageCreateFromJPEG( $from );	
	$srcW = ImageSX( $im );
	$srcH = ImageSY( $im );
	$scale = min($tnw/$srcW, $tnh/$srcH);
	$width = (int)($srcW*$scale);
	$height = (int)($srcH*$scale);
	$ni = imagecreatetruecolor( $width, $height );
	$bcolor  = imagecolorallocate($ni, 255, 255, 255);	
	imagecopyresampled( $ni, $im, 0, 0, 0, 0, $width, $height, $srcW, $srcH );		
	ImageJPEG( $ni, $to, 100);
	ImageDestroy($ni);
	ImageDestroy($im);
}
function thumb2 ($from, $to, $tnw, $tnh)
{


// Primero crearemos nuestra imagen de la estampa manualmente desde GD
$estampa = imagecreatetruecolor(190, 30);


$im = imagecreatefromjpeg($from);

imagestring($estampa, 5, 5, 5, '', 0xFFFFFF);

// Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
$margen_dcho = 10;
$margen_inf = 10;
$sx = imagesx($estampa);
$sy = imagesy($estampa);

// Fusionar la estampa con nuestra foto con una opacidad del 50%
imagecopymerge($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa), 0);

// Guardar la imagen en un archivo y liberar memoria

ImageJPEG( $im, $to, 100);
imagedestroy($im);

}

function sql_query( $query, $is_single = false )
{
  $contenido = array();
  if($result = mysql_query($query))
  {
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
    {
      $contenido[] = $row;
    }
    return ($is_single) ? $contenido[0] : $contenido;
  }
  else
  {
    die(mysql_error());
  }
}







function cortar_string ($string, $largo) { 
   $marca = "<!--corte-->"; 

   if (strlen($string) > $largo) { 
        
       $string = wordwrap($string, $largo, $marca); 
       $string = explode($marca, $string); 
       $string = $string[0]; 
   } 
   return $string; 

}

/*----------------------------------------------------------------------------*/



function html_publicidad ($zona)
{
  $publicidades = sql_query ("SELECT html FROM publicidad WHERE ubicacion = '$zona' ORDER BY ubicacion ASC");
  print('<div class="publicidad zona'.$zona.'">');
  foreach($publicidades as $row):
    print(html_entity_decode($row['html'])."<table width='190' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td height='5'></td>
  </tr>
</table>
");
  endforeach;
  print('</div>');
}


?>
