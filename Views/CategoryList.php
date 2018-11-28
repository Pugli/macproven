<?php namespace View;

    use controllers\ControllerCategory as ControllerCategory;

    $controller = new ControllerCategory();

    $CategoryList = $controller->getAllActives();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Categorias</h2>
               
               <table class="table bg-light-alpha">
                    <thead>
                         
                         <th>Tipo de evento</th>
                         <th>Modificar Tipo de evento</th>
                         <th>Eliminar</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($CategoryList))
                            {
                                foreach($CategoryList as $Category)
                                {
                                    ?>
                                        <tr>
                                            
                                            <td><?php echo $Category->getDescription() ?></td>
                                            <form action="<?php echo FRONT_ROOT?>category/changeDescription" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $Category->getId() ?>">
                                            <td><input type="text" name="description">
                                            <input class="btn btn-success ml-3" type="submit" value="Modificar"></td>
                                            </form>
                                            <td> <a href="<?php echo FRONT_ROOT ?>Category/delete/<?php echo $Category->getId() ?>"><img src="<?php echo IMG_PATH ?>trash.png" width="20" heigth="20"></a></td>
                                        </tr>
                                    <?php

                                }
                            }
                        ?>
                    </tbody>
               </table>
              
          </div>
     </section>