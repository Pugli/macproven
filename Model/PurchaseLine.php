<?php

    namespace Model;

    class PurchaseLine{

        private $id;
        private $quantity;
        private $price;
        private $eventSeat;

        public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function setPrice($price){
            $this->price = $price;
        }

        public function getPrice(){
            return $this->price;
        }

        public function setQuantity($quantity){
            $this->quantity = $quantity;
        }

        public function getQuantity(){
            return $this->quantity;
        }

        public function setEventSeat(EventSeat $eventSeat){
            $this->eventSeat = $eventSeat;
        }

        public function getEventSeat(){
            return $this->eventSeat;
        }

        public function getTotal(){
            $total = ($this->quantity) * ($this->price);
            return $total;
            
        }


    }

?>