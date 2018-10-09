<?php namespace View;

    use Controller\ControllerArtist as ControllerArtist;

    $controller = new ControllerArtist();

    $artistList = $controller->getAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Listado Artistas</title>
</head>
<body>
    <table>
        <?php
            foreach($artistList as $artist){
        ?>
        <th>
            <td>Nombre del Artista</td>
        </th>
        <tr>
            <td><?php echo $artist->getName();?></td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>