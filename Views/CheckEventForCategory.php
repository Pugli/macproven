<html>
<head>
    <meta charset="utf-8" />
    <title>Consultar por categoria</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT; ?>/event/checkEventForCategory" method="POST">
    <br>
    <tr>
    
        <td><select name="category">
                <?php 
                foreach ($arrayCategory as $i){
                    ?>
                    <option value="<?php echo $i->getId()?>"><?php echo $i->getDescription()?></option>
                <?php }?>
            </select></td>
        
     
    </tr>
        
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>