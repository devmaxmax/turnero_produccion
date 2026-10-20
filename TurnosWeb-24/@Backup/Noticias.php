<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php");include("Codigo/Funciones.php");$_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

//busca datos
$query="SELECT * From noticias";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
if(mysql_num_rows($rs)!=0){
	$_SESSION['TxtTitulo'] = $row['Titulo'];
	$_SESSION['TxtSTitulo'] = $row['Subtitulo'];
	$_SESSION['TxtTexto'] = $row['Texto'];
}mysql_free_result($rs);


?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<? include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include ("Codigo/BannerConMenuHVCMIT.php");?>

<form  name="Formulario" action="IntranetCMIT/zNoticias.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"  >
<tr> <td height="8"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="750" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > 
<td height="20" align="center" valign="bottom" class="Titulo" >BIENVENIDA</td>
</tr>
</table> 
<table> 
<!-- Campos y botones -->
<tr><td  align="center"  valign="top">
<table width="600" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr> <td width="100" height="5"  ></td> <td width="500"></td></tr>
<tr> <td height="5"></td></tr>
<tr><td height="18"  align="right"  >&nbsp;Título:</td><td valign="top" > &nbsp; <input name="TxtTitulo" type="text" class="TextBox" style="width:450px" maxlength="40"  value="<? echo $_SESSION[TxtTitulo]; ?>"></td></tr>
<tr> <td height="5"></td></tr>
<tr><td height="18"  align="right"  >&nbsp;Subtítulo:</td><td valign="top" > &nbsp; <input name="TxtSTitulo" maxlength="40" type="text" class="TextBox" value="<? echo $_SESSION[TxtSTitulo]; ?>" style="width:450px" > </td></tr>
<tr> <td height="5"></td></tr>

<tr><td height="18"  align="right"  valign="top" >&nbsp;Texto:</td><td valign="top" > &nbsp; <textarea name="TxtTexto" style="width:450px" rows="12" class="TextBox" ><? echo $_SESSION[TxtTexto]; ?></textarea> </td></tr>
<tr> <td height="5"></td></tr>

<tr> <td height="19" colspan="2" align="center" valign="middle" > <input name="CmdAceptar" type="submit" class="boton"  value="Guardar" > &nbsp;&nbsp; <input name="CmdCancelar" type="submit" class="boton"  value="Cerrar"  > </td></tr>
<tr> <td height="5"></td></tr>
</table>
</td></tr>

<!--  Mensaje error-->
<tr> <td  align="center"  valign="top"> 			  
<table width="500" border="0"  cellpadding="0" cellspacing="0"  >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table></td>
</tr>	           
<? mysql_close($conn);
$_SESSION[TxtTitulo] = "";
$_SESSION[TxtSTitulo] ="";
$_SESSION[TxtTexto] ="";
?>			
</table>    
</td>
</tr>
</table>
</Form>		
<!-- Comentario-->
<table  width="600" border="0" cellspacing="0" cellpadding="0"  >
<tr><td class="comentario1">
La <font class="comentario3">Bienvenida</font> se mostrará en la página inicial del sistema de <font class="comentario2">Turnos</font> (Clientes y CMIT).</li>
</td></tr>
</table>
<!-- fin Comentario-->


<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>
