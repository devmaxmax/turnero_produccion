<section id="inicio" class="fondo_white">
    <div class="container">
        <div class="row">

            <div class="col-lg-10 col-lg-offset-1 heading-title2 style2">

                <h3>Contáctenos </h3>
                <p>Por cualquier consulta, por favor complete el siguiente formulario.</p>	                
 
            </div>

            <div class="col-lg-10 col-lg-offset-1 heading-title2 style2">                
                
                <form name="forma" method="post" action="index?/contacto/">
                
                    <? if(strpos($t[0], "enviado")): ?>
                        <h5 class="text-success bg-success" style="margin-bottom:20px; padding: 15px 10px; border-radius: 10px;"> ¡Gracias por contactarnos! A la brevedad nos comunicaremos con Ud.</h5>
                    <? endif; ?>

                    <div class="form-group col-lg-12"  style="padding-left: 0px;">
                        <input type="text" class="form-control" value="<?=$_POST['nombre'];?>" id="nombre" placeholder="Nombre y Apellido" name="nombre" required style="height: 42px;border-radius: 10px; padding: 6px 20px">   
                    </div>

                    <div class="form-group col-lg-6" style="padding-left: 0px;">
                        <input type="text" name="movil" class="form-control" value="<?=$_POST['movil'];?>" id="movil" placeholder="Teléfono" required style="height: 42px;border-radius: 10px; padding: 6px 20px"> 
                    </div>

                    <div class="form-group col-lg-6" style="padding-left: 0px;">           
                        <input type="email" class="form-control" value="<?=$_POST['email'];?>" id="email" placeholder="Email" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required style="height: 42px;border-radius: 10px; padding: 6px 20px">
                    </div>

                    <div class="form-group col-lg-12" style="padding-left: 0px;">           
                        <textarea name="consulta" rows="3" class="form-control" id="consulta" placeholder="CUIT EMPRESA y Consulta" style="border-radius: 10px; padding: 6px 20px"><?=$_POST['consulta'];?></textarea>
                    </div>
                    
                    <div class="form-group col-lg-9 col-md-12 col-xs-6" style="padding-right: 10px; padding-left: 0px;">         
                        <input class="form-control"  type="text" value="<?=$_POST['captcha'];?>" id="captcha " placeholder="Escriba el texto de la imagen" name="captcha" required pattern="gPHd98" style="height: 42px;border-radius: 10px; padding: 6px 20px">
                    </div>

                    <div class="form-group col-lg-3 col-md-12 col-xs-6" style="padding-right: 10px; padding-left: 0px;">         
                        <img src="cap.jpg" alt="" style="border-radius:10px">
                    </div>

                    <input type="submit" name="mode" value="Borrar" class="btn btn-prest4" style="display:inline; margin: 10px 0px; width: 120px">
                    <input type="submit" name="mode" value="Enviar" class="btn btn-prest3" style="display:inline; margin: 10px 10px; width: 120px">
                    
                    <div class="clearfix"></div>

                </form>
                    <br/>
                    <div class="clearfix visible-sm-block"></div> 

            </div>

        </div>
    </div>
</section>



<section id="inicio" class="fondo_white" style="border-top:1px solid #ccc">
    <div class="container">
        <div class="row">

            <div class="col-lg-10 col-lg-offset-1 heading-title2 style2">

                <h3>Ubicación </h3>
                <p>Coordenadas: <?=$general['maps'];?></p>                  
 
            </div>

            <div class="col-lg-12 heading-title2 style2">                
                
                  <div id="map" style="min-height: 350px; border:0px solid #cccccc; border-radius: 15px"></div>
                    <script type="text/javascript">
                      $(function() {
                        $("#map").googleMap({
                          zoom: 15, // Initial zoom level (optional)
                        });
                       $("#map").addMarker({
                          coords: [<?=$general['maps'];?>], // GPS coords
                          title: 'title', // Title
                          text:  '' // HTML content
                        });
                      })
                    </script> 

            </div>

        </div>
    </div>
</section>



