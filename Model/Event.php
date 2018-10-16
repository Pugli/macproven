<?php
    namespace Model;

    class Event{
        private $title;
        private $id;
        private $category;

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setTitle($title)
        {
            $this->title = $title;
        }

        public function getTitle()
        {
            return $this->title;
        }

        public function setCategory($category)
        {
            $this->category = $category;
        }

        public function getCategory()
        {
            return $this->category;
        }


    }
?>