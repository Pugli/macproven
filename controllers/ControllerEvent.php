<?php
namespace controllers;

use dao\DaoCalendarPdo as DaoCalendarPdo;
use dao\DaoCategoryPdo as DaoCategoryPdo;
use dao\DaoEventPdo as DaoEventPdo;
use Model\Event as Event;
use \Exception as Exception;

class ControllerEvent
{
    private $daoEvent;
    private $daoCategory;
    private $daoCalendar;

    public function __construct()
    {
        $this->daoEvent = new DaoEventPdo;
        $this->daoCategory = new DaoCategoryPdo;
        $this->daoCalendar = new DaoCalendarPdo;
    }

    public function index()
    {
        $this->showEventList();
    }

    public function showAddEvent()
    {
        include_once VIEWS_PATH . 'addEvent.php';
    }

    public function showEventList()
    {
        include_once VIEWS_PATH . 'eventlist.php';
    }

    public function addEvent($event, $categoryId, $file)
    {
        try {
            if (($this->daoEvent->checkEvent($event) == null) && ($this->daoCategory->checkCategoryById($categoryId) != null)) {

                $newEvent = new Event;

                if (!empty($file['name'])) 
                {
                    $newEvent = $this->setImage($newEvent, $file);
                    $newEvent->setTitle($event);
                    $newEvent->setCategory($this->daoCategory->checkCategoryById($categoryId));
                    $this->daoEvent->add($newEvent);
                    echo "<script> if(alert('Nuevo Evento Ingresado'));</script>";
                }
                else {
                    echo "<script> if(alert('Complete todos los datos'));</script>";
                }

            } else {

                echo "<script> if(alert('Evento no ingresado, Vuelva a intentar.'));</script>";
            }
            $this->showEventList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function delete($idEvent)
    {
        try {
            if ($this->daoCalendar->checkCalendarsFutureByEvent($idEvent) == false) {
                $this->daoEvent->delete($idEvent);
            } else {
                echo "<script> if(alert('No es posible borrar el evento. Hay fechas futuras'));</script>";
            }
            $this->showEventList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAll()
    {
        try {
            return $this->daoEvent->getAll();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAllActives()
    {
        try {
            return $this->daoEvent->getAllActives();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function showCheckEventForDate()
    {
        include_once VIEWS_PATH . "CheckEventForDate.php";
    }
    public function showCheck()
    {
        try {
            $arrayCategory = $this->daoCategory->getAllActives();
            include_once VIEWS_PATH . "queries.php";
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function checkEventForDate($date)
    {
        try {
            if (($arrayEvent = $this->daoEvent->checkEventForDateDao($date)) != null) {
                include_once VIEWS_PATH . "listEventSearched.php";
            }
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }

    }

    public function showCheckEventForCategory()
    {
        try {
            $arrayCategory = $this->daoCategory->getAllActives();
            include_once VIEWS_PATH . "CheckEventForCategory.php";
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function checkEventForCategory($id)
    {
        try {
            if (($arrayEvent = $this->daoEvent->checkEventForCategoryDao($id)) != null) {
                include_once VIEWS_PATH . "listEventSearched.php";
            }
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    private function setImage(Event $event, $file)
    {
        try {
            $fileName = $file["name"];
            $tempFileName = $file["tmp_name"];
            $type = $file["type"];

            $filePath = UPLOADS_PATH . basename($fileName);

            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            $imageSize = getimagesize($tempFileName);

            if ($imageSize !== false) {
                if (move_uploaded_file($tempFileName, $filePath)) {
                    $event->setNameImg($fileName);
                    return $event;
                } else {
                    echo "Error en la carga de la imagen";
                }

            } else {
                echo "El archivo no es una imagen";
            }

        } catch (Exception $e) {
            echo "<script> if(alert('Error en la carga de la imagen'));</script>";
        }

    }

    public function getEventById($eventId)
    {
        try {
            $event = $this->daoEvent->checkEventById($eventId);
            $calendarsForEvent = $this->daoCalendar->getCalendarForEvent($eventId);

            if($calendarsForEvent){
                include_once VIEWS_PATH . "showCalendarsForEvent.php";
            }
            else {
                echo "<script> if(alert('No hay fechas para este evento'));</script>";
                include_once VIEWS_PATH . "home.php";
            }
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function changeTittle($id, $tittle)
    {
        try {
            if ($this->daoCalendar->checkCalendarsFutureByEvent($id) == false) {
                $this->daoEvent->changeName($id, $tittle);
            } else {
                echo "<script> if(alert('No es posible cambiar el evento. Hay fechas futuras'));</script>";
            }
            $this->index();

        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function changeCategory($id, $idC)
    {

        try {

            if ($this->daoEvent->checkEventById($id) != null) {
                if ($this->daoCalendar->checkCalendarsFutureByEvent($idEvent) == false) {
                    $this->daoEvent->changeCategory($id, $idC);
                } else {
                    echo "<script> if(alert('No es posible cambiar el evento. Hay fechas futuras'));</script>";
                }
            } else {
                echo "<script> if(alert('no existe ese evento'));</script>";
            }
            $this->index();

        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }
    public function checkEventForArtist($id)
    {
        try {
            if (($arrayEvent = $this->daoEvent->checkEventForArtistDao($id)) != null) {
                include_once VIEWS_PATH . "listEventSearched.php";
            } else {
                echo "<script> if(alert('No existen eventos con ese artista'));</script>";
                include_once VIEWS_PATH . 'Searchs.php';
            }

        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }
}
