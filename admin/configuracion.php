<?php
define("IN_SITE", true);
$root_path = "./../";
include ($root_path."admin/auth.php");
include ($root_path."conf/config.php");
include ($root_path."conf/funciones.php");

if( $_POST['mode'] == "Guardar" )

{

    $query =  "UPDATE general
          SET title='".$_POST['title']."', adress='".$_POST['adress']."', phone='".$_POST['phone']."', whatsapp='".$_POST['whatsapp']."', whatsapp_r='".$_POST['whatsapp_r']."', mail='".$_POST['mail']."', maps='".$_POST['maps']."', root='".$_POST['root']."', horarios='".$_POST['horarios']."', descripcion='".$_POST['descripcion']."', facebook='".$_POST['facebook']."', twitter='".$_POST['twitter']."', linkedin='".$_POST['linkedin']."', instagram='".$_POST['instagram']."' ";
}
     if ( mysql_query($query) )
if(mysql_query($query))
    {
       //if(in_array($_FILES['file']['type'], array('image/png', 'image/pjpeg', 'image/jpeg')))
      if($_FILES['file']['type'] == "image/png" || $_FILES['bgr']['type'] == "image/jpeg")  
      {
        $idItem = !empty($_POST['id'])?intval($_POST['id']):mysql_insert_id();
        copy($_FILES['file']['tmp_name'], $root_path.'contenido/general/logo.png');
        copy($_FILES['bgr']['tmp_name'], $root_path.'contenido/general/bgr.jpg');
      }

      $return = true;
      $_POST = array();
    }

if( isset($_GET['borrar']) )
{

      unlink($root_path.'contenido/general/logo.png');
      header("Location: general.php");


}

if( isset($_GET['borrarf']) )
{

      unlink($root_path.'contenido/general/bgr.jpg');
      header("Location: general.php");


} 



  $query = "SELECT * FROM general";
  $result = mysql_query($query) or print(mysql_error());
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
  {
    $_POST = $row;
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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/rwadmin.css">

  <link rel="stylesheet" href="dist/css/skins/skin-blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


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
        Configuración General
        <small>Modificación de parametros generales del sitio web</small>
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

              <div class="form-group">
              <label for="title">Título del sitio</label>
              <input type="text" name="title" class="form-control" value="<?=$_POST['title'];?>" id="title" placeholder="Título">  
              </div>

              <div class="form-group">      
              <label for="descripcion">Descripción</label>
              <textarea name="descripcion" rows="3" class="form-control" id="descripcion" placeholder="Descripción" maxlength="300"><?=$_POST['descripcion'];?></textarea> 
              </div>

              <div class="form-group">
              <label for="URL del campus">URL del sitio <small style="font-weight: 300">Dirección web donde esta el index (sin / final)</small></label>
              <input type="text" name="root" class="form-control" value="<?=$_POST['root'];?>" id="URL del campus" placeholder="Título">  
              </div>
              
              <div class="form-group">
              <label for="adress">Dirección</label>
              <input type="text" name="adress" class="form-control" value="<?=$_POST['adress'];?>" id="adress" placeholder="Dirección">  
              </div>

              <div class="form-group">
              <label for="phone">Teléfono</label>
              <input type="text" name="phone" class="form-control" value="<?=$_POST['phone'];?>" id="phone" placeholder="Teléfono">  
              </div>

              <div class="form-group">
              <label for="whatsapp">Whatsapp con formato</label>
              <input type="text" name="whatsapp" class="form-control" value="<?=$_POST['whatsapp'];?>" id="whatsapp" placeholder="Whatsapp con formato">  
              </div>

              <div class="form-group">
              <label for="Whatsapp Real">Whatsapp Real</label>
              <input type="text" name="whatsapp_r" class="form-control" value="<?=$_POST['whatsapp_r'];?>" id="whatsapp_r" placeholder="Whatsapp Real">  
              </div>

              <div class="form-group">
              <label for="mail">Email</label>
              <input type="text" name="mail" class="form-control" value="<?=$_POST['mail'];?>" id="mail" placeholder="Email">  
              </div>

              <div class="form-group">
              <label for="maps">Ubicación</label>
              <input type="text" name="maps" class="form-control" value="<?=$_POST['maps'];?>" id="maps" placeholder="Ubicación">  
              </div>

              <div class="form-group">
              <label for="horarios">Horarios</label>
              <input type="text" name="horarios" class="form-control" value="<?=$_POST['horarios'];?>" id="horarios" placeholder="Horarios">  
              </div>

              <div class="form-group">
              <label for="facebook">Facebook</label>
              <input type="text" name="facebook" class="form-control" value="<?=$_POST['facebook'];?>" id="facebook" placeholder="Facebook">  
              </div>

              <div class="form-group">
              <label for="instagram">Instagram</label>
              <input type="text" name="instagram" class="form-control" value="<?=$_POST['instagram'];?>" id="instagram" placeholder="Instagram">  
              </div>

              <div class="form-group">
              <label for="twitter">Twitter</label>
              <input type="text" name="twitter" class="form-control" value="<?=$_POST['twitter'];?>" id="twitter" placeholder="Twitter">  
              </div>

              <div class="form-group">
              <label for="linkedin">Linkedin</label>
              <input type="text" name="linkedin" class="form-control" value="<?=$_POST['linkedin'];?>" id="linkedin" placeholder="Linkedin">  
              </div>

              <div class="form-group">
              <label for="youtube">YouTube</label>
              <input type="text" name="youtube" class="form-control" value="<?=$_POST['youtube'];?>" id="youtube" placeholder="YouTube">  
              </div>


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
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('contenido')
  })
</script>

</body>
</html>