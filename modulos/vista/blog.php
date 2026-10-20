<section id="destacados" >
    <div class="container">
        <div class="row">

        <div class="col-lg-10 col-lg-offset-1 heading-title style2" style="margin-bottom: 10px;">
          <h3><?=$blogt['titulo'];?></h3>
          <p><?=$blogt['contenido'];?></p>
        </div>

        <div class="clearfix"></div>

                    <div class="masonry">

                        <? foreach($temas as $row) : ?>

                            <div class="masonry-h text-center">

                                <div class="service-box text-center sr-contact">

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

                    </div>        



        </div>
    </div>
</section>

