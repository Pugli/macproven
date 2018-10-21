<?php
    namespace Dao;

    use Model\Artist as Artist;
    use Model\EventPlace as EventPlace;
    use Model\Event as Event;
    use Model\Calendar as Calendar;
    use Dao\IDaoCalendar as IDaoCalendar;
    use \Exception as Exception;
    use Dao\Connection as Connection;
    use Dao\DaoArtistPdo as DaoArtistPdo;
    use Dao\DaoEventPdo as DaoEventPdo;
    use Dao\DaoEventPlacePdo as DaoEventPlacePdo;
    
    class DaoCalendarPdo implements IDaoCalendar{
        private $connection;
        private $tableName = "calendars";
        private $daoArtist;
        private $daoEvent;
        private $daoEventPlace;

        public function __construct()
        {
            $this->daoArtist = new DaoArtistPdo();
            $this->daoEvent = new DaoEventPdo();
            $this->daoEventPlace = new DaoEventPlacePdo();
        }

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

                $query = "SELECT * FROM " . $this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row){
                    $calendar = new Calendar();
                    $calendar->setId($row["id_calendar"]);
                    $calendar->setDate($row["dateevent"]);
                    $calendar->setArtist($this->daoArtist->checkArtistById($row["fk_id_artist"]));
                    $calendar->setEvent($this->daoEvent->checkEventById($row["fk_id_event"]));
                    $calendar->setEventPlace($this->daoEventPlace->checkEventPlaceById($row["fk_id_eventplace"]));
                     
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

                $query = "SELECT * FROM ".$this->tableName." WHERE id_calendar = :calendar";

                $parameters["calendar"] = $calendarId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $calendar = new Calendar();
                    $calendar->setId($row["id_calendar"]);
                    $calendar->setDate($row["dateEvent"]);
                    $calendar->setArtist($this->daoArtist->checkArtistById($row["fk_id_artist"]));
                    $calendar->setEvent($this->daoEvent->checkEventById($row["fk_id_event"]));
                    $calendar->setEventPlace($this->daoEventPlace->checkEventPlaceById($row["fk_id_eventplace"]));
                }
                return $category;
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