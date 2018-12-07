<?php
namespace controllers;

use dao\DaoCalendarPdo as DaoCalendarPdo;
use Dao\DaoPlaceTypePdo as DaoPlaceTypePdo;
use Model\PlaceType as PlaceType;
use \Exception as Exception;

class controllerPlaceType
{

    private $daoPlaceType;
    private $daoCalendar;

    public function __construct()
    {
        $this->daoPlaceType = new DaoPlaceTypePdo;
        $this->daoCalendar = new DaoCalendarPdo;
    }

    public function index()
    {
        $this->showPlaceTypeList();
    }

    public function showAddPlaceType()
    {
        include_once VIEWS_PATH . "addPlaceType.php";
    }

    public function showPlaceTypeList()
    {
        require_once VIEWS_PATH . "PlaceTypeList.php";
    }

    public function addPlaceType($description)
    {
        try {
            if($description != null)
            {
                if ($this->daoPlaceType->checkDescription($description) == null) {
                    $PlaceType = new PlaceType();
                    $PlaceType->setDescription($description);
                    $this->daoPlaceType->add($PlaceType);
                } else {
                    echo "<script> if(alert('el tipo de plaza ya existe'));</script>";
                }
            }
            else{
                echo "<script> if(alert('complete la Descripcion'));</script>";
            }
            $this->showPlaceTypeList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAll()
    {
        try {
            return $this->daoPlaceType->getAll();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAllActives()
    {
        try {
            return $this->daoPlaceType->getAllActives();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function delete($idPlaceType)
    {
        try {
            if ($this->daoCalendar->checkCalendarByPlaceType($idPlaceType) == false) {
                $this->daoPlaceType->delete($idPlaceType);
            } else {
                echo "<script> if(alert('No se puede eliminar el tipo de plaza. Hay fechas que las tienen asignadas.'));</script>";
            }

            $this->showPlaceTypeList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function changeDescription($id, $description)
    {
        try {
            if ($this->daoPlaceType->checkPlaceTypeById($id) != null) {
                $this->daoPlaceType->changeDescription($id, $description);
            } else {
                echo "<script> if(alert('no existe ese sitio'));</script>";
            }
            $this->index();

        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }
}
