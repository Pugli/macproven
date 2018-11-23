<?php namespace Views; 
    require_once("navbar.php");
?>
<title> Fazt </title>
<div id="container" class="container">
        <div class="mt-3">
            <h3 class="justify-content-center"> ¡Adquirí las entradas para el evento que quieras!</h3>
            <!--<form action="">
                <input class="form-control" type="search" name="search" id="search" placeholder="Buscá por Artista o Evento">
            </form>-->
        </div>
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
                        <h5>La Vela Puerca</h5>
                        <p>13 de Octubre - Once Unidos</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 SecondImg">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Divididos</h5>
                        <p>21 de Abril - Obras Sanitarias</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 ThirdImg">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Cirque Du Soleil - Sep7imo Día</h5>
                        <p>14 de Diciembre - Luna Park</p>
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
        <h3> Eventos más buscados</h3>
        <div class="row mt-4">
            <div>
                <a href="">
                    <img class="containerImg ml-5" src="<?php echo IMG_PATH ?>/Container/donOsvaldo.jpg">
                </a>
            </div>
            <div>
                <a href="">
                    <img class="containerImg ml-5" src="<?php echo IMG_PATH ?>/Container/ciro.jpg">
                </a>
            </div>
            <div>
                <a href="">
                    <img class="containerImg ml-5" src="<?php echo IMG_PATH ?>/Container/ntvg.jpg">
                </a>
            </div>
        </div>
        <div class="row mt-4">
            <div>
                <a href="">
                    <img class="containerImg ml-5" src="<?php echo IMG_PATH ?>/Container/guasones.jpg">
                </a>
            </div>
            <div>
                <a href="">
                    <img class="containerImg ml-5" src="<?php echo IMG_PATH ?>/Container/la25.jpg">
                </a>
            </div>
            <div>
                <a href="">
                    <img class="containerImg ml-5" src="<?php echo IMG_PATH ?>/Container/laVela.jpg">
                </a>
            </div>
        </div>
        <div class="row mt-4">
                <div>
                    <a href="">
                        <img class="containerImg ml-5" src="<?php echo IMG_PATH ?>/Container/lolapalloza.jpg">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img class="containerImg ml-5" src="<?php echo IMG_PATH ?>/Container/personalFest.jpg">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img class="containerImg ml-5" src="<?php echo IMG_PATH ?>/Container/harlemFest.jpg">
                    </a>
                </div>
            </div>
            <hr>
    </div>
</body>

</html>
<?php require_once("footer.php"); ?>