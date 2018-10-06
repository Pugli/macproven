<?php
    namespace Model;

    class Purchase{
        private $date;
        private $id;

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setDate($date)
        {
            $this->date = $date;
        }

        public function getDate()
        {
            return $this->date;
        }
    }
?>