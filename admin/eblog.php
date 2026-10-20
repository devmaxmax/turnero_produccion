<?php
define("IN_SITE", true);
$root_path = "./../";
include ($root_path."admin/auth.php");
include ($root_path."conf/config.php");
include ($root_path."conf/funciones.php");

if( $_POST['mode'] == "Guardar" )
{
  $idItem = ( isset($_POST['id']) ) ? intval($_POST['id']) : '0';
  $afiche = (!empty($_POST['afiche'])) ? 1 : 0;
  $aprobado = (!empty($_POST['aprobado'])) ? 1 : 0;
  

  if($idItem == 0)
  {
    $query = "INSERT INTO articulos (idcategoria, fecha, titulo, copete, contenido, url, hora, tema, afiche, aprobado) VALUES ('".intval($_POST['idcategoria'])."', '".$_POST['fecha']."', '".$_POST['titulo']."', '".$_POST['copete']."', '".$_POST['contenido']."', '".$_POST['url']."', '".$_POST['hora']."', '".$_POST['tema']."', '".$afiche."', '".$aprobado."')";
  }
  elseif($idItem != 0)
  {
    $query = "UPDATE articulos
          SET fecha='".$_POST['fecha']."', titulo='".$_POST['titulo']."', copete='".$_POST['copete']."', contenido='".$_POST['contenido']."', url='".$_POST['url']."', hora='".$_POST['hora']."', tema='".$_POST['tema']."', afiche = '".$afiche."', aprobado = '".$aprobado."'  WHERE id=".$idItem."";
  }
  
  if ( mysql_query($query) )
  {

    if($idItem == 0){
      $idItem = !empty($_POST['id'])?intval($_POST['id']):mysql_insert_id();
      
      $query = "INSERT INTO muro (iduserfrom, iduserto, iditem, action, type, time)
                VALUES (47, 0, ".$idItem.", 'publico', 'articulo', ".time().")";
      mysql_query($query);
    }
    else {
      $idItem = !empty($_POST['id'])?intval($_POST['id']):mysql_insert_id();
    }


    
    header("Location: eblog.php?id=".$idItem);die();
  }
  ELSE
  {
   print(mysql_error()); die;
  }
}

elseif ($_POST['mode'] == "Agregar" AND is_numeric($_POST['idarticulo']))
{
  $idItem = intval($_POST['idarticulo']);
  if(in_array($_FILES["file"]["type"], array('image/pjpeg', 'image/jpeg')) /*AND $_FILES["file"]["size"] < 500000*/ )
  {     
    $query = "INSERT INTO articulos_fotos (idarticulo, descripcion, estilo) VALUES (".$idItem.", '".$_POST['detalle']."', '".intval($_POST['estilo'])."')";
    mysql_query($query);  
    copy($_FILES['file']['tmp_name'], $root_path.'contenido/imagenes/'.mysql_insert_id().'.jpg');
    
    header("Location: eblog.php?id=".$idItem);die();
  } 
}
elseif ( isset($_GET['borrar']) )
{
  $foto = explode(".", $_GET['borrar']);
  $query = "DELETE FROM articulos_fotos WHERE id = ".intval($foto[1])." AND idarticulo = ".intval($foto[0])." LIMIT 1";
  $result = mysql_query($query) or print(mysql_error());
  if (mysql_affected_rows())
  {
    @unlink($root_path.'contenido/imagenes/'.intval($foto[1]).'.jpg');

  } 
}

elseif ( isset($_GET['portada']) )
{
  $foto = explode(".", $_GET['portada']);
  $query = "UPDATE articulos SET idfoto = ".intval($foto[1])." WHERE id = ".intval($foto[0])." LIMIT 1";
  $result = mysql_query($query) or print(mysql_error());
}

