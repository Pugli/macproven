<?php

    namespace controllers;

    use Model\Category as Category;
    use dao\DaoCategoryPdo as DaoCategoryPdo;
    use dao\DaoEventPdo as DaoEventPdo;

    class ControllerCategory{

        private $daoCategory;
        private $daoEvent;

        public function __construct(){
            $this->daoCategory = new DaoCategoryPdo;
            $this->daoEvent = new DaoEventPdo;
        }

        public function index(){
            $this->showCategoryList();
        }

        public function showAddCategory(){
            include_once VIEWS_PATH . 'addCategory.php';
        }

        public function showCategoryList(){
            include_once VIEWS_PATH . 'categoryList.php';
            
        }

        public function addCategory($category){
            
            if ($this->daoCategory->checkCategory($category) == null){
                $newCategory = new Category;
                $newCategory->setDescription($category);
                $this->daoCategory->add($newCategory);
                echo "<script> if(alert('Nueva Categoria ingresada!'));</script>";
            }
            else{

                echo "<script> if(alert('La Categoria Ya existe'));</script>";
            }
            $this->showCategoryList();

        }

        public function checkCategoryById($categoryId){
            return $this->daoCategory->checkCategoryById($categoryId);
        }

        public function delete($idCategory){
            if ($this->daoEvent->checkEventByCategory($idCategory) == false){
                $this->daoCategory->delete($idCategory); 
            }else{
                echo "<script> if(alert('No se puede eliminar la categoria: Hay eventos que la contienen'));</script>";
            }
            $this->showCategoryList();
        }

        public function getAll(){
            return $this->daoCategory->getAll();
        }

        public function getAllActives(){
            return $this->daoCategory->getAllActives();
        }
    }

?>