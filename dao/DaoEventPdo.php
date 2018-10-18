<?php
    namespace dao;

    use Model\Event as Event;
    use dao\IDaoEventPdo as IDaoEventPdo;
    use \Exception as Exception;
    use Dao\Connection as Connection;

    class DaoEventPdo implements IDaoEventPdo{
        private $connection;
        private $tableName = "EVENTS";

        public function add(Event $event)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (title,fk_category) VALUES (:title, :category);";
                $parameters["title"] = $event->getTitle();
                $parameters["category"] = $event->getCategory();

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
                    $event->setTitle($row["TITLE"]);
                    $event->setId($row['ID_EVENT']);
                    $event->setCategory($row['FK_CATEGORY']);

                    array_push($eventList, $event);
                }

                return $eventList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function checkEvent($eventname)
        {
            try
            {
                $event = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE TITLE = :title";

                $parameters["title"] = $eventname;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $event = new Event();
                    $event->setTitle($row["TITLE"]);
                    $event->setId($row["ID_EVENT"]);
                    $event->setCategory($row["FK_CATEGORY"]);
                }
                return $event;
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
                $query = "DELETE FROM ".$this->tableName." WHERE ID_EVENT = :idEvent";
            
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
    




?>