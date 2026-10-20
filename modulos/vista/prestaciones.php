

<section id="catalogo" class="fondo_white" >

    <div class="container">
        <div class="row">

          <div class="col-lg-10 col-lg-offset-1 heading-title style2">
                  <h3><?=$prestaciones['titulo'];?></h3>
                  <p><?=$prestaciones['contenido'];?></p>
          </div>

        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 text-center">
                <div class="service-box1 text-center sr-contact">  
                    <!--<? $imagen = "contenido/imagenes/cmit-".$box1['idfoto'].".jpg";
                    if( $box1['idfoto'] != 0 AND file_exists($imagen) ): ?>

                    <img src="contenido/imagenes/cmit-<?=$box1['idfoto'];?>.jpg" alt="<?=$box1['descripcion'];?>" class="img-responsive">

                    <?  endif ;?>-->
                    
                    <h3><?=$box1['titulo'];?></h3>
                    
                    <div class="div_alto"><p><?=$box1['contenido'];?></p></div>
                                     
                </div>
            </div>
            <div class="col-lg-4 col-md-4 text-center">
                <div class="service-box1 text-center sr-contact">
                    <!--<? $imagen = "contenido/imagenes/cmit-".$box2['idfoto'].".jpg";
                    if( $box2['idfoto'] != 0 AND file_exists($imagen) ): ?>

                    <img src="contenido/imagenes/cmit-<?=$box2['idfoto'];?>.jpg" alt="<?=$box2['descripcion'];?>" class="img-responsive">

                    <?  endif ;?>-->
                    
                    <h3><?=$box2['titulo'];?></h3>
                    
                    <div class="div_alto"><p><?=$box2['contenido'];?></p></div>
                                       
                </div>
            </div>
            <div class="col-lg-4 col-md-4 text-center">
                <div class="service-box1 text-center sr-contact">  
                    <!--<? $imagen = "contenido/imagenes/cmit-".$box3['idfoto'].".jpg";
                    if( $box3['idfoto'] != 0 AND file_exists($imagen) ): ?>

                    <img src="contenido/imagenes/cmit-<?=$box3['idfoto'];?>.jpg" alt="<?=$box3['descripcion'];?>" class="img-responsive">

                    <?  endif ;?>-->
                    
                    <h3><?=$box3['titulo'];?></h3>
                    
                    <div class="div_alto"><p><?=$box3['contenido'];?></p></div>
                                     
                </div>
            </div>
        </div>
    </div>

</section>



<section>
    <div class="container">
        <div class="row"> 

            <div class="col-lg-6 col-md-12 text-center">
                <div class="center-banner sr-contact">  

                    <div class="col-md-7 col-xs-12 alinea">
                        <h3>
                            Solicite un presupuesto desde este enlace
                        </h3>
                    </div>

                    <div class="col-md-5 col-xs-12 alinea2">
                        <a href="<?=$general['root'];?>/presupuesto" class="btn btn-prest" style="margin-top: 10px">Solicitar Presupuesto</a>
                    </div>

                    <div class="clearfix"></div>                                   

                </div>
            </div>

            <div class="col-lg-6 col-md-12 text-center">
                <div class="center-banner2 sr-contact">  

                    <div class="col-md-8 col-sm-12 alinea">
                        <h3>
                            Reserve ahora su turno, haciendo click en el siguiente botón.
                        </h3>
                    </div>

                    <div class="col-md-4 col-sm-12 alinea2">
                        <a href="<?=$general['root'];?>/turnos" class="btn btn-prest2" style="margin-top: 10px">Solicitar Turno</a>
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

          <div class="col-lg-12 heading-title style2" style="margin-bottom: 10px;">
                  <h3>Pilares de Calidad</h3>
                  <!-- <?=$prestaciones['contenido'];?></p> -->
          </div>

        </div>
    </div>


    <div class="container">
        <div class="row">

            <div class="col-lg-10 col-lg-offset-1" style="margin-top:45px;">

                            <h3><?=$box4['titulo'];?></h3>
                            <p><?=$box4['contenido'];?></p>                          
            </div>

            <div class="col-lg-10 col-lg-offset-1" style="margin-top:35px;">

                            <h3><?=$box5['titulo'];?></h3>
                            <p><?=$box5['contenido'];?></p>                          
            </div>

            <div class="col-lg-10 col-lg-offset-1" style="margin-top:35px; margin-bottom: 30px">

                            <h3><?=$box6['titulo'];?></h3>
                            <p><?=$box6['contenido'];?></p>                          
            </div>


        </div>
    </div>


</section>

<div class="parallaxwidge hidden-sm hidden-md" id="parallaxr4y" >
    <div class="container">
            <div class="widge2">
                
                <div class="col-lg-2 col-md-12 text-center">

                    <img src="img/badge.png" alt="" width="140">

                </div>

                <div class="col-lg-10 col-md-12 text-left">

                    <h3 style="color:#fff!important">Calidad Asegurada</h3>
                    <p style="color:#fff!important">Contamos con todas las habilitaciones Nacionales, Provinciales y Municipales que avalan la calidad de nuestros servicios y procesos.</p>   

                </div>

            </div>
    </div>

</div>

<section id="galeria" class="fondo_white" >

    <div class="container">
        <div class="row">

          <div class="col-lg-10 col-lg-offset-1 heading-title style2" style="margin-bottom: 0px;">
                  <h3><?=$titulogal['titulo'];?></h3>
                  <p><?=$titulogal['contenido'];?></p>
          </div>

        </div>
    </div>

</section>


<div class="clearfix"></div>

<section class="fondo_white" style="padding-top: 40px;">

    <div class="container">
        <div class="row">

                <? $galeria = sql_query("SELECT * FROM foto3 WHERE idgaleria=0 ORDER BY id ASC LIMIT 15 ");
                foreach($galeria as $row): ?>

                        <div class="col-lg-4 text-center" style="margin-bottom:20px">
                            <a href="contenido/slider3/<?=$row['id'];?>.jpg" data-lightbox="example-set" data-title="<?=$row['titulo'];?>" >
                                <img src="contenido/slider3/<?=$row['id'];?>.jpg" data-lightbox="example-set" data-title="<?=$row['titulo'];?>" class="img-responsive sr-icons">
                            </a>
                        </div>

                <? endforeach; ?>  

        </div>
    </div>

</section>