<?php 

include("lib/qrcode/qrlib.php");

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
                         <th>Nombre</th>
                         <th>Modificar Nombre</th>
                         <th>Eliminar</th>
                    </thead>
                    <tbody>
                    
                        <?php
                            if(isset($artistList))
                            {
                                foreach($artistList as $artist)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $artist->getName() ?></td>
                                            <td>
                                            <form method='post' action='<?php echo FRONT_ROOT ?>artist/changename'>
                                             <input type='hidden' name='id' value="<?php echo $artist->getId(); ?>">
                                             <input type='text' name='name'>
                                             <input type='submit' name='button' value='Modificar'>
                                             </form>
                                            </td>
                                            <td> <a href="<?php echo FRONT_ROOT ?>artist/delete/<?php echo $artist->getId() ?>"><img src="<?php echo IMG_PATH ?>trash.png" width="20" heigth="20"></a></td>

                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    
                    </tbody>
               </table>
          </div>
     </section>
