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
        private $tableNameArtistXCalendars = "artistsXCalendars";

        private function generalQuery()
        {
            return "SELECT ep.quantity AS quantityEventPlace,
            ep.name AS nameEventPlace,
            ep.id_eventPlace AS idEventPlace,
            e.title AS titleEvent,
            cl.id_calendar AS idCalendar,
            cl.dateevent AS dateEventCalendar,
            ct.category AS nameCategory,
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
            //ORDER BY ac.pfk_id_calendar";
        }

        public function add(Calendar $calendar)
        {
            try{
                $query = "INSERT INTO " . $this->tableName . " (dateevent,fk_id_eventplace, fk_id_event) VALUES (:dateevent, :fk_id_eventplace, :fk_id_event)";
                $parameters["dateevent"] = $calendar->getDate();
                $parameters["fk_id_eventplace"] = $calendar->getEventPlace()->getId();
                $parameters["fk_id_event"] = $calendar->getEvent()->getId();
    
                $this->connection = Connection::GetInstance();
    
                $this->connection->ExecuteNonQuery($query, $parameters);

                $lastId = $this->connection->getLastId();

                $artistList = $calendar->getArtist();

                foreach($artistList as $artist){
                    $parameters = array();
                    
                    $query = "INSERT INTO " . $this->tableNameArtistXCalendars . " (pfk_id_calendar, pfk_id_artist) VALUES (:pfk_id_calendar, :pfk_id_artist);";
                    $parameters["pfk_id_calendar"] = $lastId;
                    $parameters['pfk_id_artist'] = $artist->getId();
    
                    $this->connection->ExecuteNonQuery($query, $parameters);
                } 
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        private function generateCalendar($resultSet)
        {
            $calendarList = array();
            $lastId = 0;

            foreach ($resultSet as $row){

                $idCalendar = ($row["idCalendar"]);               

                if($lastId != $idCalendar){
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
            try{
                $calendarList = array();

                $query = $this->generalQuery() . " ORDER BY ac.pfk_id_calendar";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                $calendarList = $this->generateCalendar($resultSet);

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

                $query = $this->generalQuery() . " WHERE id_calendar = :calendar";

                $parameters["calendar"] = $calendarId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                $calendarList = $this->generateCalendar($resultSet);

                return $calendarList[0];
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