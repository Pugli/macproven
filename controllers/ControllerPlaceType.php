<?php 
namespace controllers;

use Dao\DaoPlaceTypePdo as DaoPlaceTypePdo;

class controllerPlaceType{

    private $daoPlaceType;

    public function __construct()
    {
        $this->daoPlaceType = new DaoPlaceTypePdo;
    }
    public function showAddPlaceType()
    {
        include_once VIEWS_PATH."addPlaceType.php";
    }

    public function addPlaceType($description)
    {
        if($this->daoPlaceType->checkDescription($description)==null){
        $PlaceType = new PlaceType;
        $PlaceType->setDescription($description);
        $this->daoPlaceType->add($PlaceType);
        }
        else{
            echo "<script> if(alert('el tipo de plaza ya existe'));</script>";
        }
        $this->showPlaceTypeList();
    }

    public function showPlaceTypeList()
    {
        $list = $this->daoPlaceType->getAll();
        require_once VIEWS_PATH."PlaceTypeList.php";
    }
    public function delete($id)     
    {
        $this->daoPlaceType->delete($id);
        $this->showPlaceTypeList();
    }
}