<?php namespace Views;
  require_once("extranetNav.php") 
?>

<head>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>paddingExtranet.css">
</head>

<div class="container">
    <div id="padExt">
        <div>
            <h2>Agregar calendario</h2>
            <hr>
            <form class="form-group container" action="<?php echo FRONT_ROOT; ?>/Calendar/addCalendar" method="POST">
                <br>
                <div class="container">
                    <div class="col-10">
                    <label for="date" >Fecha:</label>
                    <input type="date" name="date"/> <br>
                        <label for="name">Artistas:</label>
                        <br>
                <?php 
                foreach ($artistsList as $artist){?>
                
                <input type="checkbox" name="artists[]" value="<?php echo $artist->getId()?>"><?php echo $artist->getName()?>
                   <br> 
                <?php }?>
                    </div>
                    <div class="col-4 pt-2">
                    Lugar:<select name="placeId">
                <?php 
                foreach ($eventPlaceList as $eventPlace){?>
                <br>
                    <option value="<?php echo $eventPlace->getId()?>"><?php echo $eventPlace->getName()?></option>
                <?php }?>
            </select> <br>
            Evento: 
            <select name="eventId">
                <?php 
                foreach ($eventsList as $event){?>
                    <option value="<?php echo $event->getId()?>"><?php echo $event->getTitle()?></option>
                <?php }?>
            </select>
         
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
                    <th scope="col">artista</th>
                    <th scope="col">evento</th>
                    <th scope="col">Lugar</th>
                    <th scope="col">fecha</th>
                    <th scope="col" class="col-md-1"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(isset($calendarList)) {
                    foreach($calendarList as $calendar)
                    {
            ?>
                        <tr>
                            <th scope="row"><?php echo $calendar->getId() ?></th>
                            <?php $artistList = $calendar->getArtist();?>
                                            <td>
                                            <select name="eventId">
                                            <?php 
                                                foreach ($artistList as $artist){?>
                                                    <option><?php echo $artist->getName();?></option>
                                            <?php }?>
                                            </select>
                                            </td>
                                            <td><?php echo $calendar->getEvent()->getTitle();?></td>
                                            <td><?php echo $calendar->getEventPlace()->getName();?></td>
                                            <td><?php echo $calendar->getDate();?></td>
                            <td> <a href="<?php echo FRONT_ROOT ?>eventPlace/delete/<?php echo $event->getId() ?>"><img src="<?php echo IMG_PATH ?>extranetArtist/trash.png"></a></td>
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