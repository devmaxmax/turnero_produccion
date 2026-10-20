<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
<?php include ("Codigo/Head.php");?>
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
<? include ("Codigo/BannerSinMenuHV.php");?>
<form name="Formulario" action="IntranetCMIT/zIntranet.php" method="post">
<!-- Campos -->			
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="Fondo"  >
<tr> <td  height="5" width="150"></td> <td  width="450"></td><td  width="150"></td></tr>
<tr> 
<!--izq. -->
<td height="100%">
<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0" class="Fondo"  >
<tr><td  valign="bottom">

</td></tr>
</table>
</td> 

<!--centro -->
<td>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="Fondo"  >
<tr><td>

<div class="post">
<? include("Codigo/Config.php") ;
$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
$query="SELECT * From noticias";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
if(mysql_num_rows($rs)!=0){
	$titulo = $row['Titulo'];
	$stitulo = $row['Subtitulo'];
	$texto = $row['Texto'];
}mysql_free_result($rs);mysql_close($conn);

echo '<h2 class="title">'.$titulo.'</h2>';
echo '<p class="title2">'.$stitulo.'</p>';
echo '<p class="entry">'.$texto.'</p>';
?> 
</div>

</td></tr>
<tr><td>

</td></tr>
</table>
</td> 

<!--derecha -->
<td valign="top">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="Fondo"  >
<tr><td valign="top" align="right"><input name="CmdSistema"  type="submit" class="boton5"  value="Turnos" onClick="document.Formulario.target='_self'" >&nbsp;</td></tr>
<tr><td height="1"></td></tr>
<tr><td valign="top" align="right"></td></tr>
<tr><td height="1"></td></tr>
<tr><td valign="top" align="right"></td></tr>

</table>
</td> 
</tr>     
</table>
<!-- fin Campos -->	

</Form>
<? include ("Codigo/FooterSinUsuario.php");?>
</body>
</html>