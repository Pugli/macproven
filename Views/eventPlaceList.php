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

        <div class="container">
        <p class="text-center"><h2>Dar de alta una Categoria</h2></p>
        <form action="<?php echo FRONT_ROOT; ?>/EventPlace/addEventPlace" method="POST">
            <br>
            <td> Lugar de Evento: <input type="text" name="eventPlace"/> </td> 
            <td> Capacidad: <input type="text" name="Quantity"/> </td> 
            <td><input type="submit" value="Enviar" class="btn btn-info"/> </td>
        </form>
    </div>