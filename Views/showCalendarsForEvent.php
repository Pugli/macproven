<br>
<div class="container text-center">
     <h3> Fechas Proximas para <?php echo $event->getTitle();?></h3>

    <?php 
    $flag=0;
    $z=0;
    for($i=0;$flag==0;$i++){ ?>

        <div class="row mt-4"> <?php

        for($u=0;$u<3;$u++){ 
            if (!empty($calendarsForEvent[$z])){ ?>
            <div class="col-xs-4">
                <a href="">
                    <img class="containerImg ml-5" src="<?php echo IMG_PATH.$calendarsForEvent[$z]->getNameImg() ?>" width="300" height="300">
                </a><br>
                <p class="text-center"><?php echo $calendarsForEvent[$z]->getDate(); ?> </p>   
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