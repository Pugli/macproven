<?php
    namespace dao;

    use Model\EventSeat as EventSeat;
    use Model\Calendar as Calendar;
    use Model\PlaceType as PlaceType;
    use Model\Artist as Artist;
    use Model\EventPlace as EventPlace;
    use Model\Event as Event;
    use dao\Connection as Connection;
    use \Exception as Exception;

    class DaoEventSeatPdo implements IDaoEventSeatPdo{

        private $connection;
        private $tableNameEventSeats = "EVENTSEATS";
        private $tableNameCalendars = "CALENDARS";
        private $tableNameArtists = "ARTISTS";
        private $tableNameEvents = "EVENTS";
        private $tableNameEventPlaces = "EVENTPLACES";
        private $tableNamePlaceType = "PLACETYPE";
        private $tableNameArtistsXCalendars = "artistsXCalendars";
        private $tableNameCategory = "categories";

        public function generalQuery()
        {
            /* return "SELECT ES.ID_EVENTSEAT AS EVENTSEAT,
            ES.PRICE AS PRICE,
            ES.QUANTITY AS QUANTITY,
            ES.REMAINDER AS REMAINDER,
            C.DATEEVENT AS DATEEVENT,
            A.NAME AS ARTIST,
            EV.TITLE AS EVENTNAME,
            EP.NAME AS EVENTPLACE,
            PT.DESCRIPTION AS PLACETYPE
            FROM ".$this->tableNameEventSeats." ES
            INNER JOIN ".$this->tableNameCalendars." C
            ON ES.FK_ID_CALENDAR = C.ID_CALENDAR
            INNER JOIN ".$this->tableNameEvents." EV
            ON C.FK_ID_EVENT = EV.ID_EVENT
            INNER JOIN ".$this->tableNameEventPlaces."  EP
            ON C.FK_ID_EVENTPLACE = EP.ID_EVENTPLACE
            INNER JOIN ".$this->tableNamePlaceType." PT
            ON ES.FK_ID_PLACETYPE = PT.ID_PLACETYPE
            INNER JOIN " . $this->tableNameArtistsXCalendars . " AS AC
            ON ES.FK_ID_CALENDAR = AC.PFK_ID_CALENDAR
            INNER JOIN " . $this->tableNameArtists . " AS A
            ON AC.PFK_ID_ARTIST = A.ID_ARTIST"; */

            return "SELECT ep.quantity AS quantityEventPlace,
            ep.name AS nameEventPlace,
            es.id_eventSeat AS idEventSeat,
            es.quantity AS quantityEventSeat,
            es.price AS priceEventSeat,
            es.remainder AS remainderEventSeat,
            ep.id_eventPlace AS idEventPlace,
            e.title AS titleEvent,
            cl.id_calendar AS idCalendar,
            cl.dateevent AS dateEventCalendar,
            ct.category AS nameCategory,
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
            ORDER BY ac.pfk_id_calendar";
        }

        private function generateEventSeat($resultSet)
        {
            
            /* $calendarList = array(); */
            $lastId = 0;

            foreach ($resultSet as $row){

                $idCalendar = ($row["idCalendar"]);               

                if($lastId != $idCalendar){
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
                    $calendar->setId($row['idCalendar']);//
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
            

        }

        public function add(EventSeat $eventSeat){
            try{
                $query = "INSERT INTO ".$this->tableNameEventSeats." (quantity, price, remainder, fk_id_calendar, fk_id_placetype) VALUES (:quantity, :price, :remainder, :fk_id_calendar, :fk_id_placetype)";
                $parameters["quantity"] = $eventSeat->getQuantityAvailable();
                $parameters["price"] = $eventSeat->getPrice();
                $parameters["remainder"] = $eventSeat->getRemainder();
                $parameters["fk_id_calendar"] = $eventSeat->getCalendar()->getId();
                $parameters["fk_id_placetype"] = $eventSeat->getPlaceType()->getId();

                $this->connection = Connection::getInstance();

                $this->connection->ExecuteNonQuery($query, $parameters); 


            }catch (Exception $ex){
                throw $ex;
            }
        }

        public function getAll(){
            try{
                
                $eventSeatList = array();

                $query = $this->generalQuery();

                $this->connection = Connection::getInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row){
                    /* $artist = new Artist();
                    $artist->setName($row["ARTIST"]); */

                    /* $eventPlace = new EventPlace();
                    $eventPlace->setName($row["EVENTPLACE"]);

                    $event = new Event();
                    $event->setTitle($row["EVENTNAME"]); */

                    /* $calendar = new Calendar();
                    $calendar->setArtist($artist);
                    $calendar->setDate($row['DATEEVENT']);
                    $calendar->setEventPlace($eventPlace);
                    $calendar->setEvent($event); */

                    $placeType = new PlaceType();
                    $placeType->setDescription($row['PLACETYPE']);

                    $eventSeat = new EventSeat;
                    $eventSeat->setId($row["EVENTSEAT"]);
                    $eventSeat->setRemainder($row["REMAINDER"]);
                    $eventSeat->setQuantityAvailable($row["QUANTITY"]);
                    $eventSeat->setPrice($row["PRICE"]);
                    $eventSeat->setCalendar($calendar);
                    $eventSeat->setPlaceType($placeType);

                    array_push($eventSeatList,$eventSeat);
                }

                return $eventSeatList;


            }catch (Exception $ex){
                throw $ex;
            }


        }

        public function delete($idEventSeat)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE id_eventseat = :id_eventseat";
            
                $parameters["id_eventseat"] = $idEventSeat;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);   
            }
            catch(Exception $ex)
            {
                throw $ex;
            } 
        }

        public function quantityAvailable($idCalendar){
            try{

                $query = "SELECT SUM(".$this->tableNameEventSeats.".quantity) AS QUANTITY FROM ".$this->tableNameEventSeats." INNER JOIN ".$this->tableNameCalendars." ON ".$this->tableNameEventSeats.".fk_id_calendar = ".$this->tableNameCalendars.".id_calendar WHERE ".$this->tableNameCalendars.".id_calendar = :id_calendar";

                $parameters["id_calendar"] = $idCalendar;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach($resultSet as $row){
                    echo $row["QUANTITY"];
                    $quantity = $row["QUANTITY"];
                }

                return $quantity;


            }catch(Exception $ex){
                throw $ex;
            }
        }

        

    }



?>