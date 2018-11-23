<?php require_once("extranetNav.php"); ?>

<head>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>paddingExtranet.css">
</head>

<div class="container">
    <div id="padExt">
        <div>
            <h2>Agregar Categoria</h2>
            <hr>
            <form class="form-group container" action="<?php echo FRONT_ROOT ?>Category/addCategory" method="POST">
                <br>
                <div class="container">
                    <div class="col-10">
                        <label for="name">Categoria</label>
                        <input class="form-control" type="text" name="name" required>
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
        <h2>Listado de Categorias</h2>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Categoria</th>
                    <th scope="col" class="col-md-1"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(isset($categoryList)) {
                    foreach($categoryList as $category)
                    {
            ?>
                        <tr>
                            <th scope="row"><?php echo $category->getId() ?></th>
                            <td><?php echo $category->getDescription() ?></td>
                            <td> <a href="<?php echo FRONT_ROOT ?>category/delete/<?php echo $category->getId() ?>"><img src="<?php echo IMG_PATH ?>extranetArtist/trash.png"></a></td>
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