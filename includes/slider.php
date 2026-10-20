<?php $slider = sql_query("SELECT * FROM foto WHERE idgaleria=0 ORDER BY id DESC LIMIT 12"); ?>
<div class="flexslider">
    <ul class="slides">
        <?php foreach($slider as $row): ?>
            <li>
                <a href="<?=$row['url']?>"><img src='contenido/slider/<?=$row['id']?>.jpg'  border="0"></a>
                <div class="flex-caption hidden-xs hidden-sm">

                    <h4>
                        <?=$row['titulo']?>
                    </h4>

                    <h3 style="margin-bottom: 10px!important;">
                        <?=$row['copete']?>
                    </h3>

                    <a href="<?=$general['root'];?>/prestaciones" class="btn btn-blue sr-button2">
                        Saber más
                    </a>

                    <a href="<?=$general['root'];?>/contacto" class="btn btn-tblue sr-button2">
                        Contáctenos
                    </a>


                </div>
            </li>
        <?php endforeach; ?>

    </ul>
</div>