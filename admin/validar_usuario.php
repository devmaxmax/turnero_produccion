<?php

define("IN_SITE", true);
$root_path = "./../";
include ($root_path."conf/config.php");
include ($root_path."conf/funciones.php");
session_start();


$usuario = strtolower($_POST["usuario"]);
	$contrasena = md5($_POST['contrasena']);
if($usuario!= "" && $contrasena!= "")
{
	$sql = mysql_query('SELECT contrasena, usuario, permiso FROM users WHERE usuario="'.$usuario.'"');
	if($f= mysql_fetch_array($sql)){

		if($f["contrasena"] == $contrasena  ){
			$_SESSION["usuario"] = $f['usuario'];
      $_SESSION["usuarioid"] = $f['id'];
      $_SESSION["usuariop"] = $f['permiso'];
			@header('Location: index.php');die();


		}


	}else{
		header('Location: login.php');die();
		
	}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>RW Admin | Acceso</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/rwadmin.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
      body {
      background: #b1b1b2 url(img/bgr.jpg) top center; background-attachment:fixed;  background-repeat:no-repeat; background-size:cover; background-position: 50% 50%;
      }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">

  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="text-align: center!important;">

    <img src="../contenido/general/logo-affix2.png" alt="RW Admin" style="margin-bottom: 15px">

    <p class="login-box-msg">Acceso al panel de adminitración</p>

    <form action="validar_usuario.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario" autocomplete="off" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="contrasena" class="form-control" id="contrasena" placeholder="Contraseña"  autocomplete="off" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          
          <input type="submit" name="mode" id="mode" value="Aceptar" class="btn btn-primary btn-block btn-flat">
        </div>
        <!-- /.col -->
      </div>
    </form>


    <br>

  </div>
  <a href="https://www.rwagencia.com" target="_blank" style="text-align: center; color: #fff;"><h5 style="color: #fff;"><small style="color: #fff;">RW | Ideas & Soluciones</small></h5></a>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>