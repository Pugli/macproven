<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de eventos consultados</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>TITULO</th>
                         <th>CATEGORIA</th>
                         <th>IMAGEN</th>
                         <th>FECHAS</th>
                    </thead>
                    <tbody>
                        <?php
                                foreach($arrayEvent as $event)
                                {
                                    ?>
                                  
                                        <tr>
                                            <td><?php echo $event->getTitle() ?></td>
                                            <td><?php echo $event->getCategory()->getDescription() ?></td>
                                            <td><img style="" src="<?php echo IMG_PATH.$event->getNameImg() ?>" height="50" width="50" ></td>
                                            <td> <a class="btn btn-info ml-3" href="<?php echo FRONT_ROOT ?>Event/getEventById/<?php echo $event->getId() ?>">ver</a></td>
                                        </tr>
                                       
                                    <?php
                                }
                            
                        ?>
                    </tbody>
               </table>
          </div>
     </section>