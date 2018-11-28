<br>
<div class="container text-center">
     <h2> Entradas Disponibles Para <?php echo $calendar->getEvent()->getTitle();?></h2><br>
     <h3> <?php echo $calendar->getDate(); ?> </h3>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img style="display:block;" src="<?php echo IMG_PATH.$calendar->getNameImg() ?>" height="400" width="300" >
        </div>
        <div class="col-md-8">
        <main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <table class="table bg-light-alpha">
               <?php //var_dump($_SESSION["userLogged"]); ?>
                    <thead>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Evento</th>
                        <th>Artista</th>
                        <th>Localidad</th>
                        <?php if (isset($_SESSION["userLogged"]) && $_SESSION["userLogged"]->getIsAdmin() == 1){?><th><?php echo "Cantidad";?></th><?php } ?>
                        <th>Remanente</th>
                        <th>Precio</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($eventSeats))
                            {
                                foreach($eventSeats as $eventSeat)
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
                                            <?php if (isset($_SESSION["userLogged"]) && $_SESSION["userLogged"]->getIsAdmin() == 1){?><td><?php echo $eventSeat->getQuantityAvailable();?></td><?php }?>
                                            <td><?php echo $eventSeat->getRemaind()?></td>
                                            <td><?php echo $eventSeat->getPrice()?></td>
                                            <?php if (isset($_SESSION["userLogged"]) && $_SESSION["userLogged"]->getIsAdmin() == 0){ ?><td> <a href="<?php echo FRONT_ROOT?> PurchaseLine/showBuyPurchaseLine/<?php echo $eventSeat->getId(); ?>" class="btn btn-info ml-3">Comprar</a><?php }?>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>
        </div>
    </div>
</div>