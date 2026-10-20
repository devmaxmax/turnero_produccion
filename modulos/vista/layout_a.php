<?php
define("IN_SITE", true);


$general = sql_query("SELECT * FROM general", true);
$linkColor = $general['background00'] ;

/*
if( $_POST['mode'] == "Mail" )
{



   if ( $_ERROR == "" )
   {
      $asunto = "Suscripción Noticias CMIT Salud Ocupacional SRL";
      $headers  = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=UTF-8\r\n";
      $headers .= "From:info@cmit.com.ar\r\n";
      $mensaje  ='
      <html>
      <head>
        <title>Suscripción Noticias CMIT Salud Ocupacional SRL</title>

      </head>
      <body>
        <table width="650" border="0" cellpadding="0" cellspacing="0" style="FONT: 10pt sans-serif;">

          <tr>
            <td height="35" align="center" valign="middle" bgcolor="#99c1db">
              <img src="http://www.cmit.com.ar/img/nheader.jpg" width="650" height="60">
            </td>
          </tr>

          <tr>   
            <td align="left" style="background:#dbdcde; color:#273541; padding:10px;">
              <br/>
              <p style="font:400 13px arial;color:#111111">Hola '.$_POST['nombre'].'</p>

              <p style="font:400 13px arial;color:#111111;line-height:24px;">Le damos la bienvenida a nuestro correo de suscripción, desde el cual recibirá información relacionada a CMIT, la salud ocupacional y el cuidado general del capital humano de su empresa.</p>

              <p style="font:400 13px arial;color:#111111;line-height:24px;">Ante cualquier consulta no dude en contactarnos a <a href="mailto:info@cmit.com.ar?Subject=Consulta" style="color:#222222!important" style="font:400 13px arial;color:#222;line-height:24px;">info@cmit.com.ar</a></p>
              <br/>
            </td>
          </tr>

          <tr>
            <td align="center" style="background:#313a42; padding:5px 10px;">

                <table width="180" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="60" height="70" align="center"><a href="http://www.cmit.com.ar/" target="_blank"><img src="http://www.cmit.com.ar/img/nweb.png" alt=""></a></td>
                    <td width="60" height="70" align="center"><a href="https://www.facebook.com/cmitlaboral" target="_blank"><img src="http://www.cmit.com.ar/img/nface.png" alt=""></a></td>
                    <td width="60" height="70" align="center"><a href="https://ar.linkedin.com/company/cmit-de-salud-ocupacional-srl" target="_blank"><img src="http://www.cmit.com.ar/img/nlink.png" alt=""></a></td>
                  </tr>              
                </table>

            </td>
          </tr>

        </table>

      </body>
      </html>'; 

    if( mail($_POST['email'], $asunto, $mensaje, $headers) )
      {
        mysql_query("INSERT INTO newsletter (nombreyapellido, email, fecha) VALUES ('".$_POST['nombre']."', '".$_POST['email']."', CURDATE())");   
        @header("Location: index?/inicio#exito");
      }
   }
}


*/


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

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCybHBRoewWSfbTSAtNfm_Nw7GMLsDYulU"></script>
  <script type="text/javascript" src="<?=$general['root'];?>/maps/jquery.googlemap.js"></script>

  <script src="slider2/jquery.flexslider.js"></script>
  <link rel="stylesheet" href="slider2/flexslider.css" type="text/css">

  <script type="text/javascript" charset="UTF-8" async >
    $(window).load(function() {
            $('.flexslider').flexslider({
              controlNav: false
            });
          });
  </script>

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

<div class="container-fluid hidden-xs espaciador"></div>
<div class="container-fluid visible-xs espaciadorxs"></div>

<?php include ("includes/slider_a.php") ;?>

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

<?php include ("includes/footer.php") ;?>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

      <!-- Plugin JavaScript -->
    <script src="<?=$general['root'];?>/js/scrollreveal.min.js"></script>
    <script src="<?=$general['root'];?>/js/jquery.easing.min.js"></script>
    <script src="<?=$general['root'];?>/js/jquery.fittext.js"></script>
    <script src="<?=$general['root'];?>/js/jquery.magnific-popup.min.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="<?=$general['root'];?>/js/creative.js"></script>

    <script type="text/javascript">
    $(document).ready(function() 
    {
      $(".votos .voting_btn").click(function (e) 
      {
        e.preventDefault();
        var voto_hecho = $(this).data('voto');
        var id = $(this).data("id"); 
        var li = $(this);
        
        if(voto_hecho && id)
        {
          $.post('ajax_voto.php', {'id':id, 'voto':voto_hecho}, function(data) 
          {
            if (data!="voto_duplicado") 
            {
              li.addClass(voto_hecho+"_votado").find("span").text(data);
              li.closest("ul").append("");
            }
            else li.closest("ul").append("");
          });
          setTimeout(function() {$('.votado').fadeOut('fast');}, 3000);
        }
      });
    });
    </script>

</body>
</html>