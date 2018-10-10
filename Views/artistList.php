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
        <tr><td>Nombre Del Artista: </td></tr>
        <?php
            foreach($artistList as $artist){
        ?>
        <tr>
            <td><?php echo " ".$artist->getName();?></td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>