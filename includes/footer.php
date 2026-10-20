

<section class="fondo_gris page-scroll" id="exito">

    <div class="container">
        <div class="row"> 

          <div class="col-lg-10 col-lg-offset-1 heading-title2 style2">
                  <h3>Suscríbase a nuestro newsletter</h3>
                  <p>Reciba en su e-mail novedades e información de CMIT y temas de interés sobre Salud Ocupacional.</p>

                    <? if(strpos($t[0], "inicio")): ?>
                        <div class="form-group col-lg-12" style="margin-bottom:0px; padding: 15px 10px; border-radius: 10px;">
                            <div class='exito col-lg-12 text-left bg-success' style="margin-bottom: 0px; text-align: center;">Gracias, hemos registrado su suscripción correctamente.</div>
                        </div>
                    <? endif; ?>
          </div>

            <div class="col-lg-8 col-lg-offset-2 text-center">
                <div class="center-banner3">

					<!-- <form name="forma" method="post">-->

                        <div class="col-md-5 col-sm-12">

                            <div class="form-group">
                                <input type="text" class="form-control" value="<?=$_POST['nombre'];?>" id="nombre" placeholder="Nombre y Apellido" name="nombre" required style="height: 42px;border-radius: 50px; padding: 6px 20px">   
                            </div>

                        </div>

	                    <div class="col-md-4 col-sm-12">

                            <div class="form-group">           
                                <input type="email" class="form-control" value="<?=$_POST['email'];?>" id="email" placeholder="Email" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required  style="height: 42px;border-radius: 50px; padding: 6px 20px">
                            </div>

	                    </div>

	                    <div class="col-md-3 col-sm-12">

                            <div class="form-group">
                                <button type="submit" name="mode" value="Mail" class="btn btn-prest3">Suscribirme <span class="ti-angle-right" style="margin-left: 15px"></span></button>
                            </div>

	                    </div>

                    <!-- </form> -->
                    <div class="clearfix"></div>                                  

                </div>
            </div>
            
        </div>
    </div>
</section>

