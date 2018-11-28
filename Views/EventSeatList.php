<?php namespace View;

    use controllers\ControllerEventSeat as ControllerEventSeat;
    use Model\PlaceType as PlaceType;
    use Model\Calendar as Calendar;

    $controller = new ControllerEventSeat();

    $eventSeatList = $controller->getAllActives();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Plaza-Evento</h2>
               <table class="table bg-light-alpha">
               <?php //var_dump($_SESSION["userLogged"]); ?>
                    <thead>
                        <th>Fecha</th>
                        <th>Evento</th>
                        <th>Artista</th>
                        <th>Localidad</th>
                        <th>Cantidad</th>
                        <th>Remanente</th>
                        <th>Precio</th>
                        <th>Eliminar</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($eventSeatList))
                            {
                                foreach($eventSeatList as $eventSeat)
                                {
                                    ?>
                                        <tr> 
                                          
                                            <td><?php echo $eventSeat->getCalendar()->getDate()?></td>
                                            <td><?php echo $eventSeat->getCalendar()->getEvent()->getTitle()?></td>
                                            <td>
                                            <select>
                                            <?php 
                                                foreach ($eventSeat->getCalendar()->getArtist() as $artist){?>
                                                    <option><?php echo $artist->getName();?></option>
                                            <?php }?>
                                            </select>
                                            </td>
                                            <td><?php echo $eventSeat->getPlaceType()->getDescription()?></td>
                                            <td><?php echo $eventSeat->getQuantityAvailable();?></td>
                                            <td><?php echo $eventSeat->getRemaind()?></td>
                                            <td><?php echo $eventSeat->getPrice()?></td>
                                            <td> <a href="<?php echo FRONT_ROOT ?>EventSeat/delete/<?php echo $eventSeat->getId() ?>"><img src="<?php echo IMG_PATH ?>trash.png" width="20" heigth="20"></a></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>

     