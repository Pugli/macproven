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
                $query = "INSERT INTO ".$this->tableName." (TypePlace) VALUES (:description);";
                $parameters["description"] = $artist->getDescription();

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
                    $PlaceType->setId($row['id_PlaceType']);

                    array_push($TypePlaceList, $PlaceType);
                }

                return $TypePlaceList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        /*public function checkArtist($name)
        {
            try
            {
                $artist = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE name = :name";

                $parameters["name"] = $name;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $artist = new Artist();
                    $artist->setName($row["name"]);
                    $artist->setId($row["id_artist"]);
                }
                            
                return $artist;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }*/

       /* public function delete($idArtist)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE id_artist = :idArtist";
            
                $parameters["idArtist"] = $idArtist;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);   
            }
            catch(Exception $ex)
            {
                throw $ex;
            }            
        }*/
    }
?>