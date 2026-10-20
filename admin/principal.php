<?php
define("IN_SITE", true);
$root_path = "./../";
include ($root_path."admin/auth.php");
include ($root_path."conf/config.php");
include ($root_path."conf/funciones.php");

if( $_POST['mode'] == "Guardar" )
{
  $idItem = ( isset($_POST['id']) ) ? intval($_POST['id']) : '0';
  $checkbox = (!empty($_POST['checkbox'])) ? 1 : 0; 
  

  if($idItem == 0)
  {
    $query = "INSERT INTO articulos (idcategoria, titulo, copete, contenido, url) VALUES ('".intval($_POST['idcategoria'])."', '".$_POST['titulo']."', '".$_POST['copete']."', '".$_POST['contenido']."', '".$_POST['url']."')";
  }
  elseif($idItem != 0)
  {
    $query = "UPDATE articulos
          SET titulo='".$_POST['titulo']."', copete='".$_POST['copete']."', contenido='".$_POST['contenido']."', url='".$_POST['url']."' WHERE id=".$idItem."";
  }
  
  if ( mysql_query($query) )
  {

    if($idItem == 0){
      $idItem = !empty($_POST['id'])?intval($_POST['id']):mysql_insert_id();
      
      mysql_query($query);
    }
    else {
      $idItem = !empty($_POST['id'])?intval($_POST['id']):mysql_insert_id();
    }
    
    header("Location: principal.php?id=".$idItem);die();
  }
  ELSE
  {
   print(mysql_error()); die;
  }
}
elseif ($_POST['mode'] == "Agregar" AND is_numeric($_POST['idarticulo']))
{
  $idItem = intval($_POST['idarticulo']);
  if(in_array($_FILES["file"]["type"], array('image/png')) /*AND $_FILES["file"]["size"] < 500000*/ )
  {     
    $query = "INSERT INTO articulos_fotos (idarticulo, descripcion, estilo) VALUES (".$idItem.", '".$_POST['detalle']."', '".intval($_POST['estilo'])."')";
    mysql_query($query);  
    copy($_FILES['file']['tmp_name'], $root_path.'contenido/imagenes/'.mysql_insert_id().'.png');
    
    header("Location: principal.php?id=".$idItem);die();
  } 
}
elseif ( isset($_GET['borrar']) )
{
  $foto = explode(".", $_GET['borrar']);
  $query = "DELETE FROM articulos_fotos WHERE id = ".intval($foto[1])." AND idarticulo = ".intval($foto[0])." LIMIT 1";
  $result = mysql_query($query) or print(mysql_error());
  if (mysql_affected_rows())
  {
    @unlink($root_path.'contenido/imagenes/'.intval($foto[1]).'.png');


  } 
}


elseif ( isset($_GET['portada']) )
{
  $foto = explode(".", $_GET['portada']);
  $query = "UPDATE articulos SET idfoto = ".intval($foto[1])." WHERE id = ".intval($foto[0])." LIMIT 1";
  $result = mysql_query($query) or print(mysql_error());
}



$_POST = array();



$idItem = ( isset($_GET['id']) ) ? intval($_GET['id']) : intval($foto[0]);
if ($idItem != 0)
{
  $query = "SELECT * FROM articulos WHERE id='$idItem' LIMIT 1";
  $result = mysql_query($query) or print(mysql_error());
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
  {

    $row['check'] = ($row['aprobado']!=0)? " checked" : "";
    $_POST = $row;
    $idCategoria = $row['idcategoria'];
  }
  
  $fotos = sql_query("SELECT * FROM articulos_fotos WHERE idarticulo='$idItem'");

}
else
{
  $idCategoria = ( isset($_GET['cat']) ) ? intval($_GET['cat']) : 1;
}



$categoria = sql_query ("SELECT * FROM categoria WHERE id='$idCategoria' LIMIT 1");
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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/rwadmin.css">

  <link rel="stylesheet" href="dist/css/skins/skin-blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

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
        Página: <?=$_POST['titulo'];?>
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


    <div class="row">
      <!-- left column -->
      <div class="col-md-9">

        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Cargar/Modificar Contenido</h3>

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

              <div class="form-group">
              <label for="titulo">Título</label>
              <input type="text" name="titulo" class="form-control" value="<?=$_POST['titulo'];?>" id="titulo" placeholder="Título">  
              </div>
              <div class="form-group">
              <label for="url">Vínculo</label>
              <input type="text" name="url" class="form-control" value="<?=$_POST['url'];?>" id="url" placeholder="Vínculo">  
              </div>

              <div class="form-group">      
              <label for="copete">Copete</label>
              <textarea name="copete" rows="5" class="form-control" id="copete" placeholder="Copete" ><?=$_POST['copete'];?></textarea> 
              </div>
              <div class="form-group">      
              <label for="contenido">Contenido:</label>
              <textarea name="contenido" rows="10" class="form-control textarea" id="contenido" placeholder="Contenido" ><?=$_POST['contenido'];?></textarea>

              </div>

              <input type="hidden" id="id" name="id" value="<?=$_POST['id'];?>">
              <input type="hidden" id="idcategoria" name="idcategoria" value="<?=$idCategoria;?>">


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

      <div class="col-md-3">


        <!-- Default box -->
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Cargar Imágenes</h3>

            <div class="box-tools pull-right">
              <a href="#agregar" type="button" class="btn btn-success btn-sm"  data-toggle="modal" title="Agregar imagen">
                <i class="fa fa-plus"></i>
              </a>
            
            </div>
          </div>
          <div class="box-body">
              
              <p>Seleccione el botón verde para comenzar a cargar imágenes</p>

              <? foreach ($fotos as $row) : ?>
              
                 <br/>
                  <div class="center-block">

                    <div class="pull-left">
                      <a href="?portada=<?=$row['idarticulo'];?>.<?=$row['id'];?>" class="text-default" style="text-decoration:none; color:#333">
                      <? print ($row['id']!=$_POST['idfoto'])? '<i class="fa fa-toggle-off" style="color:#333"></i>' : '<i class="fa fa-toggle-on" style="color:#f39c12"></i>';?> Portada
                      </a>
                    </div>
                    <div class="pull-right">
                      <a href="?borrar=<?=$row['idarticulo'];?>.<?=$row['id'];?>" class="text-danger">
                      <i class="fa fa-times"></i>
                      </a>
                    </div>

                  <a href="../contenido/imagenes/<?=$row['id'];?>.png" target="_blank"><img src="../contenido/imagenes/<?=$row['id'];?>.png" class="img-responsive"></a>
                  <h5><?=$row['descripcion'];?></h5>
                  </div>
              
              <? endforeach; ?>


          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            
          </div>
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
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('contenido')
  })
</script>

</body>
</html>