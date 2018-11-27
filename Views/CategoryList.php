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
                         <th>Id</th>
                         <th>Tipo de evento</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($CategoryList))
                            {
                                foreach($CategoryList as $Category)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $Category->getId() ?></td>
                                            <td><?php echo $Category->getDescription() ?></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>

     <section id="eliminar">
          <div class="container">
               <h2 class="mb-4">Eliminar Categoria</h2>

               <form method="post" action="<?php echo FRONT_ROOT ?>Category/delete" class="form-inline bg-light-alpha p-5">
                    <div class="form-group text-white">
                         <label for="">Id</label>
                         <input type="text" name="idCategory" value="" class="form-control ml-3">
                    </div>
                    <button type="submit" name="button" class="btn btn-danger ml-3">Eliminar</button>
               </form>
          </div>
     </section>