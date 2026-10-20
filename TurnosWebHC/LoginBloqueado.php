<? include("Codigo/Config.php");




if(!isset($_SESSION)) { session_start(); } 
//genero captcha
$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";$longitudCadena=strlen($cadena);$pass="";$longitudPass=4;
for($i=1 ; $i<=$longitudPass ; $i++){$pos=rand(0,$longitudCadena-1);$pass .= substr($cadena,$pos,1);}		
$_SESSION['TxtValida1']=$pass;

	
?>


<? include ("Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css" >
</head>


<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['TxtUsuario'].focus()">
<? include ("Codigo/BannerInicio.php");?>

<form name="Formulario" action="Intranet/zLoginBloqueado.php" method="post" >
<table width="100%" border="0"  cellpadding="0" cellspacing="0" >
<tr> <td height="5"></td></tr>
<tr><td align="center">
<table width="100%" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >RECUPERAR CUENTA BLOQUEADA</td></tr>
<tr> <td  height="10"  ></td> </tr>
<tr><td height="20" align="center" valign="middle"  class="TituloLoguin2" > Gestion de Turnos Hisopados COVID</td></tr>
</table> 

<table width="500" border="0"   cellspacing="0" class="Tabla TMT5" >
<tr><td width="100" height="5"  ></td> <td width="400"></td> </tr>
<tr><td height="18"  align="right"  >EMail:</td><td  valign="top" > &nbsp; <input name="TxtUsuario" type="text"  class="TextBox" style="width:250px" maxlength="100"  value="<? echo $_SESSION['TxtUsuario']; ?>"  onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
</table>  

<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	 
<table width="500" border="0"   cellspacing="0" class="Tabla" >
<tr><td width="100" height="5"  ></td> <td width="400"></td> </tr>
<tr><td height="18"  align="right"  >Validar:</td><td  valign="top" > &nbsp; <input name="TxtValida1" type="text"   readonly="true"  class="TextBoxRO" style="width:60px; text-align:center; font-size:14px; letter-spacing:2px; font-weight:bold;background:#c9d9de;" value="<? echo $_SESSION['TxtValida1']; ?>"  onKeyDown="enterxtab(event)">  <input name="TxtValida2" type="text"  class="TextBox" style="width:50px" maxlength="4"  tabindex="1" value="<? echo $_SESSION['TxtValida2']; ?>"  onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label> <label class="comentario1"> (Ingrese el c&oacute;digo de validaci&oacute;n aleatorio) </label></td></tr>
</table>  
      
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	                    

<table width="500" border="0"   cellspacing="0" class="Tabla" >
<tr> <td height="3"></td></tr>
<tr> <td height="19"  align="center" valign="middle" > <input name="CmdAceptar" type="submit" class="boton"  value="Aceptar" >&nbsp;<input name="CmdCancelar" type="submit" class="boton"  value="Cancelar"  > </td></tr>
</table>


<!--  Mensaje error-->
<table width="500" border="0" cellspacing="0" cellpadding="0" >
<tr align="center"> <td align="center" class="MuestraError" > <? if (!(empty($_GET['msgE']))){echo '<i class="fas fa-exclamation-circle iconvsmallsp"></i> '.$_GET['msgE'];} ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <? if (!(empty($_GET['msgC']))){echo '<i class="fas fa-check-circle iconvsmallsp"></i> '.$_GET['msgC'];} ?> </td> </tr>
</table> 


<!-- Comentario-->
<table  width="500" border="0" cellspacing="0" cellpadding="0"  >
<tr> <td height="15"></td></tr>
<tr><td class="comentario1">
1. Introduzca la direcci&oacute;n de <font class="comentario2">email</font> que utiliza para iniciar sesi&oacute;n<br>
2. Seleccione el bot&oacute;n <font class="comentario2">aceptar</font><br>
3. Se enviar&aacute; a <font class="comentario3">CMIT</font> una solicitud para recuperar su cuenta<br>
4. Posteriormente recibir&aacute; en ese email informaci&oacute;n acerca del estado de su tr&aacute;mite<br>
</td></tr>
</table>
<!-- fin Comentario-->
                 
</td></tr>    	
</table>


</Form>	
<? //limpia las var de session
$_SESSION['TxtUsuario']='';
$_SESSION['TxtValida1']='';
$_SESSION['TxtValida2']='';

?>			

<? include ("Codigo/FooterSinUsuario.php");?>