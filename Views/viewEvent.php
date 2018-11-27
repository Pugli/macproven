<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Calendario</h2>
               <table class="table bg-light-alpha">
                    <thead>
                       
                        <th>Artista</th>
                        <th>Evento</th>
                        <th>Lugar</th>
                        <th>Fecha</th>
                        <th>Imagen</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($calendarList))
                            {
                                foreach($calendarList as $Calendar)
                                {
                                    ?>
                                    <form action="<?php echo FRONT_ROOT; ?>eventSeat/showSelectEventSeat" method="post">
                                        <tr>
                                            <input type="hidden" name="id" value="<?php echo $Calendar->getId(); ?>">
                                            <?php $artistList = $Calendar->getArtist();?>
                                            <td>
                                            <select name="eventId">
                                            <?php 
                                                foreach ($artistList as $artist){?>
                                                    <option><?php echo $artist->getName();?></option>
                                            <?php }?>
                                            </select>
                                            </td>
                                            <td><?php echo $Calendar->getEvent()->getTitle();?></td>
                                            <td><?php echo $Calendar->getEventPlace()->getName();?></td>
                                            <td><?php echo $Calendar->getDate();?></td>    
                                            <td><td><img src="<?php  echo FRONT_ROOT.UPLOADS_PATH.$Calendar->getNameImg() ?>" width="100" height="100"></td></td>
                                            <td><input class="btn btn-success ml-3" type="submit" value="ver entradas"></td>
                                        </tr>
                                        </form>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>