<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 hidden-sm" style="margin-top: 20px">
				<a href="index"><img src="contenido/general/cmit2.png" width="220" alt="" class="img-responsive"></a>
                    <a href="https://api.whatsapp.com/send?phone=542994542034" target="_blank">
                        <div class="col-md-12 no_padding" style="margin-top: 15px; padding-top: 0px !important;">
                            <div class="col-md-3 col-xs-3 wfoi">
                                <i class="fab fa-whatsapp" style="margin-right: 0px;"></i>
                            </div>
                            <div class="col-md-9 col-xs-9 wfot">
                                <h4>299 454 2034</h4>
                                <h4>Administración Comercial</h4> 
                            </div>                        
                        </div>
                    </a>
                    <div class="clearfix"></div>
                
                    <a href="https://api.whatsapp.com/send?phone=542995551480" target="_blank">
                        <div class="col-md-12 no_padding" style="margin-top: 10px; padding-top: 0px !important;">
                            <div class="col-md-3 col-xs-3 wfoi">
                                <i class="fab fa-whatsapp" style="margin-right: 0px;"></i>
                            </div>
                            <div class="col-md-9 col-xs-9 wfot">
                                <h4>299 555 1480</h4>
                                <h4>Administración Comercial</h4> 
                            </div>                        
                        </div>
                    </a>
                    <div class="clearfix"></div>
                
                    <a href="https://api.whatsapp.com/send?phone=542994167158" target="_blank">
                        <div class="col-md-12 no_padding" style="margin-top: 15px; padding-top: 0px !important;">
                            <div class="col-md-3 col-xs-3 wfoi">
                                <i class="fab fa-whatsapp" style="margin-right: 0px;"></i>
                            </div>
                            <div class="col-md-9 col-xs-9 wfot">
                                <h4>299 416 7158</h4>
                                <h4>Administración Comercial</h4> 
                            </div>                        
                        </div>
                    </a>
                    <div class="clearfix"></div>
                
			</div>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin-top: 10px">
				<h4>Información de contacto</h4>
				<div class="box_sfooti-f"><i class="fas fa-map-marker-alt"></i></div><p> <?=$general['adress'];?></p>
                <div class="box_sfooti-f"><i class="fas fa-mobile-alt"></i></div><p>Teléfono: 299 4474371</p>
                <div class="box_sfooti-f"><i class="fas fa-mobile-alt"></i></div><p>Teléfono: 299 4474686</p>
                <div class="box_sfooti-f"><i class="far fa-envelope"></i></div><p>Email: <?=$general['mail'];?></p>
                <div class="box_sfooti-f"><i class="far fa-envelope"></i></div><p>Trabajar con nosotros: <a href="mailto:rrhh@cmit.com.ar?Subject=Puesto/Profesion:">rrhh@cmit.com.ar</a></p> 
				<!-- <p style="border:0"><i class="far fa-map"></i> <?=$general['maps'];?></p> -->
			</div>
			<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 visible-lg" style="margin-top: 10px" >
				<h4>Menú navegación</h4>
				<a href="<?=$general['root'];?>"><i class="fas fa-chevron-right"></i> Inicio</a>
				<a href="<?=$general['root'];?>/nosotros"><i class="fas fa-chevron-right"></i> Nosotros</a>
				<a href="<?=$general['root'];?>/prestaciones"><i class="fas fa-chevron-right"></i> Prestaciones</a>
                <a href="<?=$general['root'];?>/e-estudio"><i class="fas fa-chevron-right"></i> e-Estudio</a>
                <a href="<?=$general['root'];?>/turnos"><i class="fas fa-chevron-right"></i> Turnos</a>
				<a href="<?=$general['root'];?>/blog"><i class="fas fa-chevron-right"></i> Blog</a>
				<a href="<?=$general['root'];?>/contacto"><i class="fas fa-chevron-right"></i> Contacto</a>
			</div>
			<div class="col-lg-3 col-md-2 col-sm-6 col-xs-12 visible-lg" style="margin-top: 10px" >
                <div class="box_sfoot">
                    <a href="https://webmail.cmit.com.ar" target="_blank">
                        <div class="box_sfooti-web" style="">
                        Acceso a
                        Webmail                            
                        </div>
                        <div class="box_sfooti">
                            <i class="far fa-envelope" style="margin-right: 0px;"></i>
                        </div>
                    </a>
                    <a href="<?=$general['linkedin'];?>" target="_blank">
                        <div class="box_sfooti">
                            <i class="fab fa-linkedin-in" style="margin-right: 0px;"></i>
                        </div>
                    </a>
                    <a href="<?=$general['facebook'];?>" target="_blank">                                       
                        <div class="box_sfooti">
                            <i class="fab fa-facebook-f" style="margin-right: 0px;"></i>
                        </div>
                    </a>
                    <div class="clearfix"></div>




                </div>
			</div>

            <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12 visible-xs" style="margin-top: 10px" >

                <div class="box_sfoot">

                    <a href="<?=$general['facebook'];?>" target="_blank">                                       
                        <div class="box_sfooti" style="float: left; margin: 0px 0px 0px 0px;">
                            <i class="fab fa-facebook-f" style="margin-right: 0px;"></i>
                        </div>
                    </a>
                    <a href="<?=$general['linkedin'];?>" target="_blank">
                        <div class="box_sfooti" style="float: left; margin: 0px 0px 0px 10px;">
                            <i class="fab fa-linkedin-in" style="margin-right: 0px;"></i>
                        </div>
                    </a>

                    <a href="https://webmail.cmit.com.ar" target="_blank">
                        <div class="box_sfooti" style="float: left; margin: 0px 0px 0px 10px;">
                            <i class="far fa-envelope" style="margin-right: 0px;"></i>
                        </div>                        
                        <div class="box_sfooti-web" style="float: left; margin: 0px 0px 0px 10px;">
                        Acceso a
                        Webmail                            
                        </div>

                    </a>



                    <div class="clearfix"></div>
                </div>


            </div>

			
		</div>
	</div>


	<div class="container-fluid" style="margin-top: 5px; padding-top: 15px; background-color:#313a42; border-top:1px solid #475058">
		<div class="row">

			<div class="col-md-12 col-xs-12 text-center" style="min-height: 30px; ">

			<div class="foot_rwred" style="">
				<a href="https://www.rwagencia.com/" target="_blank" style="text-decoration: none;">RW | Ideas & Soluciones</a>
			</div>

			</div>

		</div>
	</div>

</footer>


