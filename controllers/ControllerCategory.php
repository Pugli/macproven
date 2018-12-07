<?php

namespace controllers;

use dao\DaoCategoryPdo as DaoCategoryPdo;
use dao\DaoEventPdo as DaoEventPdo;
use Model\Category as Category;
use \Exception as Exception;

class ControllerCategory
{

    private $daoCategory;
    private $daoEvent;

    public function __construct()
    {
        $this->daoCategory = new DaoCategoryPdo;
        $this->daoEvent = new DaoEventPdo;
    }

    public function index()
    {
        $this->showCategoryList();
    }

    public function showAddCategory()
    {
        include_once VIEWS_PATH . 'addCategory.php';
    }

    public function showCategoryList()
    {
        include_once VIEWS_PATH . 'categoryList.php';

    }

    public function addCategory($category)
    {
        try {
            if($category != null)
            {
                if ($this->daoCategory->checkCategory($category) == null) {
                    $newCategory = new Category;
                    $newCategory->setDescription($category);
                    $this->daoCategory->add($newCategory);
                    echo "<script> if(alert('Nueva Categoria ingresada!'));</script>";
                } else {
    
                    echo "<script> if(alert('La Categoria Ya existe'));</script>";
                }
            }
            else {
                echo "<script> if(alert('Complete el nombre de la categoria'));</script>";
            }
            $this->showCategoryList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function checkCategoryById($categoryId)
    {
        try {
            return $this->daoCategory->checkCategoryById($categoryId);
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function delete($idCategory)
    {
        try {
            if ($this->daoEvent->checkEventByCategory($idCategory) == false) {
                $this->daoCategory->delete($idCategory);
            } else {
                echo "<script> if(alert('No se puede eliminar la categoria: Hay eventos que la contienen'));</script>";
            }
            $this->showCategoryList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAll()
    {
        try {
            return $this->daoCategory->getAll();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAllActives()
    {
        try {
            return $this->daoCategory->getAllActives();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function changeDescription($id, $description)
    {
        try
        {
            if ($this->daoEvent->checkEventByCategory($id) == false) {
                $this->daoCategory->changeName($id, $description);
            } else {
                echo "<script> if(alert('No se puede modificar la categoria: Hay eventos que la contienen'));</script>";
            }

            $this->index();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }
}
