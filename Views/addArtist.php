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
            <h2>Agregar Artista/s</h2>
            <hr>
            <form class="form-group container" action="<?php echo FRONT_ROOT ?>Artist/addArtist" method="POST">
                <br>
                <div class="container">
                    <div class="col-10">
                        <label for="name">Nombre de Artista/s</label>
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
        <h2>Listado de Artistas</h2>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Artista</th>
                    <th scope="col" class="col-md-1"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(isset($artistList)) {
                    foreach($artistList as $artist)
                    {
            ?>
                        <tr>
                            <th scope="row"><?php echo $artist->getId() ?></th>
                            <td><?php echo $artist->getName() ?></td>
                            <td> <a href="<?php echo FRONT_ROOT ?>artist/delete/<?php echo $artist->getId() ?>"><img src="<?php echo IMG_PATH ?>extranetArtist/trash.png"></a></td>
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