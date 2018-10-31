<html>
<head>
    <meta charset="utf-8" />
    <title>Consultar por fecha</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT; ?>/event/checkEventForDate" method="POST">
    <br>
    <tr>
        <td>seleccione fecha: <input type="date" name="date"/></td>
        
            
    </tr>
        
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>