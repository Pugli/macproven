<?php namespace View;

    use controllers\ControllerPlaceType as ControllerPlaceType;

    $controller = new ControllerPlaceType();

    $placeTypeList = $controller->getAllActives();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Tipos de Plaza</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Id</th>
                         <th>Tipo de Plaza</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($placeTypeList))
                            {
                                foreach($placeTypeList as $placeType)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $placeType->getId() ?></td>
                                            <td><?php echo $placeType->getDescription() ?></td>
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
               <h2 class="mb-4">Eliminar Tipo de Plaza</h2>

               <form method="post" action="<?php echo FRONT_ROOT ?>PlaceType/delete" class="form-inline bg-light-alpha p-5">
                    <div class="form-group text-white">
                         <label for="">Id</label>
                         <input type="text" name="idPlaceType" value="" class="form-control ml-3">
                    </div>
                    <button type="submit" name="button" class="btn btn-danger ml-3">Eliminar</button>
               </form>
          </div>
     </section>