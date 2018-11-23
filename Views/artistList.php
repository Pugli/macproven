<?php namespace View;

    use controllers\ControllerArtist as ControllerArtist;

    $controller = new ControllerArtist();

    $artistList = $controller->getAllActives();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de artistas</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Id</th>
                         <th>Nombre</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($artistList))
                            {
                                foreach($artistList as $artist)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $artist->getId() ?></td>
                                            <td><?php echo $artist->getName() ?></td>
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
               <h2 class="mb-4">Eliminar Artista</h2>

               <form method="post" action="<?php echo FRONT_ROOT ?>Artist/Delete" class="form-inline bg-light-alpha p-5">
                    <div class="form-group text-white">
                         <label for="">Id</label>
                         <input type="text" name="idArtist" value="" class="form-control ml-3">
                    </div>
                    <button type="submit" name="button" class="btn btn-danger ml-3">Eliminar</button>
               </form>
          </div>
     </section>
