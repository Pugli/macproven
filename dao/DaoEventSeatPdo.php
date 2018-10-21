<?php
    namespace dao;

    use Model\EventSeat as EventSeat;
    use dao\Connection as Connection;
    use dao\DaoCalendarPdo as DaoCalendarPdo;
    use dao\DaoPlaceTypePdo as DaoPlaceTypePdo;
    use \Exception as Exception;

    class DaoEventSeatPdo implements IDaoEventSeatPdo{

        private $connection;
        private $tableName = "eventseats";
        private $daoCalendar;
        private $daoPlaceType;

        public function __construct(){
            $this->daoCalendar = new DaoCalendarPdo;
            $this->daoPlaceType = new DaoPlaceTypePdo;
        }

        public function add(EventSeat $eventSeat){
            try{
                $query = "INSERT INTO ".$this->tableName." (quantity, price, remainder, fk_id_calendar, fk_id_placetype) VALUES (:quantity, :price, :remainder, :fk_id_calendar, :fk_id_placetype)";
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

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::getInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row){
                    $eventSeat = new EventSeat;
                    $eventSeat->setId($row["id_eventseat"]);
                    $eventSeat->setRemainder($row["remainder"]);
                    $eventSeat->setQuantityAvailable($row["quantity"]);
                    $eventSeat->setPrice($row["price"]);
                    $eventSeat->setCalendar($this->daoCalendar->checkCalendarById($row["fk_id_calendar"]));
                    $eventSeat->setPlaceType($this->daoPlaceType->checkPlaceTypeById($row["fk_id_placetype"]));

                    array_push($eventSeatList,$eventSeat);
                }

                return $eventSeatList;


            }catch (Exception $ex){
                throw $ex;
            }


        }

        

    }



?>