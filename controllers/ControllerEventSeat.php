<?php
    namespace controllers;

    use Model\EventSeat as EventSeat;
    use dao\DaoCalendarPdo as DaoCalendarPdo;
    use dao\DaoEventSeatPdo as DaoEventSeatPdo;
    use dao\DaoPlaceTypePdo as DaoPlaceTypePdo;
    use dao\DaoEventPlacePdo as DaoEventPlacePdo;

    class ControllerEventSeat {
        private $daoCalendar;
        private $daoEventSeat;
        private $daoPlaceType;
        private $daoEventPlace;

        public function __construct(){
            $this->daoCalendar = new DaoCalendarPdo;
            $this->daoEventSeat = new DaoEventSeatPdo;
            $this->daoPlaceType = new DaoPlaceTypePdo;
            $this->daoEventPlace = new DaoEventPlacePdo;
        }

        public function index(){
            $this->showEventSeatList();
        }

        public function showEventSeatList(){
            include_once VIEWS_PATH.'eventSeatList.php';
        }

        public function showAddEventSeat(){
            include_once VIEWS_PATH.'addEventSeat.php';
        }

        public function addEventSeat($calendarId,$placeTypeId,$quantity,$price){
            
            if($this->daoCalendar->checkCalendarById($calendarId) != null && $this->daoPlaceType->checkPlaceTypeById($placeTypeId) != null){
                var_dump($this->daoCalendar->checkCalendarById($calendarId));
                echo " hola";
                if((($this->daoEventPlace->checkEventPlaceById($this->daoCalendar->checkCalendarById($calendarId)->getEventPlace()->getId())->getQuantity()) - ($this->daoEventSeat->quantityAvailable($calendarId))) >= $quantity){

                    $newEventSeat = new EventSeat;

                    $newEventSeat->setCalendar($this->daoCalendar->checkCalendarById($calendarId));
                    $newEventSeat->setPlaceType($this->daoPlaceType->checkPlaceTypeById($placeTypeId));
                    $newEventSeat->setQuantityAvailable($quantity);
                    $newEventSeat->setRemaind($quantity);
                    $newEventSeat->setPrice($price);

                    $this->daoEventSeat->add($newEventSeat);
                    echo "<script> if(alert('Nuevo Plaza-Evento Ingresado')); </script>";
                }else{
                    echo "<script> if(alert('Cantidad Erronea de entradas')); </script>";
                }
            }else{
                echo "<script> if(alert('No se pudo ingresar la Plaza-Evento')); </script>";
            }
            $this->showEventSeatList();
        }

        public function delete($eventSeatId){
            $this->daoEventSeat->delete($eventSeatId);
            $this->showEventSeatList();
        }

        public function getAll(){
            return $this->daoEventSeat->getAll();
        }

        public function query()
        {
            echo $this->daoEventSeat->generalQuery();
        }
    }

    



?>