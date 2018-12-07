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
                         
                         <th>Nombre de Categoria</th>
                         <th>Modificar Categoria</th>
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

     <div class="container">
        <p class="text-center"><h2>Dar de alta una Categoria</h2></p>
        <form action="<?php echo FRONT_ROOT; ?>/Category/addCategory" method="POST">
            <br>
            <td> Tipo de evento: <input type="text" name="category" required/> </td> 
            <td><input type="submit" value="Enviar" class="btn btn-info"/> </td>
        </form>
    </div>