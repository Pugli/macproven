<?php
    namespace Controller;

    class ArtistController{

        public function newArtist($name)
        {
           if($this->isArtistName($name)){
               //agrega
           }
           else{
               //no agrega y retorna false o null
           }
        }

        
    }
?>