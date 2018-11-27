<?php 

include("lib/qrcode/qrlib.php");  // include, hay q pegarle a la carpeta...

/* use controllers\ControllerTicket as ControllerTicket;

$ticketController = new ControllerTicket;
$tickets = $ticketController->getTicketsFromClient() */



/* $qrContent= "MACCHI SE LA RE COME";
QRcode::png($qrContent, $tempDir.$filename, QR_ECLEVEL_L, 9); */  //esta linea crea y almacena el qr



?>

  <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Mis Tickets</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Fecha de Evento</th>
                         <th>Lugar</th>
                         <th>Evento</th>
                         <th>Precio</th>
                         <th>Codigo QR</th>
                         <th>Fecha y Hora de compra</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($tickets))
                            {
                                foreach($tickets as $ticket)
                                {
                                    $tempDir ="lib/tmp/"; // variable con una carpeta temporal donde aloja los qrs creados
                                    $filename=  rand(01,99).".png"; 
                                    $qrContent= $ticket->getQr();
                                    QRcode::png($qrContent, $tempDir.$filename, QR_ECLEVEL_L, 2);
                                    ?>
                                        <tr>
                                            <td><?php echo $ticket->getPurchaseLine()->getEventSeat()->getCalendar()->getDate() ?></td>
                                            <td><?php echo $ticket->getPurchaseLine()->getEventSeat()->getCalendar()->getEventPlace()->getName() ?></td>
                                            <td><?php echo $ticket->getPurchaseLine()->getEventSeat()->getCalendar()->getEvent()->getTitle() ?></td>
                                            <td><?php echo $ticket->getPurchaseLine()->getPrice() ?></td>
                                            <td><img src="<?php echo FRONT_ROOT.$tempDir.$filename?>" alt="Qr Code" </td>
                                            <td><?php echo $ticket->getDateBought() ?></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>