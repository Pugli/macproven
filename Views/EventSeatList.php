<?php namespace View;

    use controllers\ControllerEventSeat as ControllerEventSeat;
    use Model\PlaceType as PlaceType;
    use Model\Calendar as Calendar;

    $controller = new ControllerEventSeat();

    $eventSeatList = $controller->getAll();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Plaza-Evento</h2>
               <table class="table bg-light-alpha">
                    <thead>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Evento</th>
                        <th>Artista</th>
                        <th>Localidad</th>
                        <th>Cantidad</th>
                        <th>Remanente</th>
                        <th>Precio</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($eventSeatList))
                            {
                                foreach($eventSeatList as $eventSeat)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $eventSeat->getId()?></td>
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
                                            <td><?php echo $eventSeat->getQuantityAvailable()?></td>
                                            <td><?php echo $eventSeat->getRemainder()?></td>
                                            <td><?php echo $eventSeat->getPrice()?></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>

     <!-- <section id="eliminar">
          <div class="container">
               <h2 class="mb-4">Eliminar Plaza-Evento</h2>

               <form method="post" action="<?php //echo FRONT_ROOT ?>EventSeat/delete" class="form-inline bg-light-alpha p-5">
                    <div class="form-group text-white">
                         <label for="">Id</label>
                         <input type="text" name="idEventSeat" value="" class="form-control ml-3">
                    </div>
                    <button type="submit" name="button" class="btn btn-danger ml-3">Eliminar</button>
               </form>
          </div>
     </section> -->