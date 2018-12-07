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
                         <th>Modificar Capacidad</th>
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
                                        <form method='post' action='<?php echo FRONT_ROOT ?>eventplace/changequantity'>
                                            <td><?php echo $eventPlace->getName() ?></td>
                                            <td><?php echo $eventPlace->getQuantity() ?></td>
                                            <td>
                                            <form method='post' action='<?php echo FRONT_ROOT ?>eventPlace/changequantity'>
                                             <input type='hidden' name='id' value="<?php echo $eventPlace->getId(); ?>">
                                             <input type='number' name='number'>
                                             <input type='submit' name='button' value='Modificar'>
                                             </form>
                                            </td>
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
        <p class="text-center"><h2>Dar de alta un Escenario</h2></p>
        <form action="<?php echo FRONT_ROOT; ?>/EventPlace/addEventPlace" method="POST">
            <br>
            <td> Lugar de Evento: <input type="text" name="eventPlace" required/> </td> 
            <td> Capacidad: <input type="number" name="Quantity" min="1" required/> </td> 
            <td><input type="submit" value="Enviar" class="btn btn-info"/> </td>
        </form>
    </div>