<?php
define("IN_SITE", true);
$root_path = "./../";
include ($root_path."admin/auth.php");
include ($root_path."conf/config.php");
include ($root_path."conf/funciones.php");

?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>RW Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/rwadmin.css">

  <link rel="stylesheet" href="dist/css/skins/skin-blue.css">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<? include ("includes/header.php"); ?>

<? include ("includes/left-aside.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bienvenido a su panel de control
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <!--<li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
         <li class="active">Here</li> -->
        <li class="active"><a href="index"><i class="fa fa-dashboard"></i> Inicio</a></li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

<!-- Inicio Contenido -->




      <!-- Default box -->
      <div class="box">

        <div class="box-body">

            <div class="col-lg-12" style="margin-bottom: 30px">
              <h3>Aquí podrá <span style="color:#366ab2">subir/eliminar/editar</span> los contenidos de su sitio web de manera rápida y simple, con sólo conocimientos básicos de sistemas de gestión.</h3>
            </div>

            <div class="col-lg-3">
              <img src="img/i01.png" alt="" class="img-responsive">
              <br>
            </div>
            <div class="col-lg-3 text-center">
              <img src="img/i02.png" alt="" >
              <h4 style="color:#366ab2">1. SELECCIONAR PÁGINA</h4>
              <p>Seleccionar la página que se desea gestionar, haciendo click en los botones de la barra de menú.</p>
            </div>
            <div class="col-lg-3 text-center">
              <img src="img/i03.png" alt="" >
              <h4 style="color:#e53c52">2. EDICIÓN DE CONTENIDOS</h4>
              <p>Identificar los contenidos disponibles. Subir/eliminar/editar. <br>Click en botón <a href="#" class="btn btn-xs btn-danger" style="margin-left: 5px">Guardar</a> </p>
            </div>
            <div class="col-lg-3 text-center">
              <img src="img/i04.png" alt="" >
              <h4 style="color:#a74096">3. VISUALIZAR CAMBIOS</h4>
              <p>Ingresar al Sitio Web y pulsar las teclas Ctrl+F5 simultaneamente, para pedirle al navegador que actualice la Web.</p>
            </div>


        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->




<!-- Fin Contenido -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <? include ("includes/footer.php"); ?>


  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>