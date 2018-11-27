<?php
    namespace Model;

    use Model\Calendar as Calendar;
    use Model\PlaceType as PlaceType;

    class EventSeat{
        private $quantityAvailable;
        private $price;
        private $remaind;
        private $calendar;
        private $placeType;
        private $id; 
        private $active;

        public function getActive(){
            return $this->active;
        }

        public function setActive(Bool $active){
            $this->active = $active;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setQuantityAvailable($quantityAvailable)
        {
            $this->quantityAvailable = $quantityAvailable;
        }

        public function getQuantityAvailable()
        {
            return $this->quantityAvailable;
        }

        public function setPrice($price)
        {
            $this->price = $price;
        }

        public function getPrice()
        {
            return $this->price;
        }

        public function setRemaind($remaind)
        {
            $this->remaind = $remaind;
        }

        public function getRemaind()
        {
            return $this->remaind;
        }

        public function setCalendar(Calendar $calendar)
        {
            $this->calendar = $calendar;
        }

        public function getCalendar()
        {
            return $this->calendar;
        }

        public function setPlaceType(PlaceType $placeType)
        {
            $this->placeType = $placeType;
        }

        public function getPlaceType()
        {
            return $this->placeType;
        }
    }
?>