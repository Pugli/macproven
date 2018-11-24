<?php
    namespace controllers;

    use Model\EventSeat as EventSeat;
    use dao\DaoCalendarPdo as DaoCalendarPdo;
    use dao\DaoEventSeatPdo as DaoEventSeatPdo;
    use dao\DaoPlaceTypePdo as DaoPlaceTypePdo;
    use dao\DaoEventPlacePdo as DaoEventPlacePdo;
    use dao\DaoPurchaseLinePdo as DaoPurchaseLinePdo; 

    class ControllerEventSeat {
        private $daoCalendar;
        private $daoEventSeat;
        private $daoPlaceType;
        private $daoEventPlace;
        private $daoPurchaseLines;

        public function __construct(){
            $this->daoCalendar = new DaoCalendarPdo;
            $this->daoEventSeat = new DaoEventSeatPdo;
            $this->daoPlaceType = new DaoPlaceTypePdo;
            $this->daoEventPlace = new DaoEventPlacePdo;
            $this->daoPurchaseLines = new DaoPurchaseLinePdo;
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

            if ($this->daoEventSeat->getEventSeatByCalendarAndPlaceType($calendarId,$placeTypeId) == false){
            
                if($this->daoCalendar->checkCalendarById($calendarId) != null && $this->daoPlaceType->checkPlaceTypeById($placeTypeId) != null){
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
            }else{
                echo "<script> if(alert('Ya hay entradas de este tipo para el calendario')); </script>";
            }
            $this->showEventSeatList();
        }

        public function delete($eventSeatId){
            if($this->daoPurchaseLines->checkPurchasesByEventSeat($eventSeatId)){
                $this->daoEventSeat->delete($eventSeatId);
            }else{
                echo "<script> if(alert('Ya hay entradas vendidas. Imposible eliminar la plaza evento')); </script>";
            }
           
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