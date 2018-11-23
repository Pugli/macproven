<head>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>navbar.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo FRONT_ROOT?>"><img src="<?php echo IMG_PATH?>/Navbar/logo.png" width="50px" height="50px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a type="button" class="nav-link" href="<?php echo FRONT_ROOT?>">
                        <button class="btn btn-dark"> Inicio </button>
                    </a>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link" href="#">
                        <button class="btn btn-dark"> Eventos </button>
                    </a>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link" href="#">
                        <button class="btn btn-dark"> buscar por fecha </button>
                    </a>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link" href="#">
                        <button class="btn btn-dark"> buscar por categoria</button>
                    </a>
                    
                </li>
                <li>
                <a type="button" class="nav-link" href="#">
                        <button class="btn btn-dark"> buscar por artista</button>
                    </a>
                    </li>
            </ul>
            <?php if(isset($message)) { echo $message; } ?>
            <?php
                if(!isset($_SESSION['userLogged'])){
            ?>
                <button id="login-form" type="button" class="nav-link btn btn-light ml-1" data-container="body" data-toggle="popover" data-placement="bottom" title="Inicio de Sesión"
                data-content="
                            <form action='<?php echo FRONT_ROOT ?>user/login' method='post'>
                                
                                <div class='form-group'>
                                    <label for='exampleInputEmail1'>Direccion de E-Mail</label>
                                    <input name='mail' type='email' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='' required>
                                </div>
                                <div class='form-group'>
                                  <label for='exampleInputPassword1'>Contraseña</label>
                                  <input name='pass' type='password' class='form-control' id='exampleInputPassword1' value='' required>
                                </div>
                                <div class='d-flex'>
                                    <button type='submit' class='btn btn-dark'>Ingresar</button>
                            </form>
                                    <a class='nav-link btn btn-dark ml-1' href='<?php echo FRONT_ROOT ?>User/showAddUser'>Registrarse</a>
                                </div>
                              <div>
                                <a href=''> <img id='facebookLogin' src='<?PHP echo IMG_PATH ?>Register/facebookLogin.png'></a>
                                </div>
                            ">
                <div class="form-inline my-2 my-lg-0">
                    <img src="Img/Navbar/login.png" alt=""><span class="ml-2">Iniciar Sesión</span>
                </div>
            </button>
            <?php } else { ?>
                <a class="nav-link btn btn-light ml-1" href="<?php echo FRONT_ROOT ?>User/logout">Cerrar Sesión</a>
            <?php } ?>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script>$('[data-toggle="popover"]').popover({
            placement: "bottom",
            html: true
        });
    </script>
</body>
