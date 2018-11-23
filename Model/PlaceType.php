<?php
    namespace Model;

    class PlaceType{
        private $description;
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

        public function setDescription($description)
        {
            $this->description = $description;
        }

        public function getDescription()
        {
            return $this->description;
        }
    }
?>