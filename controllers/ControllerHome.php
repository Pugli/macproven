<?php

    namespace controllers;

    class ControllerHome{

        public function index() 
        {
        	include_once VIEWS_PATH .'Home.php';
        }

        public function logout(){
            session_destroy();
            include_once VIEWS_PATH . 'Home.php';
        }

    }


?>