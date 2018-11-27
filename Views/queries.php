<html>
<head>
    <meta charset="utf-8" />
    <h1>Consultar por categoria</h1>
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
  <h1>Consultar por fecha</h1>
    <form action="<?php echo FRONT_ROOT; ?>/event/checkEventForDate" method="POST">
    <br>
    <tr>
        <td>seleccione fecha: <input type="date" name="date"/></td>
        
            
    </tr>
        
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>