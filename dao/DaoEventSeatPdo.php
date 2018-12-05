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
use \Exception as Exception;

class DaoEventSeatPdo implements IDaoEventSeatPdo
{

    private $connection;
    private $tableNameEventSeats = "EVENTSEATS";
    private $tableNameCalendars = "CALENDARS";
    private $tableNameArtists = "ARTISTS";
    private $tableNameEvents = "EVENTS";
    private $tableNameEventPlaces = "EVENTPLACES";
    private $tableNamePlaceType = "PLACETYPE";
    private $tableNameArtistsXCalendars = "artistsXCalendars";
    private $tableNameCategory = "categories";
    private $tableNamePurchase = 'purchases';
    private $tableNamePurchaseLine = 'purchaseLines';

    public function generalQuery()
    {
        return "SELECT ep.quantity AS quantityEventPlace,
            ep.name AS nameEventPlace,
            es.id_eventSeat AS idEventSeat,
            es.quantity AS quantityEventSeat,
            es.price AS priceEventSeat,
            ep.id_eventPlace AS idEventPlace,
            e.title AS titleEvent,
            cl.id_calendar AS idCalendar,
            cl.dateevent AS dateEventCalendar,
            ct.category AS nameCategory,
            pt.description AS descriptionPlaceType,
            a.name AS nameArtist
            FROM " . $this->tableNameArtistsXCalendars . " AS ac
            INNER JOIN " . $this->tableNameCalendars . " AS cl
                ON ac.pfk_id_calendar = cl.id_calendar
            INNER JOIN " . $this->tableNameArtists . " AS a
                ON ac.pfk_id_artist = a.id_artist
            INNER JOIN " . $this->tableNameEventPlaces . " AS ep
                ON cl.fk_id_eventplace = ep.id_eventPlace
            INNER JOIN " . $this->tableNameEvents . " AS e
                ON cl.fk_id_event = e.id_event
            INNER JOIN " . $this->tableNameCategory . " AS ct
                ON e.fk_category = ct.id_category
            INNER JOIN " . $this->tableNameEventSeats . " AS es
                ON es.fk_id_calendar = cl.id_calendar
            INNER JOIN " . $this->tableNamePlaceType . " AS pt
                ON es.fk_id_placeType = pt.id_placetype";
    }

    private function generateEventSeat($resultSet)
    {
        $eventSeatList = array();
        $lastIdCalendar = 0;
        $lastIdEventSeat = 0;

        foreach ($resultSet as $row) {

            $idCalendar = ($row["idCalendar"]);
            $idEventSeat = ($row["idEventSeat"]);

            if ($lastIdEventSeat != $idEventSeat) {

                $lastIdEventSeat = $row["idEventSeat"];
                $eventPlace = new EventPlace();
                $eventPlace->setName($row['nameEventPlace']);
                $eventPlace->setQuantity($row['quantityEventPlace']);

                $category = new Category();
                $category->setDescription($row['nameCategory']);

                $event = new Event();
                $event->setTitle($row['titleEvent']);
                $event->setCategory($category);

                $calendar = new Calendar();
                $calendar->setId($row['idCalendar']); //
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

                array_push($eventSeatList, $eventSeat);
            }
            $artist = new Artist();
            $artist->setName($row['nameArtist']);

            $calendarResult = $eventSeatList[(count($eventSeatList)) - 1]->getCalendar();
            $calendarResult->addArtist($artist);
        }
        return $eventSeatList;
    }

