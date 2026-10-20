<?php
define("IN_SITE", true);
$root_path = "./../";
include ($root_path."admin/auth.php");
include ($root_path."conf/config.php");
include ($root_path."conf/funciones.php");


if( isset($_GET['borrar']) )
{
  $idItem = intval($_GET['borrar']);
  $query = "DELETE FROM users WHERE id='".$idItem."'";
  $result = mysql_query($query) or print(mysql_error());

  
}

$datos = sql_query("SELECT * FROM users ORDER BY id DESC LIMIT 500");

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
        Usuarios <small>Administración de usuarios y permisos del panel de control</small>
      </h1>

      <ol class="breadcrumb">
        <!--<li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
         <li class="active">Here</li> -->
        <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

<!-- Inicio Contenido -->
      <div class="row">
        <div class="col-md-12 barra_tope">
          <a href="eusuarios.php" class="btn btn-success pull-right">Nuevo Usuario</a>
          
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">

      <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Usuario</th>
                  <th>Password</th>
                  <th>Email</th>
                  <th>Nivel</th>
                  <th>Opciones</th>
                </tr>

          <? foreach ($datos as $row) : ?>

                <tr>
                  <td><?=$row['id'];?></td>
                  <td><?=$row['usuario'];?></td>
                  <td><?=$row['contrasena'];?></td>
                  <td><?=$row['email'];?></td>
                  <td>
                    <? print ($row['permiso'] == 0) ? '<span class="label label-success">Administrador</span>' : '';?>
                    <? print ($row['permiso'] == 1) ? '<span class="label label-primary">Usuario</span>' : '';?>
                    <? print ($row['permiso'] == 2) ? '<span class="label label-warning">Webmaster</span>' : '';?>
                  </td>
                  <td>
                      <a href="?borrar=<?=$row['id'];?>" class="btn btn-danger btn-xs" onClick="return confirm('Desea eliminar el contacto ?')">Eliminar</a>
                      <a href="eusuarios.php?id=<?=$row['id'];?>" class="btn btn-primary btn-xs">Editar</a>
                  </td>
                </tr>

        <? endforeach; ?>

              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->

        </div>
      </div>



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