<?php

    namespace controllers;

    class ControllerHome{

        public function index() 
        {
        	include_once VIEWS_PATH .'Home.php';
        }


        public function login(){
            include_once VIEWS_PATH."login.php";
        }

        public function prueba(){
            include_once VIEWS_PATH."prueba.php";
        }

    }


?>