<?php
namespace Dao;

use Dao\Connection as Connection;
use Dao\IDaoCalendar as IDaoCalendar;
use Model\Artist as Artist;
use Model\Calendar as Calendar;
use Model\Category as Category;
use Model\Event as Event;
use Model\EventPlace as EventPlace;
use \Exception as Exception;

class DaoCalendarPdo implements IDaoCalendar
{
    private $connection;
    private $tableName = "calendars";
    private $tableNameEventPlace = "eventplaces";
    private $tableNameCategory = "categories";
    private $tableNameEvent = "events";
    private $tableNameArtist = "artists";
    private $tableNameArtistXCalendars = "artistsXCalendars";
    private $tableNameEventSeat = 'eventseats';
    private $tableNamePurchaseLines = 'purchaselines';
    private $tableNamePlaceType = 'placetype';

    private function generalQuery()
    {
        return "SELECT ep.quantity AS quantityEventPlace,
            ep.name AS nameEventPlace,
            ep.id_eventPlace AS idEventPlace,
            e.title AS titleEvent,
            cl.id_calendar AS idCalendar,
            cl.imagePath,
            cl.dateevent AS dateEventCalendar,
            ct.category AS nameCategory,
            cl.imagepath AS imagePath,
            a.name AS nameArtist
            FROM " . $this->tableNameArtistXCalendars . " AS ac
            INNER JOIN " . $this->tableName . " AS cl
                ON ac.pfk_id_calendar = cl.id_calendar
            INNER JOIN " . $this->tableNameArtist . " AS a
                ON ac.pfk_id_artist = a.id_artist
            INNER JOIN " . $this->tableNameEventPlace . " AS ep
                ON cl.fk_id_eventplace = ep.id_eventPlace
            INNER JOIN " . $this->tableNameEvent . " AS e
                ON cl.fk_id_event = e.id_event
            INNER JOIN " . $this->tableNameCategory . " AS ct
                ON e.fk_category = ct.id_category";
    }

    public function add(Calendar $calendar)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (dateevent,fk_id_eventplace, fk_id_event, imagepath) VALUES (:dateevent, :fk_id_eventplace, :fk_id_event, :imagepath)";
            $parameters["dateevent"] = $calendar->getDate();
            $parameters["fk_id_eventplace"] = $calendar->getEventPlace()->getId();
            $parameters["fk_id_event"] = $calendar->getEvent()->getId();
            $parameters["imagepath"] = $calendar->getNameImg();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            $lastId = $this->connection->getLastId();

            $artistList = $calendar->getArtist();

            foreach ($artistList as $artist) {
                $parameters = array();

                $query = "INSERT INTO " . $this->tableNameArtistXCalendars . " (pfk_id_calendar, pfk_id_artist) VALUES (:pfk_id_calendar, :pfk_id_artist);";
                $parameters["pfk_id_calendar"] = $lastId;
                $parameters['pfk_id_artist'] = $artist->getId();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    private function generateCalendar($resultSet)
    {
        $calendarList = array();
        $lastId = 0;

        foreach ($resultSet as $row) {

            $idCalendar = ($row["idCalendar"]);

            if ($lastId != $idCalendar) {
                $lastId = $row["idCalendar"];
                $eventPlace = new EventPlace();
                $eventPlace->setName($row['nameEventPlace']);
                $eventPlace->setQuantity($row['quantityEventPlace']);
                $eventPlace->setId($row['idEventPlace']);

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
                $calendar->setnameImg($row['imagePath']);

                array_push($calendarList, $calendar);
            }
            $artist = new Artist();
            $artist->setName($row['nameArtist']);

            $calendarResult = $calendarList[(count($calendarList)) - 1];
            $calendarResult->addArtist($artist);
        }
        return $calendarList;
    }

    public function getAll()
    {
        try {
            $calendarList = array();

            $query = $this->generalQuery() . " ORDER BY ac.pfk_id_calendar";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $calendarList = $this->generateCalendar($resultSet);

            return $calendarList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getAllActives()
    {
        try {
            $calendarList = array();

            $query = $this->generalQuery() . " WHERE cl.isActive = 1 ORDER BY ac.pfk_id_calendar";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $calendarList = $this->generateCalendar($resultSet);

            return $calendarList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function checkCalendarById($calendarId)
    {
        try
        {
            $calendar = null;

            $query = $this->generalQuery() . " WHERE id_calendar = :calendar";

            $parameters["calendar"] = $calendarId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $calendarList = $this->generateCalendar($resultSet);

            $firstElement = reset($calendarList);

            return $firstElement;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete($idCalendar)
    {
        try
        {
            $query = "UPDATE " . $this->tableName . " SET isActive = 0 WHERE id_calendar = :idCalendar ";

            $parameters["idCalendar"] = $idCalendar;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function checkCalendarByArtist($idArtist) // Dao Calendar // TRUE O FALSE -- AND FECHA FUTURA.

    {
        try {
            $query = "SELECT pfk_id_artist, dateevent FROM " . $this->tableNameArtistXCalendars . "
                          INNER JOIN " . $this->tableName .
                " ON pfk_id_calendar = id_calendar
                          WHERE pfk_id_artist = :id AND dateevent >= now() AND isActive = 1";

            $parameters['id'] = $idArtist;

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

    public function checkCalendarsFutureByEvent($idEvent) // Dao Calendar // TRUE O FALSE -- AND FECHA FUTURA.

    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " AS cl INNER JOIN " . $this->tableNameEvent . " ON fk_id_event = id_event WHERE id_event = :id AND dateevent >= now() AND cl.isActive = 1";

            $parameters['id'] = $idEvent;

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

    public function checkCalendarByEventPlace($idEventPlace) // DAO Calendar // TRUE O FALSE -- AND FECHA FUTURA.

    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " as cl INNER JOIN " . $this->tableNameEventPlace . " ON fk_id_eventPlace = id_eventPlace WHERE id_eventPlace = :id AND dateevent >= now() AND cl.isActive = 1";

            $parameters['id'] = $idEventPlace;

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

    public function checkEventSeatByCalendar($calendarId) // Dao Calendar // TRUE O FALSE -- AND FECHA FUTURA.

    {
        try {
            $query = "SELECT * FROM " . $this->tableNameEventSeat . " AS es
            INNER JOIN " . $this->tableName . "
            ON fk_id_calendar = id_calendar
            WHERE es.isActive = 1 AND id_calendar = :id AND dateevent >= now()";

            $parameters['id'] = $calendarId;

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

    public function getCalendarForEvent($eventId)
    {
        try {
            $query = $this->generalQuery() . ' WHERE e.id_event = :id AND dateevent >= now() AND cl.isActive = 1 ORDER BY ac.pfk_id_calendar';

            $parameters['id'] = $eventId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $calendarList = array();

            $calendarList = $this->generateCalendar($resultSet);

            return $calendarList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function checkCalendarByPlaceType($id)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " AS cl
            INNER JOIN " . $this->tableNameEventSeat . "
            ON fk_id_calendar = id_calendar
            INNER JOIN " . $this->tableNamePlaceType . "
            ON fk_id_placetype = id_placetype
            WHERE id_placetype = :id AND cl.isActive = 1 AND dateevent >= now()";

            $parameters['id'] = $id;

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

    public function changeDate($id, $date)
    {
        try {
            $query = 'UPDATE ' . $this->tableName . ' SET dateevent = :date WHERE id_calendar = :id';

            $parameters['date'] = $date;
            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
