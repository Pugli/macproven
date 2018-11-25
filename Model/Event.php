<?php
    namespace Model;

    use Model\Category as Category;

    class Event{
        private $title;
        private $id;
        private $category;
        private $active;
        private $nameImg;

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

        public function setTitle($title)
        {
            $this->title = $title;
        }

        public function getTitle()
        {
            return $this->title;
        }

        public function setCategory(Category $category)
        {
            $this->category = $category;
        }

        public function getCategory()
        {
            return $this->category;
        }

        public function getNameImg()
        {
            return $this->nameImg;
        }

        public function setnameImg($nameImg)
        {
            $this->nameImg = $nameImg;
        }     


    }
?>