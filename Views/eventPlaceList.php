<?php namespace View;

    use controllers\ControllerEventPlace as ControllerEventPlace;

    $controller = new ControllerEventPlace();

    $eventPlaceList = $controller->getAllActives();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Escenarios</h2>
               <table class="table bg-light-alpha">
                    <thead>
                       
                         <th>Nombre del Lugar</th>
                         <th>Capacidad</th>
                         <th>Modificar Nombre</th>
                         <th>Eliminar</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($eventPlaceList))
                            {
                                foreach($eventPlaceList as $eventPlace)
                                {
                                    ?>
                                        <tr>
                                            
                                            <td><?php echo $eventPlace->getName() ?></td>
                                            <td><?php echo $eventPlace->getQuantity() ?></td>
                                            <td></td>
                                            <td> <a href="<?php echo FRONT_ROOT ?>EventPlace/delete/<?php echo $eventPlace->getId() ?>"><img src="<?php echo IMG_PATH ?>trash.png" width="20" heigth="20"></a></td>
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