    public function add(EventSeat $eventSeat)
    {
        try {
            $query = "INSERT INTO " . $this->tableNameEventSeats . " (quantity, price, fk_id_calendar, fk_id_placetype) VALUES (:quantity, :price, :fk_id_calendar, :fk_id_placetype)";
            $parameters["quantity"] = $eventSeat->getQuantityAvailable();
            $parameters["price"] = $eventSeat->getPrice();
            $parameters["fk_id_calendar"] = $eventSeat->getCalendar()->getId();
            $parameters["fk_id_placetype"] = $eventSeat->getPlaceType()->getId();

            $this->connection = Connection::getInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getAll()
    {
        try {

            $eventSeatList = array();

            $query = $this->generalQuery() . " ORDER BY ac.pfk_id_calendar,es.id_eventSeat";

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->Execute($query);

            $eventSeatList = $this->generateEventSeat($resultSet);

            return $eventSeatList;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getAllActives()
    {
        try {

            $eventSeatList = array();

            $query = $this->generalQuery() . " WHERE es.isActive = 1 ORDER BY ac.pfk_id_calendar,es.id_eventSeat";

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->Execute($query);

            $eventSeatList = $this->generateEventSeat($resultSet);

            return $eventSeatList;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getEventSeatById($idEventSeat)
    {
        try
        {
            $query = $this->generalQuery() . " WHERE es.id_eventSeat = :id_eventseat";

            $parameters["id_eventseat"] = $idEventSeat;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $eventSeatList = array();

            $eventSeatList = $this->generateEventSeat($resultSet);

            $eventSeat = reset($eventSeatList);

            return $eventSeat;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function quantityAvailable($idCalendar)
    {
        try {

            $query = "SELECT SUM(" . $this->tableNameEventSeats . ".quantity) AS QUANTITY FROM " . $this->tableNameEventSeats . " INNER JOIN " . $this->tableNameCalendars . " ON " . $this->tableNameEventSeats . ".fk_id_calendar = " . $this->tableNameCalendars . ".id_calendar WHERE " . $this->tableNameCalendars . ".id_calendar = :id_calendar";

            $parameters["id_calendar"] = $idCalendar;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                echo $row["QUANTITY"];
                $quantity = $row["QUANTITY"];
            }

            return $quantity;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getEventSeatByCalendarAndPlaceType($idCalendar, $idPlaceType)
    {
        try {
            $query = $this->generalQuery() . " WHERE FK_ID_CALENDAR = :idCalendar &&
            FK_ID_PLACETYPE = :idPlaceType";

            $parameters["idCalendar"] = $idCalendar;
            $parameters["idPlaceType"] = $idPlaceType;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $eventSeatList = array();

            $eventSeatList = $this->generateEventSeat($resultSet);

            $eventSeat = reset($eventSeatList);

            return $eventSeat;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getEventSeatByCalendar($idCalendar)
    {
        try {
            $query = $this->generalQuery() . " WHERE FK_ID_CALENDAR = :idCalendar ORDER BY ac.pfk_id_calendar,es.id_eventSeat";

            $parameters["idCalendar"] = $idCalendar;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $eventSeatList = array();

            $eventSeatList = $this->generateEventSeat($resultSet);

            return $eventSeatList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete($idEventSeat)
    {
        try {
            $query = "UPDATE " . $this->tableNameEventSeats . " SET isActive = 0 WHERE id_eventseat = :idEventSeat";

            $parameters['idEventSeat'] = $idEventSeat;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function checkEventSeatByPlaceType($idPlaceType)
    {
        try {
            $query = "SELECT * FROM " . $this->tableNameEventSeats . "
             INNER JOIN " . $this->tableNameCalendars . "
             ON fk_id_calendar = id_calendar
             WHERE isActive = 1 AND dateevent >= now() AND fk_id_placetype = :id";

            $parameters['id'] = $idPlaceType;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if ($resultSet) {
                $resultSet = true;
            } else {
                $resultSet = false;
            }

            return $resultSet;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function checkPurchasesByEventSeat($eventSeatId) // Dao EventSeat // TRUE O FALSE --

    {
        try {
            $query = "SELECT id_purchase FROM " . $this->tableNameEventSeats . "
            INNER JOIN " . $this->tableNamePurchaseLine . "
            ON fk_id_eventseat = id_eventseat
            INNER JOIN " . $this->tableNamePurchase . "
            ON fk_id_purchase = id_purchase
            WHERE fk_id_eventseat = :id";

            $parameters['id'] = $eventSeatId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if ($resultSet) {
                $resultSet = true;
            } else {
                $resultSet = false;
            }

            return $resultSet;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function changePrice($id, $price)
    {
        try {
            $query = 'UPDATE ' . $this->tableNameEventSeats . ' SET price = :price WHERE id_eventseat = :id';

            $parameters['price'] = $price;
            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
