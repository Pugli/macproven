<?php
    use controllers\ControllerEvent as ControllerEvent;
    $controllerEvents = new ControllerEvent;
    $events = $controllerEvents->getAll();
?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner container mt-5">
                <div class="carousel-item active">
                    <img class="d-block w-100 FirstImg">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Las pastillas del abuelo</h5>
                        <p>11 de Diciembre - Velez Sarfield</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 SecondImg">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Lollapalooza</h5>
                        <p>8-9-10 de marzo - Hipodromo de BSAS</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 ThirdImg">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Rolling Stones</h5>
                        <p>25 de Enero - Estadio Monumental</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <hr>
        </div>
    </div>



    <div class="container">
     <h3> Eventos principales</h3>

    <?php 
    $flag=0;
    $z=0;
    for($i=0;$flag==0;$i++){ ?>

        <div class="row mt-4"> <?php

        for($u=0;$u<3;$u++){ 
            if (!empty($events[$z])){ ?>
            <div class="col-xs-4">
                <a href="<?php echo FRONT_ROOT."Event/getEventById/".$events[$z]->getId(); ?>">
                    <img class="containerImg ml-5" src="<?php echo IMG_PATH.$events[$z]->getNameImg() ?>" width="300" height="300">
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

