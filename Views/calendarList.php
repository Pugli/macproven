<?php namespace View;

    
    use Model\Artist as Artist;
    use Model\Event as Event;
    use Model\EventPlace as EventPlace;
    use controllers\ControllerEventPlace as ControllerEventPlace;
    use controllers\ControllerEvent as ControllerEvent;
    use controllers\ControllerCalendar as ControllerCalendar;
    use controllers\ControllerArtist as ControllerArtist;
    
    $controller = new ControllerCalendar();
    $artists = new ControllerArtist;
    $eventPlace = new ControllerEventPlace;
    $events = new ControllerEvent;

    $CalendarList = $controller->getAllActives();
    $artistsList = $artists->getAllActives();
    $eventPlaceList = $eventPlace->getAllActives();
    $eventsList = $events->getAllActives();
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
                        <th>Modificar Fecha</th>
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
                                            <td>
                                            <form method='post' action='<?php echo FRONT_ROOT ?>calendar/changeDate'>
                                             <input type='hidden' name='id' value="<?php echo $Calendar->getId(); ?>">
                                             <input type="date" name="date" min="<?php echo date("Y-m-d") ?>" required/>
                                             <input type='submit' name='button' value='Modificar'>
                                             </form>
                                            </td>
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

    <div class="container">
        <p class="text-center"><h2>Dar de alta un Calendario</h2></p>
<table class="table bg-light-alpha">
<thead>
                  <th>Artistas</th>
                  <th>Fecha</th>
                  <th>Lugar</th>
                  <th>Evento</th>

        </thead>
        <tbody>

        <form action="<?php echo FRONT_ROOT; ?>/Calendar/addCalendar" method="POST" enctype="multipart/form-data">
                <br>
                 
                <td> 
            <br>
                <?php 
                foreach ($artistsList as $artist){?>
                
                <label class="checkbox-inline"><input type="checkbox" name="artists[]" value="<?php echo $artist->getId()?>"><?php echo $artist->getName()?></label>
                   <br> 
                <?php }?>
            
        </td>
        <td> <input type="date" name="date" min="<?php echo date("Y-m-d") ?>" required/></td>
        <td> 
            <select name="placeId">
                <?php 
                foreach ($eventPlaceList as $eventPlace){?>
                <br>
                    <option value="<?php echo $eventPlace->getId()?>"><?php echo $eventPlace->getName()?></option>
                <?php }?>
            </select>
        </td>
        <td> 
            <select name="eventId">
                <?php 
                foreach ($eventsList as $event){?>
                    <option value="<?php echo $event->getId()?>"><?php echo $event->getTitle()?></option>
                <?php }?>
            </select>
        </td>
    </tr>
    <tr>
    <td>   <input type="file" name="image" value="" required > </td>
                <td><input type="submit" value="Enviar" class="btn btn-info"/> </td>
    </tr>
            </form>
        </tbody>
</table>
       
            
    </div>