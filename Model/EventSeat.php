<?php
    namespace Model;

    class EventSeat{
        private $quantityAvailable;
        private $price;
        private $remainder;
        private $id;

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setQuantityAvialable($quantityAvailable)
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

        public function setRemainder($remainder)
        {
            $this->remainder = $remainder;
        }

        public function getRemainder()
        {
            return $this->remainder;
        }
    }
?>