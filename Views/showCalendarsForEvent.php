<br>
<div class="container text-center">
     <h3> Fechas Proximas para <?php echo $event->getTitle();?></h3><br>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img style="display:block;" src="<?php echo IMG_PATH.$event->getNameImg() ?>" height="400" width="300" >
        </div>
        <div class="col-md-8">
        <main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <table class="table bg-light-alpha">
                    <thead>
                        <th>Id</th>
                        <th>Artista</th>
                        <th>Evento</th>
                        <th>Lugar</th>
                        <th>Fecha</th>
                        <th>Imagen</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($calendarsForEvent))
                            {
                                foreach($calendarsForEvent as $Calendar)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $Calendar->getId();?></td>
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
                                            <td><img src="<?php echo FRONT_ROOT.UPLOADS_PATH.$Calendar->getNameImg() ?>" width="50" height="50"></td>
                                            <td><a href="<?php echo FRONT_ROOT."EventSeat/getEventSeatsByCalendar/".$Calendar->getId()?>" class="btn btn-info ml-3">Ver Entradas</a></td>
                                            
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>
        </div>
    </div>
</div>


