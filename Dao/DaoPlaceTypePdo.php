<?php
    namespace dao;
    
    use Dao\IdaoPlaceType as IdaoPlaceType;
    use Model\PlaceType as PlaceType;
    use \Exception as Exception;
    use Dao\Connection as Connection;

    class DaoPlaceTypePdo implements IDaoPlaceType
    {
        private $connection;
        private $tableName = "PlaceType";

        public function add(PlaceType $PlaceType)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (description) VALUES (:description);";
                $parameters["description"] = $PlaceType->getDescription();

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
                $TypePlaceList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $PlaceType = new PlaceType();
                    $PlaceType->setDescription($row["description"]);
                    $PlaceType->setId($row['id_placetype']);

                    array_push($TypePlaceList, $PlaceType);
                }

                return $TypePlaceList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAllActives()
        {
            try
            {
                $TypePlaceList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE isActive = 1";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $PlaceType = new PlaceType();
                    $PlaceType->setDescription($row["description"]);
                    $PlaceType->setId($row['id_placetype']);

                    array_push($TypePlaceList, $PlaceType);
                }

                return $TypePlaceList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function checkDescription($description)
        {
            try
            {
                $placeType = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE description = :description";

                $parameters["description"] = $description;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $placeType = new PlaceType();
                    $placeType->setDescription($row["description"]);
                    $placeType->setId($row["id_placetype"]);
                }
                            
                return $placeType;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function delete($idPlaceType)
        {
            try
            {
                $query = "UPDATE ".$this->tableName." SET isActive = 0 WHERE id_placetype = :idPlaceType";
            
                $parameters["idPlaceType"] = $idPlaceType;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);   
            }
            catch(Exception $ex)
            {
                throw $ex;
            }            
        }

        public function checkPlaceTypeById ($idPlaceType){
            try
            {
                $placeType = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE id_placetype = :id_placetype";

                $parameters["id_placetype"] = $idPlaceType;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $placeType = new PlaceType();
                    $placeType->setDescription($row["description"]);
                    $placeType->setId($row["id_placetype"]);
                }
                            
                return $placeType;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function changeName($id, $name)
        {
            try{
            $query = 'UPDATE ' . $this->tableName . ' SET name = :name WHERE id_placetype = :id';

            $parameters['name'] = $name;
            $parameters['id'] = $id;

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