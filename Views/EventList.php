<?php namespace View;

    use controllers\ControllerEvent as ControllerEvent;
    use controllers\ControllerCategory as ControllerCategory;

    $controllerEvent = new ControllerEvent();
    $controllerCategory = new ControllerCategory();

    $EventList = $controllerEvent->getAll();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Eventos</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Id</th>
                         <th>Tipo de evento</th>
                         <th>Categoria</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($EventList))
                            {
                                foreach($EventList as $Event)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $Event->getId() ?></td>
                                            <td><?php echo $Event->getTitle() ?></td>
                                            <td><?php echo $Event->getCategory()->getDescription() ?></td>
                                            <td><img src="<?php echo FRONT_ROOT.UPLOADS_PATH.$Event->getNameImg() ?>" width="50" height="50"></td>
                                            
                                            <form action="<?php echo FRONT_ROOT?>event/changeTittle" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $Event->getId() ?>">
                                            <td><input type="text" name="tittle"></td>
                                            <td><input class="btn btn-success ml-3" type="submit" value="cambiar"></td>
                                            </form>

            

                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>

     <!-- <section id="eliminar">
          <div class="container">
               <h2 class="mb-4">Eliminar Evento</h2>

               <form method="post" action="<?php echo FRONT_ROOT ?>Event/delete" class="form-inline bg-light-alpha p-5">
                    <div class="form-group text-white">
                         <label for="">Id</label>
                         <input type="text" name="idEvent" value="" class="form-control ml-3">
                    </div>
                    <button type="submit" name="button" class="btn btn-danger ml-3">Eliminar</button>
               </form>
          </div>
     </section> -->