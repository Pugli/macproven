<?php namespace View;

    use controllers\ControllerEvent as ControllerEvent;
    use controllers\ControllerCategory as ControllerCategory;
    
    $categories = new ControllerCategory;
    

    $controllerEvent = new ControllerEvent();
    $controllerCategory = new ControllerCategory();

    $EventList = $controllerEvent->getAllActives();
    $categoriesList = $controllerCategory->getAllActives();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Eventos</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         
                         <th>Tipo de evento</th>
                         <th>Categoria</th>
                         <th>Imagen</th>
                         <th>Modificar Nombre</th>
                         <th>Eliminar</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($EventList))
                            {
                                foreach($EventList as $Event)
                                {
                                    ?>
                                        <tr>
                                          
                                            <td><?php echo $Event->getTitle() ?></td>
                                            <td><?php echo $Event->getCategory()->getDescription() ?></td>
                                            <td><img src="<?php echo FRONT_ROOT.UPLOADS_PATH.$Event->getNameImg() ?>" width="50" height="50"></td>
                                            
                                            <form action="<?php echo FRONT_ROOT?>event/changeTittle" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $Event->getId() ?>">
                                            <td><input type="text" name="tittle">
                                            <input class="btn btn-success ml-3" type="submit" value="cambiar"></td>
                                            </form>
                                            <td> <a href="<?php echo FRONT_ROOT ?>Event/delete/<?php echo $Event->getId() ?>"><img src="<?php echo IMG_PATH ?>trash.png" width="20" heigth="20"></a></td>

            

                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>     

       <div class="container">
        <p class="text-center"><h2>Dar de alta un Evento</h2></p>
        <form action="<?php echo FRONT_ROOT; ?>/Event/addEvent" method="POST" enctype="multipart/form-data">
        <br>
        <table class="table bg-light-alfa">
            <thead>
                    <th>Evento</th>
                    <th>Categoria</th>
                    <th>Imagen</th>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" name="event" required/> </td> 
                    <td>
                    <select name="category">
                        <?php 
                        foreach ($categoriesList as $category){?>
                            <option value="<?php echo $category->getId()?>"><?php echo $category->getDescription()?></option>
                        <?php }?>
                    </select></td>
                    <td><input type="file" name="image" value="" required> </td>
                    <td> <input type="submit" value="Enviar" class="btn btn-info"/> </td>
                </form>
                </tr>
            </tbody>
        </table>
        
            
            
    </div>