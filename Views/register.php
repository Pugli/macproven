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
        <form method="post" action="<?php echo FRONT_ROOT ?>register/AddAccount">
            <div class="form-row">
                <div class="col-md-4">
                    <label class="campo-label"><span>Nombre</span></label>
                    <input class="form-control" type="text" name="NAME" value="" id="nameRegister" required>
                </div>
                <div class="col-md-4">
                    <label class="campo-label"><span>Apellido</span></label>
                    <input class="form-control" type="text" name="LASTNAME" value="" id="nameRegister" required>
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col-md-4">
                    <label class="campo-label"><span>Email</span></label>
                    <input class="form-control" type="email" name="MAIL" value="" id="nameRegister" required>
                </div>
                <div class="col-md-4">
                    <label class="campo-label"><span>Contraseña</span></label>
                    <input class="form-control" type="password" name="PASS" value="" id="nameRegister" required>
                </div>
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