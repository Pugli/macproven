
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Plaza-Evento</h2>
               <table class="table bg-light-alpha">
                    <thead>
                        <th></th>
                        <th>Fecha</th>
                        <th>Evento</th>
                        <th>Artista</th>
                        <th>Localidad</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT; ?>/PurchaseLine/addPurchaseLineOnCart" method="POST">
                         <tr>
                             <td> <input type="hidden" name="id" value="<?php echo $eventSeat->getId()?>"></td>
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
                             <td><?php echo $eventSeat->getPrice()?></td>
                            <td> <input type="number" value="1" name="quantity" min="1" max="10"> </td>
                            <td><input type="submit" value="Comprar"></td>                 
                    </form>                   
                             </tr>
                    </tbody>
               </table>
          </div>
     </section>