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

        public function GetAll()
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

        public function GetByProductCode($productCode)
        {
            try
            {
                $product = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE productCode = :productCode";

                $parameters["productCode"] = $productCode;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $product = new Product();
                    $product->setProductCode($row["productCode"]);
                    $product->setName($row["name"]);
                    $product->setCost($row["cost"]);
                    $product->setPrice($row["price"]);
                    $product->setStock($row["stock"]);
                }
                            
                return $product;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Delete($productCode)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE productCode = :productCode";
            
                $parameters["productCode"] = $productCode;

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