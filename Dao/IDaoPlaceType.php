<?php
    namespace Dao;

    use Model\PlaceTyPE as PlaceType;    

    interface IDaoPlaceType{
        public function add(PlaceType $PlaceType);
        public function getAll();
        public function checkDescription($description);
       //public function delete($idCategory);
    }
 ?>