<?php
    namespace Dao;

    use Model\Artist as Artist;    

    interface IDaoArtist{
        public function add(Artist $artist);
        public function getAll();
        public function isArtistName($name);
    }
 ?>
