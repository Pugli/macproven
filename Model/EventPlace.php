<?php
    namespace Model;


    class EventPlace{
        private $quantity;
        private $id;

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setQuantity($quantity)
        {
            $this->quantity = $quantity;
        }

        public function getQuantity()
        {
            return $this->quantity;
        }
    }
?>