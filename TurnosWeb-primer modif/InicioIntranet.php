<? include ("Codigo/HeadFull.php");?>

<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css" >

<style>
  body {
  background: #eeeeee;
  }
</style>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0"  marginheight="0"  class="body2 "onLoad="document.forms['Formulario']['TxtUsuario'].focus();">
<? include ("Codigo/BannerInicioLog.php");?>

<form name="Formulario" action="Codigo/Verifica_Login.php" method="post">



<!-- Bienvenida --> 
<table width="100%" border="0"  cellpadding="0" cellspacing="0" style="margin-top:1.4rem;">

    <tr>
        <td height="20"></td>
    </tr>
    <tr>
        <td height="20" align="center" valign="middle"  class="TituloLoguin1" >Solicitar Turno</td>
    </tr>

</table>

    <div class="login-box">

        <p class="login-box-msg">Por favor ingrese sus datos de acceso</p>

        <div class="form-group has-feedback">
            <input name="TxtUsuario" type="text" class="form-control" maxlength="100" onKeyDown="enterxtab(event)" placeholder="Usuario" style="font-size: 1.2rem;">
            <i class="fa fa-user" style="color:#ccc; line-height: 39px; position:absolute; top:0px; right:12px"></i>
        </div>

        <div class="form-group has-feedback">
            <input name="TxtPassword" type="password" class="form-control" maxlength="8" placeholder="Contrase&ntilde;a" style="font-size: 1.2rem;">
            <i class="fa fa-lock" style="color:#ccc; line-height: 39px; position:absolute; top:0px; right:12px"></i>
        </div>

        <div class="form-group">
            <input type="submit" name="CmdAceptar" value="Iniciar sesi&oacute;n" class="btn btn-primary btn-block btn-flat">
        </div>

    </div>

<!-- Registrarse -->    
<table width="320" border="0"  cellpadding="0" cellspacing="0">
    <tr>
        <td height="7"></td>
    </tr>
    <tr>
        <td height="20" align="center" valign="middle" ><input name="CmdAyuda" type="submit" class="botonlog"   value="Olvid&oacute; su Contrase&ntilde;a?" > &nbsp; <input name="CmdRegistrar" type="submit" class="botonlog" value="Crear una Cuenta" ></td></tr>
    <tr>
        <td height="10"></td>
    </tr>
</table>


<!--Error-->
<table width="400" border="0" cellspacing="0" cellpadding="0">
    <tr align="center">
        <td align="center" class="MuestraConf" style="padding: 5px 0px;">
            <? if (!(empty($_GET['msgC']))){echo '<div class="alert-success"><i class="fas fa-check-circle iconvsmallsp"></i> '.$_GET['msgC'].'</div>';} ?>
        </td>
    </tr>
    <tr align="center">
        <td align="center" class="MuestraError" style="padding: 5px 0px;">
            <? if (!(empty($_GET['msgE']))){echo '<div class="alert-danger"><i class="fas fa-exclamation-circle iconvsmallsp"></i>'.$_GET['msgE'].'</div>';} ?>
        </td>
    </tr>
</table>


<div class="col-md-12" style="margin:30px 0px;"><img src="CSS/Imagenes/Certificado.png" class="img-responsive"></div>

<? //limpia las var de session
$_SESSION['TxtUsuario'] = "";
$_SESSION['TxtPassword'] = "";
?>			
</Form>
<? include ("Codigo/FooterSinUsuario.php");?>