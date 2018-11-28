<?php include_once VIEWS_PATH."header.php"?>

<main class="d-flex align-items-center justify-content-center height-100">
    <div class="content">
        <header class="text-center">
            <h2>MACPROVEN Y ASOCIADOS</h2>
            <p>INGRESO DE CREDENCIALES</p>
        </header>
        <form action ="<?php echo FRONT_ROOT; ?>User/Login" method="POST" class="login-form bg-dark-alpha p-5 text-white">
            <div class="form-group">
                    <label for="">Usuario</label>
                    <input type="text" name="user" class="form-control form-control-lg" placeholder="Ingresar usuario">
            </div>
            <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" name="pass" class="form-control form-control-lg" placeholder="Ingresar constraseña">
            </div>
            <button class="btn btn-dark btn-block btn-lg" type="submit">
                    Iniciar Sesión
            </button>
            <a href="<?php echo FRONT_ROOT; ?>User/showAddUser">¿No tiene cuenta? Cree una ahora mismo!</a>
        </form>
    </div>
</main>