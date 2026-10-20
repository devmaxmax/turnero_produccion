<? include("Codigo/Seguridad.php") ;include("Codigo/Config.php");  $_SESSION["NivelArbol"]=""; ?>
 
 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">   
<html>
<head>
<? include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css" >
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['TxtClaveActual'].focus()">
<? include ("Codigo/BannerConMenuHV.php");?>

<form name="Formulario" action="<?=$PHP_SELF?>" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"  >
<tr> <td height="8"></td></tr>
<tr > <td align="right" valign="top" > </td></tr>					
<tr><td align="center">
<table width="750" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" ></td> </tr>
</table> 
<table> 
<tr><td  align="center"  valign="top">



</td></tr>

<!--  Mensaje error-->
<tr> <td  align="center"  valign="top"> 			  
<table width="500" border="0"  cellpadding="0" cellspacing="0"  >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table></td>
</tr>	           
</table>    
</td>
</tr>
</table>
</Form>	

<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>





