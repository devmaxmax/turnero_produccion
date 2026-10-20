<section id="catalogo" class="fondo_white">

    <div class="container">
        <div class="row">

          <div class="col-lg-10 col-lg-offset-1 heading-title style2">
                  <h3><?=$central['titulo'];?></h3>
                  <p><?=nl2br($central['copete']);?></p>
          </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 text-center">
                <a href="<?=$general['root'];?>/prestaciones" style="text-decoration:none">
                <div class="service-box1 text-center sr-contact">  
                    <!--<? $imagen = "contenido/imagenes/cmit-".$box11['idfoto'].".jpg";
                    if( $box11['idfoto'] != 0 AND file_exists($imagen) ): ?>

                    <img src="contenido/imagenes/cmit-<?=$box11['idfoto'];?>.jpg" alt="<?=$box11['descripcion'];?>" class="img-responsive">

                    <?  endif ;?>-->
                    <span class="ti-clipboard" style="font-size: 40px; margin: 10px 0px 15px 0px;color:#20a1d7; display: inline-block;"></span>
                    <h3><?=$box11['titulo'];?></h3>
                    <div class="div_alto"><p><?=$box11['copete'];?></p></div>
                                     
                </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 text-center">
                <a href="<?=$general['root'];?>/blog" style="text-decoration:none">
                <div class="service-box1 text-center sr-contact">
                    <!--<? $imagen = "contenido/imagenes/cmit-".$box22['idfoto'].".jpg";
                    if( $box22['idfoto'] != 0 AND file_exists($imagen) ): ?>

                    <img src="contenido/imagenes/cmit-<?=$box22['idfoto'];?>.jpg" alt="<?=$box22['descripcion'];?>" class="img-responsive">

                    <?  endif ;?>-->
                    <span class="ti-pencil-alt" style="font-size: 40px; margin: 10px 0px 15px 0px;color:#20a1d7; display: inline-block;"></span>
                    <h3><?=$box22['titulo'];?></h3>
                    <div class="div_alto"><p><?=$box22['copete'];?></p></div>
                                       
                </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 text-center">
                <a href="<?=$general['root'];?>/turnos" style="text-decoration:none">
                <div class="service-box1 text-center sr-contact">
                    <!--<? $imagen = "contenido/imagenes/cmit-".$box33['idfoto'].".jpg";
                    if( $box33['idfoto'] != 0 AND file_exists($imagen) ): ?>

                    <img src="contenido/imagenes/cmit-<?=$box33['idfoto'];?>.jpg" alt="<?=$box33['descripcion'];?>" class="img-responsive">

                    <?  endif ;?>-->
                    <span class="ti-alarm-clock" style="font-size: 40px; margin: 10px 0px 15px 0px;color:#20a1d7; display: inline-block;"></span>
                    <h3><?=$box33['titulo'];?></h3>
                    <div class="div_alto"><p><?=$box33['copete'];?></p></div>
                                        
                </div>
                </a>
            </div>
        </div>
    </div>


</section>



<div class="parallaxr4y" id="parallaxr4y">
    <div class="container">
     <div class="col-lg-12 text-center ssl">

                <h3>Exámenes de Ingreso</h3>

                <h4>Son obligatorios por parte del Empleador y determinan la aptitud del postulante para el puesto o cargo a desempeñar, dejando asentadas las preexistencias médicas que se detecten, impidiendo que sean luego atribuidas al trabajo que realizará.</h4>

      </div>
    </div>

</div>


<section id="novedades" class="fondo_white2">
    <div class="container">
        <div class="row">

            <div class="col-md-12 tittle" style="padding-left:15px;">
                <h3>Actualidad | Blog</h3>
                
            </div>

                        <? foreach($novedades as $row) : ?>

                            <div class="col-lg-4 col-md-4 text-center">
                            
                                <div class="service-box text-center sr-icons">

                                    <? $imagen = "contenido/imagenes/".$row['idfoto'].".jpg";
                                    if( $row['idfoto'] != 0 AND file_exists($imagen) ): ?>

                                    <div class="protector">
                                        <img src="<?=$general['root'];?>/contenido/imagenes/<?=$row['idfoto'];?>.jpg" alt="<?=$row['titulo'];?>" class="img-responsive">
                                    </div>

                                    <?  endif ;?>

                                    <div class="service-boxin">

                                        <h3><?=$row['titulo'];?></h3>
                                        <p><?=$row['contenido'];?></p>

                                        <div class="service-boxinb">
                                            <div class="credit">
                                                <i class="far fa-calendar-alt"></i> <?php $miFecha = date("d-m-Y", strtotime($row['fecha'])); 
                                                echo fechaCastellano($miFecha); ?>
                                            </div>
                                            <div class="votos">
                                                <li class="voting_btn up_button" data-voto="likes" data-id="<?php echo $row["id"]; ?>"><span><?php echo $row["likes"]; ?></span></li>
                                                
                                            </div>

                                        </div>  

                                    </div>

                                    <div class="clearfix"></div>
                               
                                </div>
                            
                            </div>

                        <?  endforeach ;?>
                                           
                                           
                            <div class="col-lg-4 col-md-4 text-center">


                                <? $imagen = "contenido/imagenes/".$imgli['idfoto'].".png";
                                if( $imgli['idfoto'] != 0 AND file_exists($imagen) ): ?>

                                <div class="protector sr-icons">
                                    <a href="<?=$imgli['url'];?>" style="border:0; text-decoration: none">
                                        <img src="<?=$general['root'];?>/contenido/imagenes/<?=$imgli['idfoto'];?>.png" alt="<?=$imgli['titulo'];?>" class="img-responsive img-rounded" style="margin: 10px 0px 40px;">
                                    </a>
                                </div>

                                <?  endif ;?>


                            </div>


        </div>
    </div>
</section>

