<?php include ("Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php include ("Codigo/BannerInicio.php");?>

<?php include("Codigo/Config.php");
$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
$query="SELECT * From noticias";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
if(mysql_num_rows($rs)!=0){
	$titulo = $row['Titulo'];
	$stitulo = $row['Subtitulo'];
	$texto = $row['Texto'];
} mysql_free_result($rs);mysql_close($conn);

?> 

<section id="inicio" class="fondo_white" style="margin-top: 0px;">
    <div class="container">
        <div class="row">

            <div class="col-lg-10 col-lg-offset-1 heading-title2 style2">

                <h3><? echo $titulo = $row['Titulo']; ?></h3>
                              
            </div>

        </div>
    </div>
</section>



<section>
    <div class="container">
        <div class="row"> 

            <!--<div class="col-lg-6 col-md-12 text-center">
                <div class="center-banner sr-contact">  

                    <div class="col-md-7 col-xs-12 alinea">
                        <h3 style="margin-top: 15px; font-size: 18px;">
                            Apto F&iacute;sico Licencias
                        </h3>
                    </div>

                    <div class="col-md-5 col-xs-12 alinea2">
                        <a href="https://secure.iturnos.com/inicio/usuarios/index.php?id_empresa=820" class="btn btn-prest" style="margin-top: 10px; color:#fff">Solicitar Turno</a>
                    </div>

                    <div class="clearfix"></div>                                   

                </div>
            </div>-->

            <div class="col-lg-6 col-md-12 text-center">
                <div class="center-banner2 sr-contact">  

                    <div class="col-md-8 col-sm-12 alinea">
                        <h3 style="margin-top: 15px; font-size: 18px;">
                            Turnos Examenes Laborales
                        </h3>
                    </div>

                    <div class="col-md-4 col-sm-12 alinea2">
                        <a href="InicioIntranet.php" class="btn btn-prest2" style="margin-top: 10px; color:#fff">Solicitar Turno</a>
                    </div>

                    <div class="clearfix"></div>                                  

                </div>
            </div>
            
        </div>
    </div>
</section>


<section id="catalogo" class="fondo_white" >

    <div class="container">
        <div class="row">

            <div class="col-lg-12" style="margin-top:45px;">
                <div class="service-box1 text-left sr-contact">  
                            <h3 style="font-size: 22px;text-align: center;"><? echo $titulo = $row['Subtitulo']; ?></h3>
                            <p><? echo $titulo = $row['Texto']; ?></p>
                </div>                        
            </div>

        </div>
    </div>

</section>
<br/><br/>
<?php include ("includesrw/footer2.php") ;?>