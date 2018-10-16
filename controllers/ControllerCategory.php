<?php

    namespace controllers;

    use Model\Category as Category;
    use dao\DaoCategoryPdo as DaoCategoryPdo;

    class ControllerCategory{

        private $daoCategory;

        public function __construct(){
            $this->daoCategory = new DaoCategoryPdo;
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

        public function delete($id){
            $this->DaoCategory->delete($idCategory);
            $this->showCategoryList();
        }

        public function getAll(){
            return $this->daoCategory->getAll();
        }

    }

?>