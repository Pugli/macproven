<!DOCTYPE html>
 <html>
<head>
    <meta charset="utf-8" />
    <title>Agregar Artista</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT; ?>/Artist/addArtist" method="POST">
    <br>
        Nombre: <input type="text" name="name"/> <br>
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>