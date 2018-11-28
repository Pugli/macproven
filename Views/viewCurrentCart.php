<?php namespace View;

    use controllers\ControllerPurchaseLine as ControllerPurchaseLine;

    $controller = new ControllerPurchaseLine();

    $purchaseLines = $controller->getCurrentPurchaseLines();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Mi Carrito</h2>
               <table class="table bg-light-alpha">
                    <thead>
                        <th>Fecha</th>
                        <th>Evento</th>
                        <th>Artista</th>
                        <th>Localidad</th>
                        <th>Cantidad</th>
                        <th>Precio Por Unidad</th>
                        <th>Precio Total</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($purchaseLines))
                            {
                                foreach($purchaseLines as $purchaseLine)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $purchaseLine->getEventSeat()->getCalendar()->getDate()?></td>
                                            <td><?php echo $purchaseLine->getEventSeat()->getCalendar()->getEvent()->getTitle()?></td>
                                            <td>
                                            <select>
                                            <?php 
                                                foreach ($purchaseLine->getEventSeat()->getCalendar()->getArtist() as $artist){?>
                                                    <option><?php echo $artist->getName();?></option>
                                            <?php }?>
                                            </select>
                                            </td>
                                            <td><?php echo $purchaseLine->getEventSeat()->getPlaceType()->getDescription()?></td>
                                            <td><?php echo $purchaseLine->getQuantity()?></td>
                                            <td><?php echo $purchaseLine->getPrice()?></td>
                                            <td><?php echo $purchaseLine->getTotal()?></td>
                                            <td> <a href="<?php echo FRONT_ROOT ?>purchaseLine/delete/<?php echo $purchaseLine->getId() ?>"><img src="<?php echo IMG_PATH ?>trash.png" width="20" heigth="20"></a></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>