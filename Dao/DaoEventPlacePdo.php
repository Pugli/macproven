<?php
namespace Dao;

use Dao\Connection as Connection;
use Dao\IDaoEventPlace as IDaoEventPlace;
use Model\EventPlace as EventPlace;
use \Exception as Exception;

class DaoEventPlacePdo implements IDaoEventPlace
{

    private $connection;
    private $tableName = "eventPlaces";

    public function add(EventPlace $eventPlace)
    {
        try
        {
            $query = "INSERT INTO " . $this->tableName . "(name, quantity) VALUES (:name, :quantity);";
            $parameters["name"] = $eventPlace->getName();
            $parameters["quantity"] = $eventPlace->getQuantity();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getAll()
    {
        try
        {
            $eventPlaceList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $eventPlace = new EventPlace();
                $eventPlace->setQuantity($row["quantity"]);
                $eventPlace->setId($row['id_eventPlace']);
                $eventPlace->setName($row["name"]);

                array_push($eventPlaceList, $eventPlace);
            }

            return $eventPlaceList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getAllActives()
    {
        try
        {
            $eventPlaceList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE isActive = 1";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $eventPlace = new EventPlace();
                $eventPlace->setQuantity($row["quantity"]);
                $eventPlace->setId($row['id_eventPlace']);
                $eventPlace->setName($row["name"]);

                array_push($eventPlaceList, $eventPlace);
            }

            return $eventPlaceList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete($idEventPlace)
    {
        try
        {
            $query = "UPDATE " . $this->tableName . " SET isActive = 0 WHERE id_eventplace = :idEventPlace";

            $parameters["idEventPlace"] = $idEventPlace;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function checkEventPlace($eventPlaceName)
    {
        try
        {
            $eventPlace = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE name = :eventPlaceName";

            $parameters["eventPlaceName"] = $eventPlaceName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $eventPlace = new EventPlace();
                $eventPlace->setQuantity($row["quantity"]);
                $eventPlace->setId($row['id_eventPlace']);
                $eventPlace->setName($row["name"]);
            }

            return $eventPlace;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function checkEventPlaceById($id)
    {
        try
        {
            $eventPlace = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE id_eventPlace = :id";

            $parameters["id"] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $eventPlace = new EventPlace();
                $eventPlace->setQuantity($row["quantity"]);
                $eventPlace->setId($row['id_eventPlace']);
                $eventPlace->setName($row["name"]);
            }

            return $eventPlace;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function changeQuantity($id, $quantity)
    {
        try {
            $query = 'UPDATE ' . $this->tableName . ' SET quantity = :quantity WHERE id_eventplace = :id';

            $parameters['quantity'] = $quantity;
            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function changeName($id, $name)
    {
        try {
            $query = 'UPDATE ' . $this->tableName . ' SET name = :name WHERE id_eventplace = :id';

            $parameters['name'] = $name;
            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
