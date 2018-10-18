<?php 
namespace controllers;

use Dao\DaoPlaceTypePdo as DaoPlaceTypePdo;
use Model\PlaceType as PlaceType;

class controllerPlaceType{

    private $daoPlaceType;

    public function __construct()
    {
        $this->daoPlaceType = new DaoPlaceTypePdo;
    }

    public function index(){
        $this->showPlaceTypeList();
    }

    public function showAddPlaceType()
    {
        include_once VIEWS_PATH."addPlaceType.php";
    }
    
    public function showPlaceTypeList()
    {
        require_once VIEWS_PATH."PlaceTypeList.php";
    }

    public function addPlaceType($description)
    {
        if($this->daoPlaceType->checkDescription($description)==null){
        $PlaceType = new PlaceType();
        $PlaceType->setDescription($description);
        $this->daoPlaceType->add($PlaceType);
        }
        else{
            echo "<script> if(alert('el tipo de plaza ya existe'));</script>";
        }
        $this->showPlaceTypeList();
    }

    public function getAll()
    {
        return $this->daoPlaceType->getAll();
    }

    public function delete($idPlaceType)     
    {
        $this->daoPlaceType->delete($idPlaceType);
        $this->showPlaceTypeList();
    }
}