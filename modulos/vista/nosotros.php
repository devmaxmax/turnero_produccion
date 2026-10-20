

<section id="catalogo" class="fondo_white" >

    <div class="container">
        <div class="row">

          <div class="col-lg-10 col-lg-offset-1 heading-title style2">
                  <h3><?=$nosotros['titulo'];?></h3>
                  <p><?=$nosotros['contenido'];?></p>
          </div>

        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6 text-center">
                <div class="service-box1 text-center sr-contact">  
                    <!--<? $imagen = "contenido/imagenes/cmit-".$box44['idfoto'].".jpg";
                    if( $box44['idfoto'] != 0 AND file_exists($imagen) ): ?>

                    <img src="contenido/imagenes/cmit-<?=$box44['idfoto'];?>.jpg" alt="<?=$box44['descripcion'];?>" class="img-responsive">

                    <?  endif ;?>-->
                    
                    <h3><?=$box44['titulo'];?></h3>
                    
                    <div class="div_alto"><p><?=$box44['contenido'];?></p></div>
                                     
                </div>
            </div>
            <div class="col-lg-7 col-md-6 text-center">
                <div class="service-box1 text-center sr-contact">
                    <!--<? $imagen = "contenido/imagenes/cmit-".$box55['idfoto'].".jpg";
                    if( $box55['idfoto'] != 0 AND file_exists($imagen) ): ?>

                    <img src="contenido/imagenes/cmit-<?=$box55['idfoto'];?>.jpg" alt="<?=$box55['descripcion'];?>" class="img-responsive">

                    <?  endif ;?>-->
                    
                    <h3><?=$box55['titulo'];?></h3>
                    
                    <div class="div_alto"><p><?=$box55['contenido'];?></p></div>
                                       
                </div>
            </div>
        </div>
    </div>


</section>

<!--
<section id="inicio" class="fondo_white">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 no_padding00">

                <div class="galeria">

                    <? foreach($fnosotros as $row): ?>
                        <div class="col-xs-12 col-sm-4" >
                            <div class="img_prev2">
                                <a href="contenido/imagenes/<?=$row['id'];?>.png" data-lightbox="<?=$nosotros['titulo'];?>" data-title="<?=$nosotros['titulo'];?>">
                                    <img src="contenido/imagenes/<?=$row['id'];?>.png" class="img-responsive" alt="Click en la imagen para ampliar">
                                </a>
                            </div>
                        </div>
                      
                    <?  endforeach;?>
                </div>
                
            </div>

        </div>
    </div>
</section>
-->

