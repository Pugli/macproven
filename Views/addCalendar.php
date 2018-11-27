<?php
    use Model\Artist as Artist;
    use controllers\ControllerArtist as ControllerArtist;
    $artists = new ControllerArtist;
    $artistsList = $artists->getAllActives();

    use Model\EventPlace as EventPlace;
    use controllers\ControllerEventPlace as ControllerEventPlace;
    $eventPlace = new ControllerEventPlace;
    $eventPlaceList = $eventPlace->getAllActives();

    use Model\Event as Event;
    use controllers\ControllerEvent as ControllerEvent;
    $events = new ControllerEvent;
    $eventsList = $events->getAllActives();

?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Agregar Calendario</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT; ?>/Calendar/addCalendar" method="POST" enctype="multipart/form-data">
    
    <tr>
    
        <td>Fecha: <input type="date" name="date"/></td>
        
        <td>Artista: 
            <br>
                <?php 
                foreach ($artistsList as $artist){?>
                
                <input type="checkbox" name="artists[]" value="<?php echo $artist->getId()?>"><?php echo $artist->getName()?>
                   <br> 
                <?php }?>
            
        </td>
        <td>Lugar: 
            <select name="placeId">
                <?php 
                foreach ($eventPlaceList as $eventPlace){?>
                <br>
                    <option value="<?php echo $eventPlace->getId()?>"><?php echo $eventPlace->getName()?></option>
                <?php }?>
            </select>
        </td>
        <td>Evento: 
            <select name="eventId">
                <?php 
                foreach ($eventsList as $event){?>
                    <option value="<?php echo $event->getId()?>"><?php echo $event->getTitle()?></option>
                <?php }?>
            </select>
        </td>
    </tr>
    <tr>
    <td>  Imagen: <input type="file" name="image" value="" class="form-control-file ml-3" > </td>
    </tr>
        
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>