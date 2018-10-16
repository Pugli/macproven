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
        $PlaceType = new PlaceType;
        $PlaceType->setDescription($description);
        $this->daoPlaceType->add($PlaceType);
        
    }

    public function showPlaceTypeList()
    {
        $list = $this->daoPlaceType->getAll();
    }
}