if($_POST['mode'] == 'Aceptar' && $_FILES['archivook']['error'] != 4 ) {
    if($_FILES['archivook']['type'] == "application/msword" || $_FILES['archivook']['type'] == "application/pdf") {
        if( $_POST['descripcion'] != '' ) {
            if($_FILES['archivook']['type'] == "application/msword") $extension = 'doc';
            if($_FILES['archivook']['type'] == "application/pdf") $extension = 'pdf';
            $query = "INSERT INTO articulos_doc (idarticulo, descripcion, ext) VALUES ('".$_GET['id']."','".$_POST['descripcion']."','$extension')";
            mysql_query($query);
            $destino = $root_path.'contenido/documentos/'.mysql_insert_id().".".$extension;
            copy($_FILES['archivook']['tmp_name'],$destino);
            header("Location: eblog.php?id=".$_GET['id']."");    
        } else
            header("Location: eblog.php?id=".$_GET['id']."&nameFile=TITULO");
    } else {
        header("Location: eblog.php?id=".$_GET['id']."&nameFile=ERROR");
    }  
}

if(isset($_GET['delete'])) {
    $row = sql_query("SELECT id,ext FROM articulos_doc WHERE id='$_GET[delete]'",true);
    $query = "DELETE FROM articulos_doc WHERE id = '$_GET[delete]'";
    $result = mysql_query($query) or print(mysql_error());
    if (mysql_affected_rows())
  {
    @unlink($root_path."contenido/documentos/$row[id].$row[ext]");
  } header("Location: eblog.php?id=".$_GET['id']);
}



$_POST = array();



$idItem = ( isset($_GET['id']) ) ? intval($_GET['id']) : intval($foto[0]);
if ($idItem != 0)
{
  $_POST = sql_query ("SELECT * FROM articulos WHERE id='$idItem' LIMIT 1", true);
  $idCategoria = $_POST['idcategoria'];
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
        Actualidad | Blog
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active"><a href="blog.php?cat=4">Actualidad | Blog</a></li>
        <!--<li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li> -->

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

              <div class="clearfix"></div>
              <div class="form-group col-md-6" style="padding-left: 0px; padding-right: 0px">
                <label>
                  <input type="checkbox" name="aprobado" class="minimal" value="1" <? print ($_POST['aprobado']!=0)? " checked" : "";?> > 
                  &nbsp;Mostrar en el inicio
                </label>
              </div>

              <div class="form-group col-md-6" style="padding-left: 0px; padding-right: 0px">
                <label>
                  <input type="checkbox" name="afiche" class="minimal-red" value="1" <? print ($_POST['afiche']!=0)? " checked" : "";?> > 
                  &nbsp;Definir imagen de portada como afiche
                </label>
              </div>
              <div class="clearfix"></div>


              <div class="form-group col-md-4" style="padding-left: 0px; padding-right: 0px">
                <label for="Fecha">Fecha:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="fecha" class="form-control pull-right" value="<?=$_POST['fecha'];?>" id="fecha" placeholder="Fecha">
                </div>
              </div>


              <div class="form-group col-md-4">
                <label for="Hora">Hora:</label>

                <div class="input-group">
                  <input type="text" name="hora" class="form-control hora" value="<?=$_POST['hora'];?>" placeholder="Hora">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-4" style="padding-left: 0px; padding-right: 0px">
                <label>Categoría</label>
                <select name='tema' id="tema" class="form-control select2" style="width: 100%;">
                  <option value='Noticia' <?php if( $_POST['tema'] == "Noticia" ) : ?>selected <?php endif ?> >Noticia</option>
                  <option value='Artículo' <?php if( $_POST['tema'] == "Artículo" ) : ?>selected <?php endif ?> >Artículo</option>
                  <option value='Capacitación' <?php if( $_POST['tema'] == "Capacitación" ) : ?>selected <?php endif ?> >Capacitación</option>
                  <option value='Concurso' <?php if( $_POST['tema'] == "Concurso" ) : ?>selected <?php endif ?> >Concurso</option>
                  <option value='Debate' <?php if( $_POST['tema'] == "Debate" ) : ?>selected <?php endif ?> >Debate</option>
                  <option value='Fiesta' <?php if( $_POST['tema'] == "Fiesta" ) : ?>selected <?php endif ?> >Fiesta</option>
                  <option value='Reunión' <?php if( $_POST['tema'] == "Reunión" ) : ?>selected <?php endif ?> >Reunión</option>
                  <option value='Seminario' <?php if( $_POST['tema'] == "Seminario" ) : ?>selected <?php endif ?> >Seminario</option>
                </select>
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

                  <a href="../contenido/imagenes/<?=$row['id'];?>.jpg" target="_blank"><img src="../contenido/imagenes/<?=$row['id'];?>.jpg" class="img-responsive"></a>
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