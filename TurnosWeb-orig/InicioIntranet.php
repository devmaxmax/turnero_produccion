<? include ("Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css" >
</head>
<body leftmargin="0" topmargin="0" marginwidth="0"  marginheight="0"  class="body2 "onLoad="document.forms['Formulario']['TxtUsuario'].focus();">
<? include ("Codigo/BannerInicio.php");?>


<form name="Formulario" action="Codigo/Verifica_Login.php" method="post">
<!-- Bienvenida -->	
<table width="100%" border="0"  cellpadding="0" cellspacing="0" class="fondo" style="margin-top:1.4rem;">
<tr> <td  height="20"  ></td> </tr>
<tr><td height="20" align="center" valign="middle"  class="TituloLoguin1" > Solicitar Turno </td></tr>
<tr> <td  height="15"  ></td> </tr>
<tr><td height="20" align="center" valign="middle"  class="TituloLoguin2" > Por favor ingrese sus datos de acceso</td></tr>
<tr> <td  height="5"  ></td> </tr>
</table>

<!-- login -->			
<table width="320"  border="0" cellspacing="0"  class="TablaLogin" style="margin-top:1.4rem; " align="center">
<tr><td style="padding-top:2.1rem;padding-bottom:0.5rem"  align="center" ><input name="TxtUsuario" type="text" class="TextBoxLogin" maxlength="100" style="width:19rem;height:2rem;font-size: 1.1rem;" onKeyDown="enterxtab(event)" placeholder="Correo Electr&oacute;nico"></td></tr>
<tr> <td align="center" style="padding-bottom:0.9rem"><input name="TxtPassword" type="password" maxlength="8" style="width:19rem;height:2rem;font-size: 1.1rem;"  class="TextBoxLogin" placeholder="Contrase&ntilde;a"  ></td></tr>
<tr><td style="padding-bottom:1.4rem" align="center" ><input name="CmdAceptar" type="submit" class="botonlogin"  value="Iniciar sesi&oacute;n"  ></td></tr>
</table>

<!-- Registrarse -->	
<table width="320" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr> <td  height="7"  ></td> </tr>
<tr><td height="20" align="center" valign="middle" ><input name="CmdAyuda" type="submit" class="botonlog"   value="Olvid&oacute; su Contrase&ntilde;a?" > &nbsp; <input name="CmdRegistrar" type="submit" class="botonlog" value="Crear una Cuenta" ></td></tr>
<tr> <td  height="10"  ></td> </tr>
</table>
<!--Error-->
<table width="400" border="0" cellspacing="0" cellpadding="0" >
<tr align="center"> <td align="center" class="MuestraConf" > <? if (!(empty($_GET['msgC']))){echo '<i class="fas fa-check-circle iconvsmallsp"></i> '.$_GET['msgC'];} ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraError" > <? if (!(empty($_GET['msgE']))){echo '<i class="fas fa-exclamation-circle iconvsmallsp"></i> '.$_GET['msgE'];} ?> </td> </tr>
</table> 

 <div ><img src="CSS/Imagenes/Certificado.png" style="width:40%;margin-top:0.4rem;"></div>

<? //limpia las var de session
$_SESSION['TxtUsuario'] = "";
$_SESSION['TxtPassword'] = "";
?>			
</Form>
<? include ("Codigo/FooterSinUsuario.php");?>