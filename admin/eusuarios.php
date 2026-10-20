<?php
define("IN_SITE", true);
$root_path = "./../";
include ($root_path."admin/auth.php");
include ($root_path."conf/config.php");
include ($root_path."conf/funciones.php");

if( $_POST['mode'] == "Guardar" )
{
  $idItem = ( isset($_POST['id']) ) ? intval($_POST['id']) : '0';

  

  if($idItem == 0)
  {
    $query = "INSERT INTO users (usuario, contrasena, email, permiso) VALUES ('".$_POST['usuario']."', '".md5($_POST['contrasena'])."',
            '".$_POST['email']."',
                      '".$_POST['permiso']."')";
  }
  elseif($idItem != 0)
  {

    $query = "UPDATE users
          SET usuario='".$_POST['usuario']."', contrasena='".md5($_POST['contrasena'])."', email='".$_POST['email']."', permiso='".$_POST['permiso']."' WHERE id=".$idItem."";
  }
  
  if ( mysql_query($query) )
  {

    if($idItem == 0){
      $idItem = !empty($_POST['id'])?intval($_POST['id']):mysql_insert_id();
      
    }
    
    header("Location: eusuarios.php?id=".$idItem);die();
  }
  ELSE
  {
   print(mysql_error()); die;
  }
}

$_POST = array();

$idItem = ( isset($_GET['id']) ) ? intval($_GET['id']) : intval($foto[0]);
if ($idItem != 0)
{
  $query = "SELECT * FROM users WHERE id='$idItem' LIMIT 1";
  $result = mysql_query($query) or print(mysql_error());
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
  {

    $row['check'] = ($row['aprobado']!=0)? " checked" : "";
    $_POST = $row;
    $idCategoria = $row['idcategoria'];
  }
  
  

}
else
{
  $idCategoria = ( isset($_GET['cat']) ) ? intval($_GET['cat']) : 1;
}




define (WARNING,E_USER_NOTICE); 
error_reporting (FATAL + ERROR + WARNING);

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


  <link rel="stylesheet" href="dist/css/skins/skin-blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/rwadmin.css">
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
        Crear / Editar Usuario
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active"><a href="usuarios.php">Usuarios</a></li>
        <!--<li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li> -->

      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

<!-- Inicio Contenido -->


    <div class="row">
      <!-- left column -->
      <div class="col-md-12">

        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <!--<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>-->
            </div>
          </div>
          <form action="" method="post" enctype="multipart/form-data" name="form1">          
          <div class="box-body">

              <div class="form-group col-md-6" style="padding-left: 0px; padding-right: 0px">
              <label for="usuario">Usuario</label>
              <input type="text" name="usuario" class="form-control" value="<?=$_POST['usuario'];?>" id="usuario" placeholder="Usuarios">  
              </div>

              <div class="form-group col-md-6">
              <label for="contrasena">Contraseña</label>
              <input type="password" name="contrasena" class="form-control" value="<?=$_POST['contrasena'];?>" id="contrasena" placeholder="Contraseña" required>  
              </div>

              <div class="form-group col-md-6" style="padding-left: 0px; padding-right: 0px">      
              <label for="email">Email</label>
              <input type="text" name="email" class="form-control" value="<?=$_POST['email'];?>" id="email" placeholder="Email" > 
              </div>

              <div class="form-group col-md-6" style="padding-right: 0px">
                <label>Categoría</label>
                <select name='permiso' id="permiso" class="form-control select2" style="width: 100%;">
                  <option value='0' <?php if( $_POST['permiso'] == "0" ) : ?>selected <?php endif ?> >Administrador</option>
                  <option value='1' <?php if( $_POST['permiso'] == "1" ) : ?>selected <?php endif ?> >Usuario</option>
                  <option value='2' <?php if( $_POST['permiso'] == "2" ) : ?>selected <?php endif ?> >Webmaster</option>
                </select>
              </div>

              <input type="hidden" id="id" name="id" value="<?=$_POST['id'];?>">

          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <input type="submit" name="mode" value="Guardar" class="btn btn-danger">
          </div>
          </form>
          <!-- /.box-footer-->
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

  <!-- Modal inicio-->
        <div class="modal fade" id="agregar">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar imagen: <small>Solo imágenes en formato .png</small></h4>
              </div>

              <form action="" method="post" enctype="multipart/form-data">

              <div class="modal-body">

                    <div class="form-group">
                    <label for="Imagen">Imagen</label>
                    <input type="file" name="file" id="Imagen">
                    </div>
                    <div class="form-group">
                    <label for="detalle">Descripción</label>
                    <input type="text" name="detalle" class="form-control" value="<?=$_POST['detalle'];?>" id="detalle" placeholder="Descripción">  
                    </div>
                    <input name="idarticulo" type="hidden" id="idarticulo" value="<?=$idItem;?>">
                    <input type="hidden" name="idgaleria" value="<?=$idGaleria;?>"> 



              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <input type="submit" name="mode" value="Agregar" class="btn btn-primary">
              </div>

              </form>


            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <!-- Modal fin -->



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

<script src="bower_components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {

    CKEDITOR.replace('contenido')
  })
</script>

<script src="bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="plugins/iCheck/icheck.min.js"></script>

<script>
  $(function () {

    $('.select2').select2()

    //Date picker
    $('#fecha').datepicker({
      autoclose: true,
      todayHighlight: true,
      format: 'yy-mm-dd'
    })

    //Timepicker
    $('.hora').timepicker({
      showInputs: false
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })

  })
</script>
</body>
</html>