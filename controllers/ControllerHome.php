<?php

    namespace controllers;

    class ControllerHome{

        public function index() 
        {
        	include_once VIEWS_PATH .'index.php';
        }


        public function login(){
            include_once VIEWS_PATH."login.php";
        }

    }


?>