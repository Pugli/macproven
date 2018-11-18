<?php namespace View;

    use controllers\ControllerUser as ControllerUser;

    $controller = new ControllerUser();

    $userList = $controller->getAll();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Usuarios</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Id</th>
                         <th>Email</th>
                         <th>Nombre de Usuario</th>
                         <th>Permisos</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($userList))
                            {
                                foreach($userList as $user)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $user->getIdUser() ?></td>
                                            <td><?php echo $user->getEmail() ?></td>
                                            <td><?php echo $user->getNickName() ?></td>
                                            <td><?php echo ($user->getIsAdmin() == 0 ? "Cliente" : "Administrador") ?></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>