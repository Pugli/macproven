

     <div class="container">
     <h3> Resultados de Busqueda:</h3>

    <?php 
    $flag=0;
    $z=0;
    for($i=0;$flag==0;$i++){ ?>

        <div class="row mt-4"> <?php

        for($u=0;$u<3;$u++){ 
            if (!empty($arrayEvent[$z])){ ?>
            <div class="col-xs-4">
                <a href="<?php echo FRONT_ROOT."Event/getEventById/".$arrayEvent[$z]->getId(); ?>">
                    <img class="containerImg ml-5" src="<?php echo IMG_PATH.$arrayEvent[$z]->getNameImg() ?>" width="300" height="300">
                </a>
            </div> <?php
            $z++;
            }else{
                $flag=1;
                break;
            }
        } ?>

        </div> <?php
    }
    
    ?>

    </div>