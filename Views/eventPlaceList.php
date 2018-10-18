<?php namespace View;

    use controllers\ControllerEventPlace as ControllerEventPlace;

    $controller = new ControllerEventPlace();

    $eventPlaceList = $controller->getAll();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Lugares</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Id</th>
                         <th>Nombre del Lugar</th>
                         <th>Capacidad</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($eventPlaceList))
                            {
                                foreach($eventPlaceList as $eventPlace)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $eventPlace->getId() ?></td>
                                            <td><?php echo $eventPlace->getName() ?></td>
                                            <td><?php echo $eventPlace->getQuantity() ?></td>
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
               <h2 class="mb-4">Eliminar Lugar</h2>

               <form method="post" action="<?php echo FRONT_ROOT ?>EventPlace/delete" class="form-inline bg-light-alpha p-5">
                    <div class="form-group text-white">
                         <label for="">Id</label>
                         <input type="text" name="idEventPlace" value="" class="form-control ml-3">
                    </div>
                    <button type="submit" name="button" class="btn btn-danger ml-3">Eliminar</button>
               </form>
          </div>
     </section>