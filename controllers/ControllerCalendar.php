<?php
namespace controllers;

use Dao\DaoArtistPdo as DaoArtistPdo;
use dao\DaoCalendarPdo as DaoCalendarPdo;
use Dao\DaoEventPdo as DaoEventPdo;
use Dao\DaoEventPlacePdo as DaoEventPlacePdo;
use dao\DaoEventSeatPdo as DaoEventSeatPdo;
use Model\Calendar as Calendar;
use \Exception as Exception;

class ControllerCalendar
{

    private $daoCalendar;
    private $daoCategory;
    private $daoPlace;
    private $daoEvent;
    private $daoEventSeat;

    public function __construct()
    {
        $this->daoCalendar = new DaoCalendarPdo;
        $this->daoArtist = new DaoArtistPdo;
        $this->daoPlace = new DaoEventPlacePdo;
        $this->daoEvent = new DaoEventPdo;
        $this->daoEventSeat = new DaoEventSeatPdo();
    }

    public function index()
    {
        $this->showCalendarList();
    }

    public function showCalendarList()
    {
        include_once VIEWS_PATH . 'CalendarList.php';
    }

    public function showAddCalendar()
    {
        include_once VIEWS_PATH . 'addCalendar.php';
    }

    public function addCalendar($artists, $date, $placeId, $eventId, $file)
    {
        try {
            $flag = 0;
            foreach ($artists as $i) {
                if ($this->daoArtist->checkArtistById($i) == null) {
                    $flag = 1;
                }
            }

            if ($flag == 0 && $this->daoPlace->checkEventPlaceById($placeId) != null && $this->daoEvent->checkEventById($eventId) != null) {
                $newCalendar = new Calendar();

                if (!empty($file)) {
                    $newCalendarWithImg = $this->setImage($newCalendar, $file);
                }

                if ($newCalendarWithImg != null) {
                    $newCalendar = $newCalendarWithImg;
                }

                if ($date >= date('Y-m-d')) {
                    $newCalendar->setDate($date);
                    $newCalendar->setEventPlace($this->daoPlace->checkEventPlaceById($placeId));
                }

                foreach ($artists as $i) {
                    $newCalendar->addArtist($this->daoArtist->checkArtistById($i));
                }
                $newCalendar->setEvent($this->daoEvent->checkEventById($eventId));
                $this->daoCalendar->add($newCalendar);
                echo "<script> if(alert('Nuevo Calendario Ingresado'));</script>";
            } else {

                echo "<script> if(alert('Calendario no ingresado, Vuelva a intentar.'));</script>";
            }
            $this->showCalendarList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function delete($calendarId)
    {
        try {
            if ($this->daoCalendar->checkEventSeatByCalendar($calendarId) == false) {
                $this->daoCalendar->delete($calendarId);
            } else {
                echo "<script> if(alert('No es posible eliminar esta fecha. Hay entradas a la ventas'));</script>";
            }

            $this->showCalendarList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAll()
    {
        try {
            return $this->daoCalendar->getAll();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAllActives()
    {
        try {
            return $this->daoCalendar->getAllActives();
        } /*  */ catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function changeDate($id, $date)
    {
        try
        {
            if ($this->daoCalendar->checkEventSeatByCalendar($id) == false) {
                $this->daoCalendar->changeDate($id, $date);
            } else {
                echo "<script> if(alert('No es posible modificar esta fecha. Hay entradas a la ventas'));</script>";
            }
            $this->index();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    private function setImage(Calendar $calendar, $file)
    {
        $fileName = $file["name"];
        $tempFileName = $file["tmp_name"];
        $type = $file["type"];

        $filePath = UPLOADS_PATH . basename($fileName);

        $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        $imageSize = getimagesize($tempFileName);

        if ($imageSize !== false) {
            if (move_uploaded_file($tempFileName, $filePath)) {
                $calendar->setNameImg($fileName);
                return $calendar;
            } else {
                echo "Error en la carga de la imagen";
            }

        } else {
            echo "El archivo no es una imagen";
        }

    }

}
