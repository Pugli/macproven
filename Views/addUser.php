<?php
include_once VIEWS_PATH."header.php";
include_once VIEWS_PATH."nav.php";

?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Usuario</h2>

               <form action="<?php echo FRONT_ROOT; ?>User/addUser" method="POST" class="bg-light-alpha p-5">
                    <div class="">
                    <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre de usuario</label>
                                   <input type="text" name="nickname" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="text" name="email" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Contraseña</label>
                                   <input type="password" name="password" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Confirmar Contraseña</label>
                                   <input type="password" name="passwordConfirm" value="" class="form-control">
                              </div>
                         </div>
                         <?php if (isset($_SESSION['userLogged'])){ ?>
                         <div class="col-lg-4">
                         <div class="form-group">
                                   <label for="">Permiso: </label>
                                   <input type="radio" name="permission" value="0"> Cliente
                                   <input type="radio" name="permission" value="1"> Administrador
                              </div>
                         </div>
                         <?php } else {
                             ?> <input type="hidden" name="permission" value="0"> <?php
                         } ?>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>

<?php include('footer.php') ?>
