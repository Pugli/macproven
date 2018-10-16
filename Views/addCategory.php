<!DOCTYPE html>
 <html>
<head>
    <meta charset="utf-8" />
    <title>Agregar Categoria</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT; ?>/Category/addCategory" method="POST">
    <br>
        Tipo de Evento: <input type="text" name="name"/>
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>