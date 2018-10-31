<?php
    namespace Dao;

    use Model\Artist as Artist;
    use Model\EventPlace as EventPlace;
    use Model\Event as Event;
    use Model\Calendar as Calendar;
    use Model\Category as Category;
    use Dao\IDaoCalendar as IDaoCalendar;
    use \Exception as Exception;
    use Dao\Connection as Connection;
    
    class DaoCalendarPdo implements IDaoCalendar{
        private $connection;
        private $tableName = "calendars";
        private $tableNameEventPlace = "eventplaces";
        private $tableNameCategory = "categories";
        private $tableNameEvent = "events";
        private $tableNameArtist = "artists";
       

        public function add(Calendar $calendar)
        {
            try{
                $query = "INSERT INTO " . $this->tableName . " (dateevent,fk_id_eventplace, fk_id_artist, fk_id_event) VALUES (:dateevent, :fk_id_eventplace, :fk_id_artist, :fk_id_event)";
                $parameters["dateevent"] = $calendar->getDate();
                $parameters["fk_id_eventplace"] = $calendar->getEventPlace()->getId();
                $parameters["fk_id_artist"] =  $calendar->getArtist()->getId();
                $parameters["fk_id_event"] = $calendar->getEvent()->getId();
    
                $this->connection = Connection::GetInstance();
    
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function getAll()
        {
            try{
                $calendarList = array();

                $query = "SELECT a.name AS nameArtist,
                ep.quantity AS eventPlaceQuantity,
                ep.name AS nameEventPlace,
                e.title AS titleEvent,
                cl.id_calendar AS idCalendar,
                cl.dateevent AS dateEventCalendar,
                ct.category AS nameCategory
                FROM " . $this->tableName . " AS cl
                INNER JOIN " . $this->tableNameEventPlace . " AS ep
                    ON cl.fk_id_eventplace = ep.id_eventplace
                INNER JOIN " . $this->tableNameEvent . " AS e
                    ON cl.fk_id_event = e.id_event
                INNER JOIN " . $this->tableNameCategory . " AS ct
                    ON e.fk_category = ct.id_category
                INNER JOIN " . $this->tableNameArtist . " AS a
                    ON cl.fk_id_artist = a.id_artist;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                $i = 0;

                foreach ($resultSet as $row){

                    $artist = new Artist();
                    $artist->setName($row["nameArtist"]);

                    $eventPlace = new EventPlace();
                    $eventPlace->setQuantity($row["eventPlaceQuantity"]);
                    $eventPlace->setName($row["nameEventPlace"]);

                    $category = new Category();
                    $category->setDescription($row["nameCategory"]);

                    $event = new Event();
                    $event->setTitle($row["titleEvent"]);
                    $event->setCategory($category);

                    $calendar = new Calendar();
                    $calendar->setId($row["idCalendar"]);
                    $calendar->setDate($row["dateEventCalendar"]);
                    $calendar->setArtist($artist);
                    $calendar->setEventPlace($eventPlace);
                    $calendar->setEvent($event);                   
                    
                    array_push($calendarList, $calendar);
                }

                return $calendarList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function checkCalendarById($calendarId){
            try
            {
                $calendar = null;

                $query = "SELECT a.name AS nameArtist,
                ep.id_eventPlace AS eventPlaceId,
                ep.quantity AS eventPlaceQuantity,
                ep.name AS nameEventPlace,
                e.title AS titleEvent,
                cl.id_calendar AS idCalendar,
                cl.dateevent AS dateEventCalendar,
                ct.category AS nameCategory
                FROM ". $this->tableName . " AS cl
                INNER JOIN " . $this->tableNameEventPlace . " AS ep
                    ON cl.fk_id_eventplace = ep.id_eventplace
                INNER JOIN " . $this->tableNameEvent . " AS e
                    ON cl.fk_id_event = e.id_event
                INNER JOIN " . $this->tableNameCategory . " AS ct
                    ON e.fk_category = ct.id_category
                INNER JOIN " . $this->tableNameArtist . " AS a
                    ON cl.fk_id_artist = a.id_artist 
                WHERE id_calendar = :calendar";

                $parameters["calendar"] = $calendarId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $artist = new Artist();
                    $artist->setName($row["nameArtist"]);

                    $eventPlace = new EventPlace();
                    $eventPlace->setId($row["eventPlaceId"]);
                    $eventPlace->setQuantity($row["eventPlaceQuantity"]);
                    $eventPlace->setName($row["nameEventPlace"]);

                    $category = new Category();
                    $category->setDescription($row["nameCategory"]);

                    $event = new Event();
                    $event->setTitle($row["titleEvent"]);
                    $event->setCategory($category);

                    $calendar = new Calendar();
                    $calendar->setId($row["idCalendar"]);
                    $calendar->setDate($row["dateEventCalendar"]);
                    $calendar->setArtist($artist);
                    $calendar->setEventPlace($eventPlace);
                    $calendar->setEvent($event);
                }
                return $calendar;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function delete($idCalendar)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE id_calendar = :idCalendar";
            
                $parameters["idCalendar"] = $idCalendar;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);   
            }
            catch(Exception $ex)
            {
                throw $ex;
            } 
        }


    }
?>