<?php
    namespace dao;

    use Model\EventSeat as EventSeat;
    use Model\Calendar as Calendar;
    use Model\PlaceType as PlaceType;
    use Model\Artist as Artist;
    use Model\EventPlace as EventPlace;
    use Model\Event as Event;
    use Model\Category as Category;
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

                    $placeType = new PlaceType();
                    $placeType->setDescription($row['descriptionPlaceType']);

                    $eventSeat = new EventSeat;
                    $eventSeat->setId($row["idEventSeat"]);
                    $eventSeat->setRemainder($row["remainderEventSeat"]);
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

                $query = $this->generalQuery() . " ORDER BY ac.pfk_id_calendar";

                $this->connection = Connection::getInstance();

                $resultSet = $this->connection->Execute($query);

                $eventSeatList = $this->generateEventSeat($resultSet);

                /* foreach ($resultSet as $row){
                    $artist = new Artist();
                    $artist->setName($row["ARTIST"]);

                    $eventPlace = new EventPlace();
                    $eventPlace->setName($row["EVENTPLACE"]);

                    $event = new Event();
                    $event->setTitle($row["EVENTNAME"]);

                    $calendar = new Calendar();
                    $calendar->setArtist($artist);
                    $calendar->setDate($row['DATEEVENT']);
                    $calendar->setEventPlace($eventPlace);
                    $calendar->setEvent($event);

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
                } */

                return $eventSeatList;


            }catch (Exception $ex){
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