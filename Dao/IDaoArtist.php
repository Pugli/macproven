<?php
    namespace Dao;

    use Model\Artist as Artist;    

    interface IDao{
        public function add(Artist $artist);
        public function getAll();
        public function checkArtist($name);
    }
 ?>