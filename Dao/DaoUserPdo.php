<?php
namespace dao;

use dao\Connection as Connection;
use dao\IDaoUser as IDaoUser;
use Model\User as User;
use \Exception as Exception;

class DaoUserPdo implements IDaoUser
{
    private $connection;
    private $tableName = 'users';

    public function generalQuery()
    {
        return "SELECT
                        id_user,
                        email,
                        password,
                        nickName,
                        isAdmin
                    FROM "
        . $this->tableName;
    }

    public function generate($row)
    {
        $user = new User();
        $user->setId($row['id_user']);
        $user->setEmail($row['email']);
        $user->setPassword($row['password']);
        $user->setNickName($row['nickName']);
        $user->setIsAdmin($row['isAdmin']);
        return $user;
    }

    public function add(User $user)
    {
        try
        {
            $query = "INSERT INTO " . $this->tableName . " (email, password, nickName, isAdmin) VALUES (:email, :password, :nickName, :isAdmin)";

            $parameters['email'] = $user->getEmail();
            $parameters['password'] = $user->getPassword();
            $parameters['nickName'] = $user->getNickName();
            $parameters['isAdmin'] = $user->getIsAdmin();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getAll()
    {
        try {
            $query = $this->generalQuery();

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $userList = array();

            foreach ($resultSet as $row) {
                $user = $this->generate($row);

                array_push($userList, $user);
            }

            return $userList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getAllActives()
    {
        try {
            $query = $this->generalQuery() . " WHERE isActive = 1";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $userList = array();

            foreach ($resultSet as $row) {
                $user = $this->generate($row);

                array_push($userList, $user);
            }

            return $userList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getUserByEmail($email)
    {
        try {
            $query = $this->generalQuery() . " WHERE email = :email;";

            $parameters['email'] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $row = reset($resultSet);

            $user = new User();

            $user = $this->generate($row);

            return $user;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getUserById($id)
    {
        try {
            $query = $this->generalQuery() . " WHERE id = :id;";

            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $row = reset($resultSet);

            $user = new User();

            $user = $this->generate($row);

            return $user;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete($idUser)
    {
        try {
            $query = "UPDATE " . $this->tableName . "SET isActive = 0 WHERE id_user = (:idUser)";

            $parameters["idUser"] = $idUser;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
