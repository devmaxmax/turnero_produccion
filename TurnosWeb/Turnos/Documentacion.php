<? include("../Codigo/Seguridad.php") ;include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Config.php"); include("../Codigo/Root.php");
//$_GET trae id turno
GLO_ValidaGETTUR($_GET['id'],0,0,'Inicio');//valida que no sea vacio

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

//valida usuario turno=usuario logueado
$id=intval(decrypt($_GET['id'],'elcrucedelosandes2016'));
$usuario=mysql_real_escape_string($_SESSION["login"]);//usuario logueado
GLO_ValidaUSERTUR($usuario,$id,'Inicio',$conn);

$_SESSION['TxtNumero']=$id;

$ide = $_GET['id'];

if ($_POST['mode'] == "Aceptar")
{
  
   if (($_FILES["archivook"]["type"] == "application/msword")
   || ($_FILES["archivook"]["type"] == "image/pjpeg")
   || ($_FILES["archivook"]["type"] == "image/jpeg")
   || ($_FILES["archivook"]["type"] == "image/png")
   || ($_FILES["archivook"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
   || ($_FILES["archivook"]["type"] == "application/octet-stream")
   || ($_FILES["archivook"]["type"] == "application/octet-stream;base64")
   || ($_FILES["archivook"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
   || ($_FILES["archivook"]["type"] == "application/vnd.ms-excel")
   || ($_FILES["archivook"]["type"] == "application/pdf"))
  { 
    $descripcion = preg_replace('([^A-Za-z0-9- ])', '', $_POST['descripcion']);    
    $query = "INSERT INTO documentacion (idturno, descripcion, ext, fecha) VALUES (".$id.", '".$descripcion."', '".$_POST['ext2']."', '".$_POST['fecha']."')";
    mysql_query($query);  
    copy($_FILES['archivook']['tmp_name'], '../documentos/'.$descripcion.'-'.$id.'.'.$_POST['ext2']);
    $_SESSION['flash'] = 'El documento se cargo correctamente.';
    header("Location: Documentacion.php?id=".$ide);die();
  } 
}

if( isset($_GET['eliminar']) )
{
  $idItem = intval($_GET['eliminar']);
  $idname = $_GET['idname'];
  $idext = $_GET['idext'];
  $query = "DELETE FROM documentacion WHERE id='".$idItem."'";
  $result = mysql_query($query) or print(mysql_error());
  @unlink("../documentos/$idname-$id.$idext");
  $_SESSION['flashe'] = 'El documento se eliminó correctamente.';
  header("Location: Documentacion.php?id=".$ide);die();
}


GLO_InitHTMLD($_SESSION["NivelArbol"],'','BannerConMenuHV','zEnviar',0,0,0,0);
GLO_tituloypathd(0,1120,'','CMIT Turnos Web','salir'); 

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
$query="SELECT * From documentacion WHERE idturno = ".$id."";
$archivos=mysql_query($query,$conn);

?>


<? if (isset($_SESSION['flash'])) { ?>

	<table width="1120" border="0" cellpadding="0" cellspacing="0" style="border:1px #e1e1e1 solid; padding:14px;border-radius:4px;color: #484848; margin:10px 0px 20px">
	  <tr>
	    <td height="60">
	      <h5 class="h5_alert" style="text-align:center"> 
	        <?  echo $_SESSION['flash']; ?>
	        <?  unset($_SESSION['flash']); ?>
	      </h5>
	    </td>
	  </tr>
	</table>

<? } ?>

<? if (isset($_SESSION['flashe'])) { ?>

	<table width="1120" border="0" cellpadding="0" cellspacing="0" style="border:1px #e1e1e1 solid; padding:14px;border-radius:4px;color: #484848; margin:10px 0px 20px">
	  <tr>
	    <td height="60">
	      <h5 class="h5_alert" style="text-align:center"> 
	        <?  echo $_SESSION['flashe']; ?>
	        <?  unset($_SESSION['flashe']); ?>
	      </h5>
	    </td>
	  </tr>
	</table>

<? } ?>

<table width="1120" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td height="10"></td>
</tr>
<tr>
	<td height="18" class="subtituloturnos" valign="bottom">Listado de documentos adjuntos al turno:</td>
	<td align="right">
		<a href="#cargar" class="btn btn-prest3" data-toggle="modal" title="Agregar documento">Agregar</a>
	</td>
</tr>
<tr>
	<td height="10"></td>
</tr>
</table>

<table width="1120" border="0" cellspacing="0" cellpadding="0" class="TableShow">
	<tr>
		<td height="20" align="center" width="100" class="TableShowT">Id</td>
		<td height="20" align="center" width="520" class="TableShowT">T&iacute;tulo</td>
		<td height="20" align="center" width="100" class="TableShowT">Tipo</td>
		<td height="20" align="center" width="100" class="TableShowT">Fecha</td>
		<td height="20" align="center" width="300" class="TableShowT">Opciones</td>
	</tr>

  <?  $query="SELECT * From documentacion WHERE idturno = ".$id."";
			$archivos=mysql_query($query,$conn);

			if(mysql_num_rows($archivos)!=0) {

			while($row=mysql_fetch_array($archivos)) { ?>

				<tr>
					<td height="20" align="center" width="100" class="TableShowD"><?=$row['id'];?></td>
					<td height="20" align="center" width="500" class="TableShowD"><?=$row['descripcion'];?></td>
					<td height="20" align="center" width="200" class="TableShowD">

            <? if($row['ext'] == 'jpg' OR $row['ext'] == 'png')  { ?>

                Imagen

            <? } elseif ($row['ext'] == 'doc' OR $row['ext'] == 'docx') { ?>

                Documento de MS Word

            <? } elseif ($row['ext'] == 'xls' OR $row['ext'] == 'xlsx') { ?>

                Documento de MS Excel

            <? } elseif ($row['ext'] == 'pdf') { ?>

                Documento PDF

            <? } ?>

					</td>
					<td height="20" align="center" width="120" class="TableShowD">
							<? echo $row['fecha'] = date("d-m-Y");?>
					</td>
					<td height="20" align="center" width="200" class="TableShowD">
						<a href="?id=<?=$ide;?>&eliminar=<?=$row['id'];?>&idname=<?=$row['descripcion'];?>&idext=<?=$row['ext'];?>" class="botonc" style="width: 86px;" onClick="return confirm('Desea eliminar el documento?')">Eliminar</a>

						<a href="../documentos/<?=$row['descripcion'];?>-<?=$id;?>.<?=$row['ext'];?>" class="boton_cert" target="_blank" style="width: 86px;">Descargar</a>
					</td>
				</tr>

			<? } } else { ?>

				<tr>
					<td height="20" colspan="5" class="TableShowD">&nbsp;&nbsp;A&uacute;n no hay documentaci&oacute;n en este turno</td>
				</tr>

			<? }  ?>

</table>

<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50"></td>
  </tr>
</table>	


  <!-- Modal inicio-->
        <div class="modal fade" id="cargar">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="h4_error">Subir Archivo <small></small></h4>
              </div>

              <form action="Documentacion.php?id=<?=$ide;?>" method="post" enctype="multipart/form-data">

              <div class="modal-body" style="text-align: left;">

                    <div class="form-group">
                    <label for="descripcion" style="font-weight: 400;">Descripci&oacute;n</label>
                    <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Por favor nombrar el archivo con 4 caracteres mínimo." minlength="4" maxlength="50" pattern="[a-zA-Z0-9 ]{4,40}" required>  
                    </div>
                    <div class="form-group">
                    <label for="ext2" style="font-weight: 400;">Extensi&oacute;n (Tipo de Archivo)</label>
                    <select name="ext2" id="ext2" class="form-control" required>
                    <option></option>
                    <option value="jpg">jpg</option>
                    <option value="png">png</option>
                    <option value="pdf">pdf</option>
                    <option value="doc">doc</option>
                    <option value="docx">docx</option>
                    <option value="xls">xls</option>
                    <option value="xlsx">xlsx</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <input type="file" name="archivook" class="file">
                    </div> 
                    <input name="idturno" type="hidden" id="idturno" value="<?=$_GET['id'];?>">
                    <input name="fecha" type="hidden" id="fecha" value="<? echo date("Y-m-d");?>">


              </div>
              <div class="modal-footer">
                <button type="button" class="boton_cert" data-dismiss="modal" style="margin-right: 10px;">Cerrar</button>
                <button type="submit" name="mode" value="Aceptar" class="boton">Aceptar</button>
              </div>

              </form>


            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <!-- Modal fin -->


<? include ("../Codigo/FooterConUsuario.php");?>
