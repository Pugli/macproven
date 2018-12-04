<?php
namespace dao;

use dao\Connection as Connection;
use Model\Artist as Artist;
use Model\Calendar as Calendar;
use Model\Category as Category;
use Model\Event as Event;
use Model\EventPlace as EventPlace;
use Model\EventSeat as EventSeat;
use Model\PlaceType as PlaceType;
use Model\PurchaseLine as PurchaseLine;
use Model\Ticket as Ticket;
use \Exception as Exception;

class DaoTicketPdo
{
    private $connection;
    private $tableNameTicket = 'tickets';
    private $tableNamePurchase = 'purchases';
    private $tableNamePurchaseLine = 'purchaseLines';
    private $tableNameEventSeats = "EVENTSEATS";
    private $tableNameCalendars = "CALENDARS";
    private $tableNameEvents = "EVENTS";
    private $tableNameEventPlaces = "EVENTPLACES";
    private $tableNamePlaceType = "PLACETYPE";
    private $tableNameUser = 'users';

    public function add(Ticket $ticket)
    {
        try {
            $query = "INSERT INTO " . $this->tableNameTicket . " (fk_id_purchaseLine,qr) VALUES (:idPurchaseLine, :qr)";

            $parameters['idPurchaseLine'] = $ticket->getPurchaseLine()->getId();
            $parameters['qr'] = $ticket->getQr();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getTicketsFromClient($idUser)
    {
        try {
            $query = "SELECT
            ep.name AS nameEventPlace,
            e.title AS titleEvent,
            cl.dateevent AS dateEventCalendar,
            pu.price as pricePurchaseLine,
            pt.description,
            pr.datePurchase,
            t.qr
            FROM " . $this->tableNameTicket . " AS t
            INNER JOIN " . $this->tableNamePurchaseLine . " AS pu
            ON t.fk_id_purchaseline = pu.id_purchaseline
            INNER JOIN " . $this->tableNameEventSeats . "
            ON fk_id_eventseat = id_eventseat
            INNER JOIN " . $this->tableNamePlaceType . " AS pt
                ON fk_id_placetype = id_placetype
            INNER JOIN " . $this->tableNameCalendars . " AS cl
            ON fk_id_calendar = id_calendar
            INNER JOIN " . $this->tableNameEvents . " AS e
            ON fk_id_event = id_event
            INNER JOIN " . $this->tableNameEventPlaces . " AS ep
            ON ep.id_eventplace = fk_id_eventplace
            INNER JOIN " . $this->tableNamePurchase . " AS pr
            ON fk_id_purchase = id_purchase
            INNER JOIN " . $this->tableNameUser . "
            ON fk_id_user = id_user
            WHERE id_user = :id";

            $parameters['id'] = $idUser;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $ticketList = array();

            foreach ($resultSet as $row) {
                $eventPlace = new EventPlace();
                $eventPlace->setName($row['nameEventPlace']);

                $event = new Event();
                $event->setTitle($row['titleEvent']);

                $calendar = new Calendar();
                $calendar->setDate($row['dateEventCalendar']);
                $calendar->setEventPlace($eventPlace);
                $calendar->setEvent($event);

                $placeType = new PlaceType();
                $placeType->setDescription($row['description']);

                $eventSeat = new EventSeat();
                $eventSeat->setPlaceType($placeType);
                $eventSeat->setCalendar($calendar);

                $purchaseLine = new PurchaseLine();
                $purchaseLine->setPrice($row['pricePurchaseLine']);
                $purchaseLine->setEventSeat($eventSeat);

                $ticket = new Ticket();
                $ticket->setQr($row['qr']);
                $ticket->setPurchaseLine($purchaseLine);
                $ticket->setDateBought($row['datePurchase']);

                array_push($ticketList, $ticket);
            }

            return $ticketList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    private function generateTicket($resultSet)
    {
        $ticketList = array();
        $lastId = 0;

        foreach ($resultSet as $row) {

            $idCalendar = ($row["idCalendar"]);

            if ($lastId != $idCalendar) {
                $lastId = $row["idCalendar"];
                $eventPlace = new EventPlace();
                $eventPlace->setName($row['nameEventPlace']);
                $eventPlace->setQuantity($row['quantityEventPlace']);

                $category = new Category();
                $category->setDescription($row['nameCategory']);

                $event = new Event();
                $event->setTitle($row['titleEvent']);
                $event->setCategory($category);

                $calendar = new Calendar();
                $calendar->setId($row['idCalendar']);
                $calendar->setDate($row['dateEventCalendar']);
                $calendar->setEvent($event);
                $calendar->setEventPlace($eventPlace);

                $placeType = new PlaceType();
                $placeType->setDescription($row['descriptionPlaceType']);

                $eventSeat = new EventSeat;
                $eventSeat->setId($row["idEventSeat"]);
                $eventSeat->setQuantityAvailable($row["quantityEventSeat"]);
                $eventSeat->setPrice($row["priceEventSeat"]);
                $eventSeat->setCalendar($calendar);
                $eventSeat->setPlaceType($placeType);

                $purchaseLine = new PurchaseLine();
                $purchaseLine->setQuantity($row['quantityPurchaseLine']);
                $purchaseLine->setPrice($row['pricePurchaseLine']);
                $purchaseLine->setId($row['idPurchaseLine']);
                $purchaseLine->setEventSeat($eventSeat);

                $ticket = new Ticket();
                $ticket->setId($row['idTicket']);
                $ticket->setPurchaseLine($purchaseLine);
                $ticket->setQr($row["qr"]);

                array_push($ticketList, $ticket);
            }
            $artist = new Artist();
            $artist->setName($row['nameArtist']);

            $calendarResult = $ticketList[(count($ticketList)) - 1]->getPurchaseLine()->getEventSeat()->getCalendar();
            $calendarResult->addArtist($artist);
        }
        return $ticketList;
    }

    public function ticketsSold($idEventSeat)
    {
        try {
            $query = "SELECT count(id_ticket) as quantityTickets FROM " . $this->tableNameEventSeats .
            " INNER JOIN " . $this->tableNamePurchaseLine .
            " ON id_eventseat = fk_id_eventseat
                          INNER JOIN " . $this->tableNameTicket .
                " ON fk_id_purchaseLine = id_purchaseLine
                          WHERE id_eventseat = :id";

            $parameters['id'] = $idEventSeat;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $row = reset($resultSet);

            $quantity = $row['quantityTickets'];

            return $quantity;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
