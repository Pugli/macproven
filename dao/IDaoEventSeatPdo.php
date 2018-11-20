<?php
    namespace dao;

    use Model\EventSeat as EventSeat;

    interface IDaoEventSeatPdo{
        public function add(EventSeat $eventSeat);
        public function getAll();
        public function getEventSeatById($idEventSeat);
    }


?>