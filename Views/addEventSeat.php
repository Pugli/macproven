<?php namespace Views;
  require_once("extranetNav.php") 
?>

<head>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>paddingExtranet.css">
</head>

<div class="container">
    <div id="padExt">
        <div>
            <h2>Agregar plaza evento</h2>
            <hr>
            <form class="form-group container" action="<?php echo FRONT_ROOT; ?>/EventSeat/addEventSeat" method="POST">
                <br>
                <div class="container">
                    <div class="col-10">
                    Calendario:<select name="calendarId">
                <?php 
                foreach ($calendarList as $calendar){?>
                    <option value="<?php echo $calendar->getId()?>"><?php echo $calendar->getEvent()->getTitle()?></option>
                <?php }?>
            </select>
                    </div>
                    <div class="col-4 pt-2">
                    Localidad: 
            <select name="placeId">
                <?php 
                foreach ($placeTypeList as $placeType){?>
                    <option value="<?php echo $placeType->getId()?>"><?php echo $placeType->getDescription()?></option>
                <?php }?>
            </select>
         
                    </div>
                    <div class="col-4 pt-2">
                   Cantidad: <input type="number" name="quantity">
                   </div>
                   <div class="col-4 pt-2">
        Precio: <br> <input type="number" name="price">
                    </div>
                </div>
                <?php if(isset($message)) { echo $message; } ?>
                <div class="pt-4 pl-5">
                    <button class="btn btn-primary" type="submit">Cargar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<hr>

<div class="container">
    <div class="listExt">
        <h2>Listado de calendarios</h2>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">fecha</th>
                    <th scope="col">evento</th>
                    <th scope="col">artistas</th>
                    <th scope="col">localidad</th>
                    <th scope="col">remanente</th>
                    <th scope="col">precio</th>
                    <th scope="col" class="col-md-1"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(isset($eventSeatList)) {
                    foreach($eventSeatList as $eventSeat)
                    {
            ?>
                        <tr>
                            <th scope="row"><?php echo $eventSeat->getId()?></th>
                           
                                            <td><?php echo $eventSeat->getCalendar()->getDate()?></td>
                                            <td><?php echo $eventSeat->getCalendar()->getEvent()->getTitle()?></td>
                                            <td>
                                            <select>
                                            <?php 
                                                foreach ($eventSeat->getCalendar()->getArtist() as $artist){?>
                                                    <option><?php echo $artist->getName();?></option>
                                            <?php }?>
                                            </select>
                                            </td>
                                            <td><?php echo $eventSeat->getPlaceType()->getDescription()?></td>
                                            <?php if (isset($_SESSION["userLogged"])){?><td><?php echo $eventSeat->getQuantityAvailable();?></td><?php }?>
                                            <td><?php echo $eventSeat->getRemainder()?></td>
                                            <td><?php echo $eventSeat->getPrice()?></td>
                            <td> <a href="<?php echo FRONT_ROOT ?>eventPlace/delete/<?php echo $eventSeat->getId() ?>"><img src="<?php echo IMG_PATH ?>extranetArtist/trash.png"></a></td>
                        </tr>
            <?php
                    }
                }
            ?>
            </tbody>
        </table>
        <hr>
    </div>
</div>