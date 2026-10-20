<section id="inicio">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 text-left">

					<!--
					<h3 class="tituloh3">Nosotros</h3>
					<div class="divider"></div>
					-->


                    <? 
                    $imagen = "contenido/imagenes/".$promociones['idfoto'].".png";
                    if($promociones['idfoto'] != 0 AND file_exists($imagen) AND $promociones['afiche'] == 0): ?>

                    <a href="contenido/imagenes/<?=$promociones['idfoto'];?>.png" data-lightbox="<?=$promociones['titulo'];?>" data-title="<?=$promociones['titulo'];?>">
                    <img src="contenido/imagenes/<?=$promociones['idfoto'];?>.png" alt="<?=$promociones['descripcion'];?>" class="img-thumbnail hidden-xs" style="width:400px; float:right; margin-left: 20px; margin-top: 30px">
                    </a>

                    <?  endif ;?>
                
                
                    <h3><?=$promociones['titulo'];?></h3>
                    <h4><?=$promociones['copete'];?></h4>
                    <p><?=$promociones['contenido'];?></p> 

            </div>

        </div>
    </div>
</section>

<section id="services">

    <div class="container">
        <div class="row">

          <?php foreach($promrender as $row) : ?>
                   
            <div class="col-lg-6 col-xs-12 text-center">
                <? $imagen = "contenido/art/".$row['idfoto'].".jpg";
                if($row['idfoto'] != 0 AND file_exists($imagen)): ?>
                
                  <a href="#" style="text-decoration: none; border:0" target="_blank"><img src="contenido/art/<?=$row['idfoto'];?>.jpg" class="img-responsive img-rounded" atl=""></a>
                    <br>
                <?  endif ;?>
            </div>

          <?  endforeach ;?>

        </div>
    </div>

</section>
