<link rel="stylesheet" href="<?php echo CSS_PATH?>extranetLogin.css">

<body class="loginBack">
    <div>
        <h3 class="title"> <img src="<?php echo IMG_PATH?>/Navbar/logo.png" width="50px" height="50px"> FAZT - EXTRANET</h3>
    </div>
    <div class="container loginBox col-5">
        <div>
            <form class="form-group container" action="<?php echo FRONT_ROOT ?>User/Login" method="post">
                <div>
                    <label for="user">E-Mail :</label>
                    <input class="form-control" type="text" name="user" required>
                </div>
                <div>
                    <label class="mt-3" for="user">Contraseña :</label>
                    <input class="form-control" type="password" name="pass" required>
                </div>
                <?php if(isset($message)) { echo $message; } ?>
                <div>
                    <button class="btn btn-dark">Ingresar</button>
                </div>
                <hr>
            </form>
            <div>
            <a class="nav-link btn btn-dark botono" href="<?php echo FRONT_ROOT ?>">Ir a FAZT<a/>
            </div>
        </div>
    </div>
</body>