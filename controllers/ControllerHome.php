<?php

namespace controllers;

class ControllerHome
{

    public function index()
    {
        include_once VIEWS_PATH . 'Home.php';
    }

    public function login()
    {
        include_once VIEWS_PATH . "login.php";
    }

    public function extranet()
    {
        if (isset($_SESSION["userLogged"]) && $_SESSION["userLogged"]->getIsAdmin() == 1) {
            include_once VIEWS_PATH . "extranet.php";
        } else {
            echo "Ud. No tiene los permisos necesarios para ingresar al menu de administrador";
        }

    }

    public function searchs()
    {
        include_once VIEWS_PATH . 'Searchs.php';
    }

}
