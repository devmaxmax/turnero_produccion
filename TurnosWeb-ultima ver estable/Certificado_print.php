<?php

include("Codigo/Seguridad.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
include("Codigo/Root.php");
include("../Codigo/Root.php");

$idturno = $_GET['id'];

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

$query="SELECT * From turnos WHERE id = $idturno";
$rs=mysql_query($query,$conn);
$row=mysql_fetch_array($rs);
if(mysql_num_rows($rs)!=0){
  $Paciente = $row['Paciente'];
  $Puesto = $row['Puesto'];
  $Examen = $row['TipoEx'];
  $Fecha = $row['Fecha'];
  $Hora = $row['Hora'];
  $dni = $row['DNIP'];
} mysql_free_result($rs);


$Turno = str_pad($_GET['id'], 6, "0", STR_PAD_LEFT);
$Empresa = $_GET['empresa'];
$Examen = $_GET['examen'];

include("Includes/rFechas.php");

?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Constancia de Turno On-Line</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$general['root'];?>/CSS/rwadmin.css">

  <link rel="stylesheet" href="<?=$general['root'];?>/CSS/skins/skin-purple.css">

  <script src="<?=$general['root'];?>/js/jquery-1.12.3.min.js"></script>
  <link rel="stylesheet" href="<?=$general['root'];?>/CSS/bootstrap.min.css">
  <link rel="stylesheet" href="<?=$general['root'];?>/CSS/style.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700" rel="stylesheet">

</head>

<body onload="window.print();">
<div class="wrapper">

    <section class="invoice">
        <div style="border:1px solid #ddd; margin:20px 0px 40px 40px; padding: 0px; position: relative; overflow: hidden; width: 675px; border-radius:10px">
        
        <img src="img/cert_back.jpg" style="z-index:99; position:relative">

          <div style="position: absolute; z-index:999; top:10px; left: 10px; width:655px;height: 600px">


            <!-- info row -->
            <div class="row invoice-info" style="height: 60px; margin-bottom: 15px; padding: 0px;">
              <div class="col-xs-3" style="height: 50px; width: 175px; margin: 0px 0px 0px 10px; padding: 0px">
                <img src="img/cmit-b.png" style="width:165px;margin:10px 0px 0px 10px">
              </div>
              <div class="col-xs-6" style="height: 50px; width: 315px; text-align: center; margin: 0px; padding: 0px">
                <h4 style="margin-top:12px; font-size:14px; font-weight:600; color:#ffffff!important">CONSTANCIA DE TURNO MEDICO</h4>
              </div>
              <!-- /.col -->
              <div class="col-xs-3" style="height: 50px; width: 165px; margin: 0px; padding: 0px">
                <div class="company">
                  <p style="margin: 0px;font-size: 12px; color:#ffffff!important; font-weight:500">TURNO N°: <?=$Turno;?></p>      
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-xs-6" style="width:49%">
                <p class="lead1"><b>Sr/a:</b> <? echo $Paciente;?></p>
              </div>
              <div class="col-xs-2 no_paddingcc" style="width:19%">
                <p class="lead1"><b>DNI:</b> <? echo $dni;?></p>
              </div>
              <div class="col-xs-4" style="width:32%">
                <p class="lead1"><b>Exámen:</b> <? echo $Examen;?></p>
              </div>
              <div class="col-xs-6" style="width:49%">
                <p class="lead1"><b>Puesto:</b> <? echo $Puesto;?></p>
              </div>
              <div class="col-xs-6" style="width:51%; padding-left: 0px;">
                <p class="lead1"><b>Empresa:</b> <? echo $Empresa;?></p>
              </div>
            </div>

            <!-- Table row -->
            <div class="row">

              <div class="col-xs-12" style="height: 140px; border:1px solid #cccc; text-align:center; margin:15px 0px">

                <p class="lead1" style="text-align: center;margin-top: 20px;">SU TURNO

                <div class="turno_fecha">
                  <img src="img/calendariog.png">
                  <? echo fechaRWdia($Fecha);?> 
                </div>

                <div class="turno_hora">
                  <img src="img/relojg.png">
                  <? echo date("H:i",strtotime($Hora));?> Horas
                </div> 


              </div>
              <!-- /.col -->

            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-xs-12">
                <p class="lead1">Presentarse en nuestros consultorios ubicados en: Juan B. Justo Nro. 825 de Neuquén Capital.
                <p class="lead1"><b>D.N.I. ORIGINAL CON FOTO OBLIGATORIO</b></p>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-6">
                <div class="turno_datos">
                  <p>Área Exámenes</p>
                  <p>CMIT de SALUD OCUPACIONAL SRL</p>
                  <p>CUIT: 30-70997141-3</p>
                  <p>Habilitada por:</p>
                  <p>Subsecretaria de Salud</p>
                  <p>Provincia del Neuquén</p>
                </div> 
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- info row -->
            <div class="row invoice-info-f">
              <div class="col-xs-12">

                <p style="font-size: 12px;">JUAN B JUSTO 825 (8300) Neuquén Argentina - Tel.: 299 4474371 / 299 4474686 - Email: info@cmit.com.ar</p>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->





          </div>

        </div>

    </section>


</div>
<!-- ./wrapper -->


</body>
</html>