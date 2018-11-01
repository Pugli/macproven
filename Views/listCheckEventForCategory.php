<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de eventos por categoria</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         
                         <th>TITULO</th>
                         
                    </thead>
                    <tbody>
                        <?php
                                foreach($arrayEvent as $event)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $event->getTitle() ?></td>
                                        </tr>
                                    <?php
                                }
                            
                        ?>
                    </tbody>
               </table>
          </div>
     </section>