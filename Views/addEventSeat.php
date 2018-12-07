<?php
    use controllers\ControllerPlaceType as ControllerPlaceType;
    use controllers\ControllerCalendar as ControllerCalendar;
    
    $placeType = new ControllerPlaceType;
    $placeTypeList = $placeType->getAllActives();

    
    $calendar = new ControllerCalendar;
    $calendarList = $calendar->getAllActives();

   
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Agregar Plaza-Evento</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT; ?>/EventSeat/addEventSeat" method="POST">
    
    <?php for($i=0;$i<count($placeTypeList);$i++){ ?>
        <br>
    <tr>
    
        <td>Calendario: 
            <select name="calendarId[]">
                <?php 
                foreach ($calendarList as $calendar){?>
                    <option value="<?php echo $calendar->getId()?>"><?php echo $calendar->getEvent()->getTitle()?></option>
                <?php }?>
            </select>
        </td>
        <td>Localidad: 
            <select name="placeId[]">
                <?php 
                foreach ($placeTypeList as $placeType){?>
                    <option value="<?php echo $placeType->getId()?>"><?php echo $placeType->getDescription()?></option>
                <?php }?>
            </select>
        </td>
        <td>Cantidad: <input type="number" name="quantity[]" min='1'> </td>
        <td>Precio: <input type="number" name="price[]" min='1'> </td>
        <br>
    </tr> <?php
    } ?>
        <br>
        <div class="container-fluid">
            <input type="submit" value="Agregar" class="btn btn-success"/>
            <input type="reset" value="Resetear Campos" class="btn btn-success">
        </div>
        
    </form>
</body>
</html>