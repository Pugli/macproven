<?php namespace View;

    use controllers\ControllerPlaceType as ControllerPlaceType;

    $controller = new ControllerPlaceType();

    $placeTypeList = $controller->getAllActives();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Tipos de Plaza</h2>
               <table class="table bg-light-alpha">
                    <thead>
        
                         <th>Tipo de Plaza</th>
                         <th>Modificar Plaza</th>
                         <th>Eliminar</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($placeTypeList))
                            {
                                foreach($placeTypeList as $placeType)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $placeType->getDescription() ?></td>
                                            <td>
                                            <form method='post' action='<?php echo FRONT_ROOT ?>placeType/changeDescription'>
                                             <input type='hidden' name='id' value="<?php echo $placeType->getId(); ?>">
                                             <input type='text' name='name'>
                                             <input type='submit' name='button' value='Modificar'>
                                             </form>
                                            </td>
                                            <td> <a href="<?php echo FRONT_ROOT ?>PlaceType/delete/<?php echo $placeType->getId() ?>"><img src="<?php echo IMG_PATH ?>trash.png" width="20" heigth="20"></a></td>
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
        <p class="text-center"><h2>Dar de alta un Tipo de Plaza</h2></p>
        <form action="<?php echo FRONT_ROOT; ?>PlaceType/addPlaceType"  method="post">
            <br>
            <td> Descripcion: <input type="text" name="description" required/> </td> 
            <td><input type="submit" value="Enviar" class="btn btn-info"/> </td>
        </form>
    </div>