<?php namespace View;

    use controllers\ControllerCalendar as ControllerCalendar;
    use Model\Artist as Artist;
    use Model\Event as Event;
    use Model\EventPlace as EventPlace;

    $controller = new ControllerCalendar();

    $CalendarList = $controller->getAll();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Calendario</h2>
               <table class="table bg-light-alpha">
                    <thead>
                        <th>Id</th>
                        <th>Artista</th>
                        <th>Evento</th>
                        <th>Lugar</th>
                        <th>Fecha</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($CalendarList))
                            {
                                foreach($CalendarList as $Calendar)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $Calendar->getId()?></td>
                                            <?php $artistList = $Calendar->getArtist()?>
                                            <td>
                                            <select name="eventId">
                                            <?php 
                                                foreach ($artistList as $artist){?>
                                                    <option><?php echo $artist->getName()?></option>
                                            <?php }?>
                                            </select>
                                            </td>
                                            <td><?php echo $Calendar->getArtist()->getName()?></td>
                                            <td><?php echo $Calendar->getEvent()->getTitle()?></td>
                                            <td><?php echo $Calendar->getEventPlace()->getName()?></td>
                                            <td><?php echo $Calendar->getDate()?></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>

     <section id="eliminar">
          <div class="container">
               <h2 class="mb-4">Eliminar Calendario</h2>

               <form method="post" action="<?php echo FRONT_ROOT ?>Calendar/delete" class="form-inline bg-light-alpha p-5">
                    <div class="form-group text-white">
                         <label for="">Id</label>
                         <input type="text" name="idCategory" value="" class="form-control ml-3">
                    </div>
                    <button type="submit" name="button" class="btn btn-danger ml-3">Eliminar</button>
               </form>
          </div>
     </section>