<?php 

include("lib/qrcode/qrlib.php");  // include, hay q pegarle a la carpeta...

/* use controllers\ControllerTicket as ControllerTicket;

$ticketController = new ControllerTicket;
$tickets = $ticketController->getTicketsFromClient() */

$tempDir ="lib/tmp/"; // variable con una carpeta temporal donde aloja los qrs creados
$filename=  rand(01,99).".png"; 

/* $qrContent= "MACCHI SE LA RE COME";
QRcode::png($qrContent, $tempDir.$filename, QR_ECLEVEL_L, 9); */  //esta linea crea y almacena el qr



?>

  <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Mis Tickets</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Id</th>
                         <th>Nombre</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($tickets))
                            {
                                foreach($tickets as $ticket)
                                {
                                    $qrContent= $ticket->getQr();
                                    QRcode::png($qrContent, $tempDir.$filename, QR_ECLEVEL_L, 9);
                                    ?>
                                        <tr>
                                            <td><?php echo $ticket->getId() ?></td>
                                            <td><img src="<?php echo FRONT_ROOT.$tempDir.$filename?>" alt="Qr Code" </td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>