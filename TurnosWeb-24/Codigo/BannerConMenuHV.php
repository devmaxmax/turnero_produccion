!--banner-->


        <!-- Inicio Header boostrap fluid -->

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        

        <div class="container-fluid bottom-bar hidden-xs">
          <div class="container">
            <div class="logo_big col-lg-4 col-xs-12 col-md-4 hidden-sm" style="padding-left: 10px">
                <img src="<?=$general['root'];?>/img/cmit.png" alt="CMIT" style="margin-top:10px">
            </div>

            <div class="logo_big col-sm-4 visible-sm" style="padding-left: 10px">
                <img src="<?=$general['root'];?>/img/cmit.png" alt="CMIT" style="margin-top:15px" width="240px">
            </div>

            <div class="col-lg-5 col-xs-12 col-md-4 col-sm-8 box_mail1">
                <div class="box_mail" >

                    <div class="box_mail_u hidden-md">
                        <div class="box_mail-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h3>Juan B Justo 825</h3>
                        <h3>Neuqu&eacute;n Capital</h3>
                    </div>
                    <div class="box_mail_c">
                        <div class="box_mail-icon">
                            <i class="fas fa-mobile-alt"></i>  
                        </div>
                        <h3>299 4474371</h3>
                        <h3>299 4474686</h3>
                    </div>

                </div>
            </div>            


            <div class="col-lg-3 col-xs-12 col-md-4 hidden-sm box_buscador">
                <div class="box_buscador2">
                    <a href="https://webmail.cmit.com.ar"  target="_blank">
                        <div class="box_social-web" style="">
                        Acceso a
                        Webmail                            
                        </div>
                        <div class="box_social-icon">
                            <i class="far fa-envelope"></i>
                        </div>
                    </a>
                    <a href="<?=$general['linkedin'];?>" target="_blank">
                        <div class="box_social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </div>
                    </a>
                    <a href="<?=$general['facebook'];?>" target="_blank">                                       
                        <div class="box_social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </div>


                    </a>
                </div>
            </div>

          </div>
          
        </div>


<div class="container-fluid" style="z-index: 99999999;">
        <div class="container divtop" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll hidden-xs hidden-sm" href="<?=$general['root'];?>" ><img src="<?=$general['root'];?>/img/cmit3.png" alt="CMIT Salud Ocupacional SRL" style="width:200px; margin-top:10px"></a>
                <a class="navbar-brand page-scroll visible-xs" href="<?=$general['root'];?>"><img src="<?=$general['root'];?>/img/cmit3.png" alt="CMIT Salud Ocupacional SRL" style="width:200px; margin-top:10px"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">

                    <li style="border:0px;">
                        <?php echo '<a class="page-scroll" href="'.$_SESSION["NivelArbol"].'Inicio.php">INICIO</a>';?>
                    </li>

                    <!--

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MASIVO <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                      <ul class="dropdown-menu">
                        
                        <?php echo '<li><a href="'.$_SESSION["NivelArbol"].'Masivo.php">CALENDARIO</a></li>';?>
                        <li role="separator" class="divider"></li>                                        
                        <?php echo '<li><a href="'.$_SESSION["NivelArbol"].'MasivoL.php">LISTA</a></li>';?>
                      </ul>
                    </li>

                    -->

                </ul>
                <ul class="nav navbar-nav navbar-right visible-xs visible-md visible-lg">
                    <li  class="btderecha">
						<?php echo '<a href="'.$_SESSION["NivelArbol"].'MisTurnos.php" class="page-scroll btderechav" style="font-weight: 600; color:#3c74b3">
							<i class="fa fa-clock"></i> Turnos
						</a>';?>
                    </li>
                    <li  class="btderechar">
						<?php echo '<a href="'.$_SESSION["NivelArbol"].'MiCuenta.php" class="page-scroll btderechav" style="font-weight: 600; color:#3c74b3">
							<i class="fa fa-user"></i> Cuenta
						</a>';?>
                    </li>
                    <li  class="btderechar">
						<?php echo '<a href="'.$_SESSION["NivelArbol"].'Codigo/Logout.php" class="page-scroll btderechav" style="font-weight: 600; color:#3c74b3">
							<i class="fa fa-sign-out-alt"></i> Salir
						</a>';?>
                    </li>

                </ul>

                <ul class="nav navbar-nav navbar-right visible-sm">
                    <li  class="btderecha">
                        <?php echo '<a href="'.$_SESSION["NivelArbol"].'AlertasCMIT.php" class="page-scroll btderechav" style="font-weight: 600; color:#3c74b3">
                            <i class="fa fa-clock"></i>
                        </a>';?>
                    </li>
                    <li  class="btderechar">
                        <?php echo '<a href="'.$_SESSION["NivelArbol"].'CambioClaveCMIT.php" class="page-scroll btderechav" style="font-weight: 600; color:#3c74b3">
                            <i class="fa fa-user"></i>
                        </a>';?>
                    </li>
                    <li  class="btderechar">
                        <?php echo '<a href="'.$_SESSION["NivelArbol"].'Codigo/LogoutCMIT.php" class="page-scroll btderechav" style="font-weight: 600; color:#3c74b3">
                            <i class="fa fa-sign-out-alt"></i>
                        </a>';?>
                    </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
</div>


    </nav>


        <!-- Fin Header boostrap fluid -->

<div class="container-fluid hidden-xs espaciador"></div>
<div class="container-fluid visible-xs espaciadorxs"></div>

<section id="clients" class="clients section-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="overflow-x: auto;">



<table  height="100%" width="100%"  cellpadding="0"  cellspacing="0" border="0" align="center" class="fondo">


	<!--body-->
	<tr >
		<td colspan="2" width="100%"  height="100%"  align="center" valign="top">
			
			<table  width="100%"  height="100%" cellpadding="0" cellspacing="0" border="0" align="center" >
				<tr height="100%">
					<td align="center" height="100%" valign="top" class="fondo">


