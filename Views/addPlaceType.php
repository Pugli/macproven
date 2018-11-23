<?php  namespace Views;
    require_once("extranetNav.php");
?>

<head>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>paddingExtranet.css">
</head>

<!-- AGREGACION DE ARTISTA -->
<div class="container">
    <div id="padExt">
        <div>
            <h2>Agregar tipo de localidad</h2>
            <hr>
            <form class="form-group container" action="<?php echo FRONT_ROOT ?>placeType/addPlaceType" method="POST">
                <br>
                <div class="container">
                    <div class="col-10">
                        <label for="name">Descripcion</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>
                </div>
                <?php if(isset($message)) { echo $message; } ?>
                <br>
                <div class="pt-4 pl-5">
                    <button class="btn btn-primary" type="submit">Cargar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<hr>

<!-- LISTADO DE ARTISTAS -->
<div>
</div>
<div class="container">
    <div class="listExt">
        <h2>Listado de localidades</h2>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">localidad</th>
                    <th scope="col" class="col-md-1"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(isset($placeTypeList)) {
                    foreach($placeTypeList as $placeType)
                    {
            ?>
                        <tr>
                            <th scope="row"><?php echo $placeType->getId() ?></th>
                            <td><?php echo $placeType->getDescription() ?></td>
                            <td> <a href="<?php echo FRONT_ROOT ?>artist/delete/<?php echo $placeType->getId() ?>"><img src="<?php echo IMG_PATH ?>extranetArtist/trash.png"></a></td>
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