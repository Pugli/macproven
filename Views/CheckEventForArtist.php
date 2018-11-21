<html>
<head>
    <meta charset="utf-8" />
    <title>Consultar por artista</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT; ?>/event/checkEventForArtist" method="POST">
    <br>
    <tr>
    
        <td><select name="artist">
                <?php 
                foreach ($arrayArtist as $i){
                    ?>
                    <option value="<?php echo $i->getId()?>"><?php echo $i->getName()?></option>
                <?php }?>
            </select></td>
        
     
    </tr>
        
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>