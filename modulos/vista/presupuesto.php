<section id="inicio" class="fondo_white">
    <div class="container">
        <div class="row">

            <div class="col-lg-10 col-lg-offset-1 heading-title2 style2">

                <h3>Solicitar Presupuesto</h3>
                <p>Complete el siguiente formulario. Le responderemos a la brevedad.</p>	                
 
            </div>

            <div class="col-lg-10 col-lg-offset-1 heading-title2 style2">                
                
                <form name="forma" method="post" action="index?/presupuesto/">
                
                    <? if(strpos($t[0], "enviado")): ?>
                        <h5 class="text-success bg-success" style="margin-bottom:20px; padding: 15px 10px; border-radius: 10px;"> ¡Gracias por contactarnos! A la brevedad nos comunicaremos con Ud.</h5>
                    <? endif; ?>

                    <div class="form-group col-lg-12"  style="padding-left: 0px;">
                        <input type="text" class="form-control" value="<?=$_POST['nombre'];?>" id="nombre" placeholder="Nombre y Apellido" name="nombre" required style="height: 42px;border-radius: 10px; padding: 6px 20px">   
                    </div>

                    <div class="form-group col-lg-6" style="padding-left: 0px;">
                        <input type="text" name="empresa" class="form-control" value="<?=$_POST['empresa'];?>" id="empresa" placeholder="Empresa" required style="height: 42px;border-radius: 10px; padding: 6px 20px"> 
                    </div>

                    <div class="form-group col-lg-6" style="padding-left: 0px;">
                        <input type="text" name="cuit" class="form-control" value="<?=$_POST['cuit'];?>" id="cuit" placeholder="CUIT" required style="height: 42px;border-radius: 10px; padding: 6px 20px"> 
                    </div>


                    <div class="form-group col-lg-6" style="padding-left: 0px;">
                        <input type="text" name="movil" class="form-control" value="<?=$_POST['movil'];?>" id="movil" placeholder="Teléfono" required style="height: 42px;border-radius: 10px; padding: 6px 20px"> 
                    </div>

                    <div class="form-group col-lg-6" style="padding-left: 0px;">           
                        <input type="email" class="form-control" value="<?=$_POST['email'];?>" id="email" placeholder="Email" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required style="height: 42px;border-radius: 10px; padding: 6px 20px">
                    </div>

                    <div class="form-group col-lg-12" style="padding-left: 0px;">           
                        <textarea name="consulta" rows="3" class="form-control" id="consulta" placeholder="Servicios requeridos" style="border-radius: 10px; padding: 6px 20px"><?=$_POST['consulta'];?></textarea>
                    </div>
                    
                    <div class="form-group col-lg-9 col-md-12  col-xs-6" style="padding-right: 10px; padding-left: 0px;">         
                        <input class="form-control"  type="text" value="<?=$_POST['captcha'];?>" id="captcha " placeholder="Escriba el texto de la imagen" name="captcha" required pattern="gPHd98" style="height: 42px;border-radius: 10px; padding: 6px 20px">
                    </div>

                    <div class="form-group col-lg-3 col-md-12  col-xs-6" style="padding-right: 10px; padding-left: 0px;">         
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



