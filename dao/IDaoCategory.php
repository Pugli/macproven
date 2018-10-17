<?php
    namespace dao;

    use Model\Category as Category;

    interface IDaoCategory{
        public function add(Category $category);
        public function delete($idCategory);
        public function getAll();
        public function checkCategory($categoryname);
        public function checkCategoryById($categoryId);
    }



?>