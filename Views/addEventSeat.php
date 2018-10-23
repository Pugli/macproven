<?php
    use controllers\ControllerPlaceType as ControllerPlaceType;
    use controllers\ControllerCalendar as ControllerCalendar;
    


    $placeType = new ControllerPlaceType;
    $placeTypeList = $placeType->getAll();

    
    $calendar = new ControllerCalendar;
    $calendarList = $calendar->getAll();

   
    

?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Agregar Plaza-Evento</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT; ?>/EventSeat/addEventSeat" method="POST">
    <br>
    <tr>
        <td>Calendario: 
            <select name="calendarId">
                <?php 
                foreach ($calendarList as $calendar){?>
                    <option value="<?php echo $calendar->getId()?>"><?php echo $calendar->getEvent()->getTitle()?></option>
                <?php }?>
            </select>
        </td>
        <td>Localidad: 
            <select name="placeId">
                <?php 
                foreach ($placeTypeList as $placeType){?>
                    <option value="<?php echo $placeType->getId()?>"><?php echo $placeType->getDescription()?></option>
                <?php }?>
            </select>
        </td>
        <td>Cantidad: <input type="number" name="quantity"> </td>
        <td>Precio: <input type="number" name="price"> </td>
    </tr>
        
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>