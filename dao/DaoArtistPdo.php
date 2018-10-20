<?php
    namespace dao;
    
    use Dao\IDaoArtist as IDaoArtist;
    use Model\Artist as Artist;
    use \Exception as Exception;
    use Dao\Connection as Connection;

    class DaoArtistPdo implements IDaoArtist
    {
        private $connection;
        private $tableName = "artists";


        public function add(Artist $artist)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (name) VALUES (:name);";
                $parameters["name"] = $artist->getName();

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
                $artistList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $artist = new Artist();
                    $artist->setName($row["name"]);
                    $artist->setId($row['id_artist']);

                    array_push($artistList, $artist);
                }

                return $artistList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function checkArtist($name)
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
        }

        public function checkArtistById($id)
        {
            try
            {
                $artist = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE id_artist = :id";

                $parameters["id"] = $id;

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
        }

        public function delete($idArtist)
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
        }
    }
?>