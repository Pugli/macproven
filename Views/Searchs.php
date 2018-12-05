<?php namespace views;
 use dao\DaoCategoryPdo as DaoCategoryPdo;
 use dao\DaoArtistPdo as DaoArtistPdo;

 $categoryDao = new DaoCategoryPdo();
 $artistDao = new DaoArtistPdo();

 $arrayCategory = $categoryDao->getAllActives();
 $arrayArtist = $artistDao->getAllActives();
?>


<div class="offset-xl-4 ">
    
    </div>
    <br><br><br>
    <div class="offset-xl-4">
  
    </div>
    <br><br><br>
    <div class="offset-xl-4">
   
    
    </div>

    <div class="container">
        <div class="row  ">
            <div class="col-md-4">
            <h3 class="text-primary " >Consultar por Categoria:</h3>
            <form  action="<?php echo FRONT_ROOT; ?>/event/checkEventForCategory" method="POST"><br>
                <td><select name="category">
                        <?php 
                        foreach ($arrayCategory as $i){
                            ?>
                            <option  value="<?php echo $i->getId()?>"><?php echo $i->getDescription()?></option>
                        <?php }?>
                    </select></td>
                    <br> <br> <br>
        <input class="btn btn-success btn-block" type="submit" value="Enviar"/>

    </form>
            </div>
            <div class="col-md-4">
            <h3 class="text-primary" >Consultar por fecha:</h3>
                <form action="<?php echo FRONT_ROOT; ?>/event/checkEventForDate" method="POST"><br>
                
                    <td>seleccione fecha: <input type="date" name="date"/></td> 
                    <br> <br> <br>           
                    <input class="btn btn-success btn-block" type="submit" value="Enviar"/>
                    
                </form>
            </div>

            <div class="col-md-4">
                    <h3 class="text-primary">Consultar por artista:</h3>
                    <form action="<?php echo FRONT_ROOT; ?>/event/checkEventForArtist" method="POST"> <br>
   
            
                <td><select name="artist">
                        <?php 
                        foreach ($arrayArtist as $i){
                            ?>
                            <option value="<?php echo $i->getId()?>"><?php echo $i->getName()?></option>
                        <?php }?>
                    </select></td>   
                    <br> <br> <br>
                <input class="btn btn-success btn-block" type="submit" value="Enviar"/>
               
            </form>
            </div>
        </div>
    </div>
