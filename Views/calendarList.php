<?php namespace View;

    use controllers\ControllerCalendar as ControllerCalendar;
    use Model\Artist as Artist;
    use Model\Event as Event;
    use Model\EventPlace as EventPlace;

    $controller = new ControllerCalendar();

    $CalendarList = $controller->getAllActives();
?>

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
                        <th>Eliminar</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($CalendarList))
                            {
                                foreach($CalendarList as $Calendar)
                                {
                                    ?>
                                        <tr>
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
                                            <td> <a href="<?php echo FRONT_ROOT ?>Calendar/delete/<?php echo $Calendar->getId() ?>"><img src="<?php echo IMG_PATH ?>trash.png" width="20" heigth="20"></a></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>

