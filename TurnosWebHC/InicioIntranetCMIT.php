<? include ("Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css" >
</head>
<body leftmargin="0" topmargin="0" marginwidth="0"  marginheight="0"  onLoad="document.forms['Formulario']['TxtUsuario'].focus()">
<? include ("Codigo/BannerInicio.php");?>
<form name="Formulario" action="Codigo/Verifica_LoginCMIT.php" method="post">

<!-- Bienvenida -->	
<table width="100%" border="0"  cellpadding="0" cellspacing="0" class="fondo" style="margin-top:1.4rem;">
<tr> <td  height="20"  ></td> </tr>
<tr><td height="20" align="center" valign="middle"  class="TituloLoguin1" > Sistema de Administraci&oacute;n de Turnos CMIT</td></tr>
<tr> <td  height="20"  ></td> </tr>
<tr><td height="20" align="center" valign="middle"  class="TituloLoguin2" > Gestion de Turnos Hisopados COVID</td></tr>
<tr> <td  height="3"  ></td> </tr>
</table>


<!-- Campos -->			
<table width="320"  border="0" cellspacing="0"  class="TablaLogin" style="margin-top:1.4rem;" align="center">
<tr><td style="padding-top:2.1rem;padding-bottom:0.5rem"  align="center" ><input name="TxtUsuario" type="text" class="TextBoxLogin" maxlength="100" style="width:19rem;height:2rem;font-size: 1.1rem;" onKeyDown="enterxtab(event)" placeholder="Usuario"></td></tr>
<tr> <td align="center" style="padding-bottom:0.9rem"><input name="TxtPassword" type="password" maxlength="8" style="width:19rem;height:2rem;font-size: 1.1rem;" class="TextBoxLogin" placeholder="Contrase&ntilde;a"  ></td></tr>
<tr><td style="padding-bottom:1.4rem" align="center" ><input name="CmdAceptar" type="submit" class="botonlogin"  value="Iniciar sesi&oacute;n"  ></td></tr>
</table>

<!--Error-->
<table width="400" border="0" cellspacing="0" cellpadding="0" >
<tr align="center"> <td align="center" class="MuestraError" > <? if (!(empty($_GET['msgE']))){echo '<i class="fas fa-exclamation-circle iconvsmallsp"></i> '.$_GET['msgE'];} ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <? if (!(empty($_GET['msgC']))){echo '<i class="fas fa-check-circle iconvsmallsp"></i> '.$_GET['msgC'];} ?> </td> </tr>
</table> 
<!-- fin Mensaje error -->
<? //limpia las var de session
$_SESSION['TxtUsuario'] = "";
$_SESSION['TxtPassword'] = "";
?>			

</Form>
<? include ("Codigo/FooterSinUsuario.php");?>