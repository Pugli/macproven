<?php namespace Views;
    require_once("extranetNav.php") 
?>

<head>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>paddingExtranet.css">
</head>

<div class="container">
    <div id="padExt">
        <div>
            <h2>Agregar lugares</h2>
            <hr>
            <form class="form-group container" action="<?php echo FRONT_ROOT ?>EventPlace/addEventPlace" method="POST">
                <br>
                <div class="container">
                    <div class="col-10">
                        <label for="name">Nombre de lugar</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>
                    <div class="col-4 pt-2">
                    Capacidad: <input type="number" name="quantity"/>
    
                    </div>
                </div>
                <?php if(isset($message)) { echo $message; } ?>
                <div class="pt-4 pl-5">
                    <button class="btn btn-primary" type="submit">Cargar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<hr>

<div class="container">
    <div class="listExt">
        <h2>Listado de Lugares</h2>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Lugar de Evento</th>
                    <th scope="col">Capacidad</th>
                    <th scope="col" class="col-md-1"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(isset($eventPlaceList)) {
                    foreach($eventPlaceList as $eventPlace)
                    {
            ?>
                        <tr>
                            <th scope="row"><?php echo $eventPlace->getId() ?></th>
                            <td><?php echo $eventPlace->getName() ?></td>
                            <td><?php echo $eventPlace->getQuantity() ?></td>
                            <td> <a href="<?php echo FRONT_ROOT ?>eventPlace/delete/<?php echo $eventPlace->getId() ?>"><img src="<?php echo IMG_PATH ?>extranetArtist/trash.png"></a></td>
                        </tr>
            <?php
                    }
                }
            ?>
            </tbody>
        </table>
        <hr>
    </div>
</div>