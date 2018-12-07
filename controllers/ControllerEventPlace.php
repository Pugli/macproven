<?php
namespace controllers;

use dao\DaoCalendarPdo as DaoCalendarPdo;
use Dao\DaoEventPlacePdo as DaoEventPlacePdo;
use Model\EventPlace as EventPlace;
use \Exception as Exception;

class ControllerEventPlace
{
    private $daoEventPlaces;
    private $daoCalendar;

    public function __construct()
    {
        $this->daoEventPlaces = new DaoEventPlacePdo();
        $this->daoCalendar = new DaoCalendarPdo();
    }

    public function index()
    {
        $this->showEventPlaceList();
    }

    public function showAddEventPlace()
    {
        require_once VIEWS_PATH . "addEventPlace.php";
    }

    public function showEventPlaceList()
    {
        require_once VIEWS_PATH . "eventPlaceList.php";
    }

    public function addEventPlace($name, $quantity)
    {
        try {
            if($name != null && $quantity != null && $quantity >= 0)
            {
                if ($this->daoEventPlaces->checkEventPlace($name) == null) {
                    $newEventPlace = new EventPlace();
                    $newEventPlace->setName($name);
                    $newEventPlace->setQuantity($quantity);
                    $this->daoEventPlaces->add($newEventPlace);
                    echo "<script> if(alert('Nuevo Lugar ingresado!'));</script>";
                } else {
    
                    echo "<script> if(alert('El lugar Ya existe'));</script>";
                }
            }
            else {
                echo "<script> if(alert('Complete todos los campos correctamente'));</script>";
            }
            $this->showEventPlaceList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function delete($idEventPlace)
    {
        try {
            if ($this->daoCalendar->checkCalendarByEventPlace($idEventPlace) == false) {
                $this->daoEventPlaces->delete($idEventPlace);
            } else {
                echo "<script> if(alert('No es posible eliminar el Lugar, Hay fechas posteriores en el mismo'));</script>";
            }

            $this->showEventPlaceList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAll()
    {
        try {
            return $this->daoEventPlaces->getAll();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAllActives()
    {
        try {
            return $this->daoEventPlaces->getAllActives();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function changeQuantity($id, $quantity)
    {
        try
        {
            if ($this->daoCalendar->checkCalendarByEventPlace($id) == false) {
                $this->daoEventPlaces->changeQuantity($id, $quantity);
            } else {
                echo "<script> if(alert('No es posible modifcar el Lugar, Hay fechas posteriores en el mismo o no existe'));</script>";
            }
            $this->index();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }
    public function changeName($id, $name)
    {
        try {
            if ($this->daoEventPlaces->checkEventPlaceById($id) != null) {
                $this->daoEventPlaces->changeName($id, $name);
            } else {
                echo "<script> if(alert('no existe ese lugar'));</script>";
            }
            $this->index();

        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }
}
