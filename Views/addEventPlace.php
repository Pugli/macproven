<!DOCTYPE html>
 <html>
<head>
    <meta charset="utf-8" />
    <title>Agregar Lugar de Evento</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT; ?>/EventPlace/addEventPlace" method="POST">
    <br>
        Lugar de Evento: <input type="text" name="name"/>
        Capacidad: <input type="number" name="quantity"/>
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>