<?php
namespace dao;

use Dao\Connection as Connection;
use dao\IDaoCategory as IDaoCategory;
use Model\Category as Category;
use \Exception as Exception;

class DaoCategoryPdo implements IDaoCategory
{
    private $connection;
    private $tableName = "categories";

    public function add(Category $category)
    {
        try
        {
            $query = "INSERT INTO " . $this->tableName . " (category) VALUES (:category);";
            $parameters["category"] = $category->getDescription();

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
            $categoryList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $category = new Category();
                $category->setDescription($row["category"]);
                $category->setId($row['id_category']);

                array_push($categoryList, $category);
            }

            return $categoryList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getAllActives()
    {
        try
        {
            $categoryList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE isActive = 1";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $category = new Category();
                $category->setDescription($row["category"]);
                $category->setId($row['id_category']);

                array_push($categoryList, $category);
            }

            return $categoryList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function checkCategory($categoryname)
    {
        try
        {
            $category = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE category = :category && isActive = 1";

            $parameters["category"] = $categoryname;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $category = new Category();
                $category->setDescription($row["category"]);
                $category->setId($row["id_category"]);
            }

            return $category;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function checkCategoryById($categoryId)
    {
        try
        {
            $category = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE id_category = :category";

            $parameters["category"] = $categoryId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $category = new Category();
                $category->setDescription($row["category"]);
                $category->setId($row["id_category"]);
            }
            return $category;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete($idCategory)
    {
        try
        {
            $query = "UPDATE " . $this->tableName . " SET isActive = 0 WHERE id_category = :idCategory";

            $parameters["idCategory"] = $idCategory;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function changeName($id, $name)
    {
        try {
            $query = 'UPDATE ' . $this->tableName . ' SET category = :name WHERE id_category = :id';

            $parameters['name'] = $name;
            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
