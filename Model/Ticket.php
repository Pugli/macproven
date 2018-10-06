<?php
    namespace Model;

    class Ticket{
        private $number;
        private $id;

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setNumber($number)
        {
            $this->number = $number;
        }

        public function getNumber()
        {
            return $this->number;
        }
    }
?>