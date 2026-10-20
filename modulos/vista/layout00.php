<?php
define("IN_SITE", true);


$general = sql_query("SELECT * FROM general", true);
$linkColor = $general['background00'] ;

$central = sql_query("SELECT * FROM articulos WHERE id = 10 LIMIT 1", true);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$general['title'];?></title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="format-detection" content="telephone=no">

  <meta name="description" content="Expertos en Exámenes Laborales de Ingreso, Periódicos y Egreso. Desde 1996 acompañamos el crecimiento de las empresas Patagónicas y su capital humano.">
  
  <meta name="keywords" content="cmit, cmit neuquen, juan b justo 825, medicina laboral neuquen, medicina laboral, salud, salud ocupacional, medicina de trabajo, servicio medico laboral, centro de medicina laboral, servicio de medicina del trabajo, servicio de medicina laboral, prestacion, prestaciones, examenes preocupacionales, preocupacionales, examen medico preocupacional, preocupacional laboral, exámenes ingreso, obligatorio, examenes periodico, periodico, examen medico periodico, periodico laboral, examenes egreso, egreso, examen medico egreso, egreso laboral, examen preventivo, preventivo, detección precoz, alteraciones profesionales, enfermedades profesionales, enfermedades trabajo, enfermedades laborales, solicitar turno, turno, presupuesto, psicotecnico, columna, lumbalgia, rx, estudio sangre, examen sangre, estudio drogas, examen drogas, medicina general, audiometria, cardiología, industria, petroleo, gas, vaca muerta">
  
	<script src="<?=$general['root'];?>/js/jquery-1.12.3.min.js"></script>

	<link rel="stylesheet" href="<?=$general['root'];?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=$general['root'];?>/css/estilo.css">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700" rel="stylesheet">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <link href="<?=$general['root'];?>/css/themify-icons.css" rel="stylesheet">


  <script src="<?=$general['root'];?>/lightbox/js/lightbox.min.js"></script>
  <link href="<?=$general['root'];?>/lightbox/css/lightbox.css" rel="stylesheet" />

  <script src="slider2/jquery.flexslider.js"></script>
  <link rel="stylesheet" href="slider2/flexslider.css" type="text/css">

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  <meta property="og:url"           content="<?=$general['root'];?>" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="<?=$general['title'];?>" />
  <meta property="og:description"   content="<?=$general['descripcion'];?>" />
  <meta property="og:image"         content="<?=$general['root'];?>/contenido/general/cmit-f.jpg" />
  
  <script type="text/javascript" charset="UTF-8">
    $(window).load(function() {
            $('.flexslider').flexslider({
              controlNav: false
            });
          });
  </script> 
   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCybHBRoewWSfbTSAtNfm_Nw7GMLsDYulU"></script>
  <script type="text/javascript" src="<?=$general['root'];?>/maps/jquery.googlemap.js"></script>


  <!-- Facebook Pixel Code -->
  <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '484844955371510');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=484844955371510&ev=PageView&noscript=1"
  /></noscript>
  <!-- End Facebook Pixel Code -->

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130617359-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-130617359-1');
  </script>

</head>

<body id="page-top">

<?php include ("includes/header.php") ;?>

<div class="container-fluid hidden-xs espaciador0"></div>
<div class="container-fluid visible-xs espaciadorxs0"></div>



<? include('modulos/vista/'.$pagina.'.php'); ?>


<!-- Boton whats 
<div class="btn-whatsapp">
<a href="https://api.whatsapp.com/send?phone=<?=$general['whatsapp_r'];?>" target="_blank">
<img src="img/btn_whatsapp.png" alt="">
</a>
</div>
-->

<!-- Boton presupuesto -->
<a href="https://www.cmit.com.ar/presupuesto"><i class="fa-solid fa-pen-to-square"></i>
  <div class="btn-presup">
    <div class="btn-presup-t">Solicite su presupuesto</div>
    <div class="btn-presup-i"><i class="fas fa-edit"></i></div>
  </div>
</a>

<?php include ("includes/footer2.php") ;?>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$general['root'];?>/js/bootstrap.min.js"></script>

      <!-- Plugin JavaScript -->
    <script src="<?=$general['root'];?>/js/scrollreveal.min.js"></script>
    <script src="<?=$general['root'];?>/js/jquery.easing.min.js"></script>
    <script src="<?=$general['root'];?>/js/jquery.fittext.js"></script>
    <script src="<?=$general['root'];?>/js/jquery.magnific-popup.min.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="<?=$general['root'];?>/js/creative.js"></script>


</body>
</html>