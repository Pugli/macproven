<?php
namespace dao;

use dao\Connection as Connection;
use dao\IDaoPurchaseLine as IDaoPurchaseLine;
use Model\Artist as Artist;
use Model\Calendar as Calendar;
use Model\Category as Category;
use Model\Event as Event;
use Model\EventPlace as EventPlace;
use Model\EventSeat as EventSeat;
use Model\PlaceType as PlaceType;
use Model\PurchaseLine as PurchaseLine;
use \Exception as Exception;

class DaoPurchaseLinePdo implements IDaoPurchaseLine
{
    private $connection;
    private $tableName = 'purchaseLines';
    private $tableNameEventSeats = "EVENTSEATS";
    private $tableNameCalendars = "CALENDARS";
    private $tableNameArtists = "ARTISTS";
    private $tableNameEvents = "EVENTS";
    private $tableNameEventPlaces = "EVENTPLACES";
    private $tableNamePlaceType = "PLACETYPE";
    private $tableNameArtistsXCalendars = "artistsXCalendars";
    private $tableNameCategory = "categories";

    public function add(PurchaseLine $purchaseLine, $idPurchase)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (fk_id_eventseat, quantity, price, fk_id_purchase) VALUES (:idEventSeat, :quantity, :price, :idPurchase)";

            $parameters['idEventSeat'] = $purchaseLine->getEventSeat()->getId();
            $parameters['quantity'] = $purchaseLine->getQuantity();
            $parameters['price'] = $purchaseLine->getPrice();
            $parameters['idPurchase'] = $idPurchase;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getLastPurchaseLine()
    {
        try {
            $this->connection = Connection::GetInstance();

            return $this->getById($this->connection->getLastId());
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    private function generatePurchaseLine($resultSet)
    {

        $purchaseLineList = array();
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

                $purchaseLine = new PurchaseLine();
                $purchaseLine->setQuantity($row['quantityPurchaseLine']);
                $purchaseLine->setPrice($row['pricePurchaseLine']);
                $purchaseLine->setId($row['idPurchaseLine']);
                $purchaseLine->setEventSeat($eventSeat);

                array_push($purchaseLineList, $purchaseLine);
            }
            $artist = new Artist();
            $artist->setName($row['nameArtist']);

            $calendarResult = $purchaseLineList[(count($purchaseLineList)) - 1]->getEventSeat()->getCalendar();
            $calendarResult->addArtist($artist);
        }
        return $purchaseLineList;
    }

    public function getById($id)
    {
        try {
            $query = "SELECT ep.quantity AS quantityEventPlace,
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
            pu.quantity as quantityPurchaseLine,
            pu.price as pricePurchaseLine,
            pu.id_purchaseline as idPurchaseLine,
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
                ON es.fk_id_placeType = pt.id_placetype
            INNER JOIN " . $this->tableName . " as pu
                ON es.id_eventseat = pu.fk_id_eventseat
            WHERE pu.id_purchaseLine = :id";

            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $purchaseLineList = array();

            $purchaseLineList = $this->generatePurchaseLine($resultSet);

            return reset($purchaseLineList);

        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
