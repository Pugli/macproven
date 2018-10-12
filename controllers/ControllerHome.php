<?php

    namespace controllers;

    class ControllerHome{

        public function index() 
        {
        	include_once VIEWS_PATH .'Home.php';
        }

        public function addArtist(){
            include_once VIEWS_PATH . 'addArtist.php';
        }
    }


?>