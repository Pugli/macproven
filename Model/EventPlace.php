<?php
    namespace Model;


    class EventPlace{
        private $name;
        private $quantity;
        private $id;

        public function setName($name)
        {
            $this->name = $name;
        }

        public function getName()
        {
            return $this->name;
        }

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