<?php
define("IN_SITE", true);
$root_path = "./../";
include ($root_path."admin/auth.php");
include ($root_path."conf/config.php");
include ($root_path."conf/funciones.php");

if ( $_POST['mode'] == "Guardar" )
{
  $idItem = ( isset($_POST['id']) ) ? intval($_POST['id']) : 0;

  if($idItem == 0)
  {
    $query = "INSERT INTO foto (idgaleria, titulo, url, copete)
              VALUES ('".intval($_GET['id'])."', '".$_POST['titulo']."', '".$_POST['url']."', '".$_POST['copete']."')";
  }

  if ( $_ERROR == "" )
  {
    if(mysql_query($query))
    {
      if(in_array($_FILES['file']['type'], array('image/pjpeg', 'image/jpeg')))
      {
        $idItem = !empty($_POST['id'])?intval($_POST['id']):mysql_insert_id();
        copy($_FILES['file']['tmp_name'], $root_path.'contenido/slider/'.$idItem.'.jpg');
        
      }

      $return = true;
      $_POST = array();
    }
    else
    {
      $_ERROR = __LINE__." - ".mysql_error()."<br>";
      print $_ERROR;
    }
  }

}


elseif (isset($_GET['borrar']))
{
  $idFoto = intval($_GET['borrar']);
  mysql_query("DELETE FROM foto WHERE id='$idFoto' LIMIT 1");
  @unlink($root_path.'contenido/slider/'.$idFoto.'.jpg');
  

}



$items = sql_query("SELECT * FROM foto WHERE idgaleria = 0 ORDER BY id ASC");


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
        Slider Principal
        <small>Cargar Imágenes solo en formato .jpg</small>
      </h1>
      <ol class="breadcrumb">
        <!--<li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
         <li class="active">Here</li> -->
        <li class="active"><a href="index"><i class="fa fa-dashboard"></i> Inicio</a></li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12 barra_tope">
        <a href="#agregar" class="btn btn-success pull-right" data-toggle="modal">Cargar Imagen</a>
        
      </div>
    </div>

<!-- Inicio Contenido -->

      <div class="row">
<? foreach ($items as $row) : ?>


        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>

              <div class="box-tools pull-right">
                
                <a href="?id=<?=$idGaleria;?>&borrar=<?=$row['id'];?>" class="btn btn-box-tool" onClick="return confirm('Desea borrar la imagen ?')"><i class="fa fa-times"></i></a>
                
              </div>

            </div>
            <div class="box-body">
              <div class="chart">

                  <img src="../contenido/slider/<?=$row['id'];?>.jpg" class="img-responsive" >
                  <h4><?=$row['titulo'];?></h4>
                  <p><?=$row['copete'];?></p>
                  <h5><small><?=$row['url'];?></small></h5>

              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>

        <!-- /.col (RIGHT) -->


<? endforeach; ?>
      </div>
      <!-- /.row -->


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
                <h4 class="modal-title">Agregar imagen: <small>Solo imágenes en formato .jpg</small></h4>
              </div>

              <form method="post" action="sliderp.php?id=0" enctype="multipart/form-data">

              <div class="modal-body">

                    <div class="form-group">
                    <label for="Imagen">Imagen</label>
                    <input type="file" name="file" id="Imagen">
                    </div>
                    <div class="form-group">
                    <label for="Título">Título</label>
                    <input type="text" name="titulo" class="form-control" value="<?=$_POST['titulo'];?>" id="titulo" placeholder="Título">  
                    </div>
                    <div class="form-group">
                    <label for="Copete">Copete</label>
                    <input type="text" name="copete" class="form-control" value="<?=$_POST['copete'];?>" id="copete" placeholder="Copete">  
                    </div>
                    <div class="form-group">      
                    <label for="url">Hipervínculo</label>
                    <input type="text" name="url" class="form-control" value="<?=$_POST['url'];?>" id="url" placeholder="Hipervínculo"> 
                    </div>
                    <input type="hidden" name="id" value="<?=$_POST['id'];?>">
                    <input type="hidden" name="idgaleria" value="0"> 



              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" name="mode" value="Guardar" class="btn btn-primary">Guardar</button>
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
</body>
</html>