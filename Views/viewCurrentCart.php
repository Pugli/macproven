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
                        <th>SubTotal</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($purchaseLines))
                            {
                                $total = 0;
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
                                    $total = $purchaseLine->getTotal() + $total;
                                }                               
                            }
                        ?>
                    </tbody>
               </table>
               <br>
               <br>
               <br>
               <h4>Total: <?php echo $total; ?>
               <a class="btn btn-success ml-3" href="<?php echo FRONT_ROOT; ?>Purchase/addPurchase">Confirmar Compra</a></h4>
          </div>
     </section>