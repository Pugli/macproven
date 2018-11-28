<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de eventos consultados</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>TITULO</th>
                         <th>CATEGORIA</th>
                    </thead>
                    <tbody>
                        <?php
                                foreach($arrayEvent as $event)
                                {
                                    ?>
    
                                  
                                        <tr>
                                            <td><?php echo $event->getTitle() ?></td>
                                            <td><?php echo $event->getCategory()->getDescription() ?></td>
                                            <td> <a class="btn btn-info ml-3" href="<?php echo FRONT_ROOT ?>Event/getEventById/<?php echo $event->getId() ?>">Ver Fechas</a></td>
                                        </tr>
                                       
                                    <?php
                                }
                            
                        ?>
                    </tbody>
               </table>
          </div>
     </section>