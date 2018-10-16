<?php
    namespace dao;

    use Model\Event as Event;
    use dao\IDaoEventPdo as IDaoEventPdo;
    use \Exception as Exception;
    use Dao\Connection as Connection;

    class DaoEventPdo implements IDaoEventPdo{
        private $connection;
        private $tableName = "events";

        public function add(Event $event)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (event) VALUES (:title);";
                $parameters["title"] = $event->getTitle();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll()
        {
            try
            {
                $eventList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $event = new Event();
                    $event->setTitle($row["event"]);
                    $event->setId($row['id_event']);

                    array_push($eventList, $artist);
                }

                return $eventList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function checkEvent($event)
        {
            try
            {
                $event = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE event = :title";

                $parameters["title"] = $name;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $event = new Event();
                    $event->setName($row["event"]);
                    $event->setId($row["id_event"]);
                }
                            
                return $artist;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function delete($idEvent)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE id_event = :idEvent";
            
                $parameters["idEvent"] = $idEvent;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);   
            }
            catch(Exception $ex)
            {
                throw $ex;
            }            
        }
    }
    }




?>