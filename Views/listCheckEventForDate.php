<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de eventos por fecha</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>ID</th>
                         <th>TITULO</th>
                         <th>CATEGORIA</th>
                    </thead>
                    <tbody>
                        <?php
                                foreach($arrayEvent as $event)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $event->getId() ?></td>
                                            <td><?php echo $event->getTitle() ?></td>
                                            <td><?php echo $event->getCategory()->getDescription() ?></td>
                                        </tr>
                                    <?php
                                }
                            
                        ?>
                    </tbody>
               </table>
          </div>
     </section>