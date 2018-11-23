<?php 
    if($_SESSION['adminLogged']){
        require_once("extranetNav.php");
    } else {
        require_once("extranetLogin.php");
    }
?>