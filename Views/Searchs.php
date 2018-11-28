<?php namespace views;
 use dao\DaoCategoryPdo as DaoCategoryPdo;
 use dao\DaoArtistPdo as DaoArtistPdo;

 $categoryDao = new DaoCategoryPdo();
 $artistDao = new DaoArtistPdo();

 $arrayCategory = $categoryDao->getAllActives();
 $arrayArtist = $artistDao->getAllActives();
?>

<html>
<head>
    <meta charset="utf-8" />
    <h1>Consultar por categoria</h1>
</head>
<body>
<div>
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
    </div>
    <div>
  <h1>Consultar por fecha</h1>
    <form action="<?php echo FRONT_ROOT; ?>/event/checkEventForDate" method="POST">
    <br>
    <tr>
        <td>seleccione fecha: <input type="date" name="date"/></td>
        
            
    </tr>
        
        <input type="submit" value="Enviar"/>
    </form>
    </div>
    <div>
    <form action="<?php echo FRONT_ROOT; ?>/event/checkEventForArtist" method="POST">
    <br>
    <h1>Consultar por artista:</h1>
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
    </div>
</body>
</html>