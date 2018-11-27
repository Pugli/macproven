<?php
    namespace controllers;

    use Dao\DaoEventPlacePdo as DaoEventPlacePdo;
    use Model\EventPlace as EventPlace;
    use dao\DaoCalendarPdo as DaoCalendarPdo;

    class ControllerEventPlace{
        private $daoEventPlaces;
        private $daoCalendar;

        public function __construct()
        {
            $this->daoEventPlaces = new DaoEventPlacePdo();
            $this->daoCalendar = new DaoCalendarPdo();
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
            if ($this->daoCalendar->checkCalendarByEventPlace($idEventPlace) == false){
                $this->daoEventPlaces->delete($idEventPlace);
            }else{
                echo "<script> if(alert('No es posible eliminar el Lugar, Hay fechas posteriores en el mismo'));</script>";
            }
            
            $this->showEventPlaceList();
        }

        public function getAll(){
            return $this->daoEventPlaces->getAll();
        }

        public function changeQuantity($id,$quantity)
        {
            try{
            if($this->daoEventPlaces->checkEventPlaceById($id) != null){
            $this->daoEventPlaces->changeQuantity($id,$quantity);
            }
            else{
                echo "<script> if(alert('no existe ese lugar'));</script>";
            }

        }
            catch(Exception $ex){
                echo "<script> if(alert('algo fallo'));</script>";
            }
        }
        public function changeName($id,$name)
        {
            try{
            if($this->daoEventPlaces->checkEventPlaceById($id) != null){
            $this->daoEventPlaces->changeName($id,$name);
            }
            else{
                echo "<script> if(alert('no existe ese lugar'));</script>";
            }

        }
            catch(Exception $ex){
                echo "<script> if(alert('algo fallo'));</script>";
            }
        }
    }

?>