<?php
    namespace Dao;

    use Dao\IDaoEventPlace as IDaoEventPlace;
    use Dao\Connection as Connection;
    use Model\EventPlace as EventPlace;
    use \Exception as Exception;

    class DaoEventPlace implements IDaoEventPlace{

        private $connection;
        private $tableName = "eventPlaces";
        
        public function add(EventPlace $eventPlace)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (quantity, name) VALUES (:quantity, :name);";
                $parameters["quantity"] = $eventPlace->getQuantity();
                $parameters["name"] = $eventPlace->getName();

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
                $eventPlaceList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $eventPlace = new EventPlace();
                    $eventPlace->setQuantity($row["quantity"]);
                    $eventPlace->setId($row['id_eventPlace']);
                    $eventPlace->setName($row["name"]);

                    array_push($eventPlaceList, $eventPlace);
                }

                return $eventPlaceList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

            public function delete($idEventPlace)
            {
                try
                {
                    $query = "DELETE FROM ".$this->tableName." WHERE id_eventplace = :idEventPlace";
                
                    $parameters["idEventPlace"] = $idEventPlace;

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