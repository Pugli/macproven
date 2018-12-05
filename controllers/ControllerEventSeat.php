<?php
namespace controllers;

use dao\DaoCalendarPdo as DaoCalendarPdo;
use dao\DaoEventPlacePdo as DaoEventPlacePdo;
use dao\DaoEventSeatPdo as DaoEventSeatPdo;
use dao\DaoPlaceTypePdo as DaoPlaceTypePdo;
use dao\DaoPurchaseLinePdo as DaoPurchaseLinePdo;
use dao\DaoTicketPdo as DaoTicketPdo;
use Model\EventSeat as EventSeat;
use \Exception as Exception;

class ControllerEventSeat
{
    private $daoCalendar;
    private $daoEventSeat;
    private $daoPlaceType;
    private $daoEventPlace;
    private $daoPurchaseLines;
    private $daoTicket;

    public function __construct()
    {
        $this->daoCalendar = new DaoCalendarPdo;
        $this->daoEventSeat = new DaoEventSeatPdo;
        $this->daoPlaceType = new DaoPlaceTypePdo;
        $this->daoEventPlace = new DaoEventPlacePdo;
        $this->daoPurchaseLines = new DaoPurchaseLinePdo;
        $this->daoTicket = new DaoTicketPdo;
    }

    public function index()
    {
        $this->showEventSeatList();
    }

    public function showEventSeatList()
    {
        include_once VIEWS_PATH . 'eventSeatList.php';
    }

    public function showAddEventSeat()
    {
        include_once VIEWS_PATH . 'addEventSeat.php';
    }

    public function addEventSeat($calendarId, $placeTypeId, $quantity, $price)
    {
        try {

            for ($i = 0; $i < 5; $i++) {

                if (!empty($calendarId) && !empty($placeTypeId) && !empty($quantity) && !empty($price)) {

                    if ($this->daoEventSeat->getEventSeatByCalendarAndPlaceType($calendarId[$i], $placeTypeId[$i]) == false) {

                        if ($this->daoCalendar->checkCalendarById($calendarId[$i]) != null && $this->daoPlaceType->checkPlaceTypeById($placeTypeId[$i]) != null) {
                            if ($quantity[$i] > 0) {
                                if ((($this->daoEventPlace->checkEventPlaceById($this->daoCalendar->checkCalendarById($calendarId[$i])->getEventPlace()->getId())->getQuantity()) - ($this->daoEventSeat->quantityAvailable($calendarId[$i]))) >= $quantity[$i]) {

                                    $newEventSeat = new EventSeat;

                                    $newEventSeat->setCalendar($this->daoCalendar->checkCalendarById($calendarId[$i]));
                                    $newEventSeat->setPlaceType($this->daoPlaceType->checkPlaceTypeById($placeTypeId[$i]));
                                    $newEventSeat->setQuantityAvailable($quantity[$i]);
                                    $newEventSeat->setRemaind($quantity[$i]);
                                    $newEventSeat->setPrice($price[$i]);

                                    $this->daoEventSeat->add($newEventSeat);
                                    echo "<script> if(alert('Nuevo Plaza-Evento Ingresado')); </script>";
                                } else {
                                    echo "<script> if(alert('Cantidad Erronea de entradas')); </script>";
                                }
                            } else {
                                echo "<script> if(alert('La cantidad de entradas a dar de alta, debe ser mayor a 0')); </script>";
                            }
                        } else {
                            echo "<script> if(alert('No se pudo ingresar la Plaza-Evento')); </script>";
                        }
                    } else {
                        echo "<script> if(alert('Ya hay entradas de este tipo para el calendario')); </script>";
                    }
                } else {
                }
            }
            $this->showEventSeatList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function delete($eventSeatId)
    {
        try {
            if ($this->daoEventSeat->checkPurchasesByEventSeat($eventSeatId)) {
                $this->daoEventSeat->delete($eventSeatId);
            } else {
                echo "<script> if(alert('Ya hay entradas vendidas. Imposible eliminar la plaza evento')); </script>";
            }

            $this->showEventSeatList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAll()
    {
        try {
            $eventSeats = $this->daoEventSeat->getAll();
            foreach ($eventSeats as $eventSeat) {
                $eventSeat->setRemaind($eventSeat->getQuantityAvailable() - $this->daoTicket->ticketsSold($eventSeat->getId()));
            }
            return $eventSeats;
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAllActives()
    {
        try {
            $eventSeats = $this->daoEventSeat->getAllActives();
            foreach ($eventSeats as $eventSeat) {
                $eventSeat->setRemaind($eventSeat->getQuantityAvailable() - $this->daoTicket->ticketsSold($eventSeat->getId()));
            }
            return $eventSeats;
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function changePrice($id, $price)
    {
        try {
            if ($this->daoEventSeat->getEventSeatById($id) != null) {
                $this->daoEventSeat->changePrice($id, $price);
            } else {
                echo "<script> if(alert('no existe esa plaza'));</script>";
            }
            $this->index();

        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getEventSeatsByCalendar($calendarId)
    {
        try {
            $calendar = $this->daoCalendar->checkCalendarById($calendarId);
            $eventSeats = $this->daoEventSeat->getEventSeatByCalendar($calendarId);
            if (!empty($eventSeats)) {
                foreach ($eventSeats as $eventSeat) {
                    $eventSeat->setRemaind($eventSeat->getQuantityAvailable() - $this->daoTicket->ticketsSold($eventSeat->getId()));
                }
                include_once VIEWS_PATH . 'showEventSeatsForCalendar.php';
            } else {
                echo "<script> if(alert('No hay entradas a la venta!'));</script>";
                include_once VIEWS_PATH .'home.php';
            }
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    private function verifyIfNotNulls($calendarId, $placeTypeId, $quantity, $price)
    {
        if (!empty($calendarId) && !empty($placeTypeId) && !empty($quantity) && !empty($price)) {
            return true;
        } else {
            return false;
        }
    }

}
