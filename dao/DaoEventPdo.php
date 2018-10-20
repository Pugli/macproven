<?php
    namespace dao;

    use Model\Event as Event;
    use dao\IDaoEventPdo as IDaoEventPdo;
    use \Exception as Exception;
    use Dao\Connection as Connection;
    use dao\DaoCategoryPdo as DaoCategoryPdo;

    class DaoEventPdo implements IDaoEventPdo{
        private $connection;
        private $tableName = "EVENTS";
        private $daoCategory;

        public function __construct(){
            $this->daoCategory = new DaoCategoryPdo;
        }

        public function add(Event $event)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (title,fk_category) VALUES (:title, :category);";
                $parameters["title"] = $event->getTitle();
                $parameters["category"] = $event->getCategory()->getId();

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
                    $event->setCategory($this->daoCategory->checkCategoryById($row['FK_CATEGORY']));

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
                    $event->setCategory($this->daoCategory->checkCategoryById($row['FK_CATEGORY']));
                }
                return $event;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function checkEventById($id)
        {
            try
            {
                $event = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE ID_EVENT = :id";

                $parameters["id"] = $eventname;

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