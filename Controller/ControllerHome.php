<?php

    namespace Controller;

    class ControllerHome{

        public function index() 
        {
        	include_once URL_THEME .'Home.php';
        }

        public function addArtist(){
            include_once URL_THEME . 'addArtist.php';
        }
    }


?>