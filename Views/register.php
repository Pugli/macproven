<title> Fazt - Registro </title>
<?php
    require_once("header.php");
    require_once("navbar.php");
?>
<body>
    <div class="container mt-5">
        <div>
            <h3 class="font-weight-bold">CREAR CUENTA</h3>
            <p>Todos los campos son obligatorios</p>
        </div>
        <hr>
        <form method="post" action="<?php echo FRONT_ROOT ?>User/AddUser">
            <div class="form-row">
                <div class="col-md-4">
                    <label class="campo-label"><span>Nombre</span></label>
                    <input class="form-control" type="text" name="NAME" value="" id="nameRegister" required>
                </div>
                <div class="col-md-4">
                    <label class="campo-label"><span>Email</span></label>
                    <input class="form-control" type="email" name="email" value="" id="nameRegister" required>
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col-md-4">
                    <label class="campo-label"><span>Contraseña</span></label>
                    <input class="form-control" type="password" name="password" value="" id="nameRegister" required>
                </div>
                <div class="col-md-4">
                    <label class="campo-label"><span>Confirmar Contraseña</span></label>
                    <input class="form-control" type="password" name="passwordConfirm" value="" id="nameRegister" required>
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
            <?php if(isset($message)) { echo $message; } ?>
            <div class="row">
                <div class="ml-2">
                    <button class="btn btn-dark" type="submit">Registrar</button>
                </div>
                <div class="ml-2">
                    <button class="btn btn-dark" type="reset">Limpiar Campos</button>
                </div>
            </div>
        </form>
        <hr>
    </div>
</body>