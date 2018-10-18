<?php
    namespace controllers;

    use Dao\DaoEventPlacePdo as DaoEventPlacePdo;
    use Model\EventPlace as EventPlace;

    class ControllerEventPlace{
        private $daoEventPlaces;

        public function __construct()
        {
            $this->daoEventPlaces = new DaoEventPlacePdo();
        }

        public function index()
        {
            $this->showEventPlaceList();
        }

        public function showAddEventPlace()
        {
            require_once(VIEWS_PATH . "addEventPlace.php");
        }

        public function showEventPlaceList()
        {
            require_once(VIEWS_PATH . "eventPlaceList.php");
        }

        public function addEventPlace($name, $quantity){
            
            if ($this->daoEventPlaces->checkEventPlace($name) == null){
                $newEventPlace = new EventPlace();
                $newEventPlace->setName($name);
                $newEventPlace->setQuantity($quantity);
                $this->daoEventPlaces->add($newEventPlace);
                echo "<script> if(alert('Nuevo Lugar ingresado!'));</script>";
            }
            else{

                echo "<script> if(alert('El lugar Ya existe'));</script>";
            }
            $this->showEventPlaceList();
        }

        public function delete($idEventPlace){
            $this->daoEventPlaces->delete($idEventPlace);
            $this->showEventPlaceList();
        }

        public function getAll(){
            return $this->daoEventPlaces->getAll();
        }
    }

?>