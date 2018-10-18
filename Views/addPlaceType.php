<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar tipo plaza</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT; ?>PlaceType/addPlaceType"  method="post">
    <label for="description">Descripcion</label>
    <input type="text" name="description">
    <input type="submit" value="agregar">
    </form>
</body>
</html>