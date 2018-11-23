<?php
    namespace Model;


    class Artist{
        private $name;
        private $id;
        private $active;

        public function getActive(){
            return $this->active;
        }

        public function setActive(boolean $active){
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

        public function setName($name)
        {
            $this->name = $name;
        }

        public function getName()
        {
            return $this->name;
        }        
    }
?>