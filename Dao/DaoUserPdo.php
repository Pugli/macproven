<?php
    namespace dao;

    use Model\Purchase as Purchase;
    use Model\User as User;
    use dao\Connection as Connection;

    class  DaoUserPdo
    {
        private $connection;
        private $tableName = 'users';
        //private $tableNamePurchase = 'purchases';

        public function generalQuery()
        {
            return "SELECT 
                        id_user AS idUser,
                        email,
                        password,
                        nickName,
                        isAdmin
                        /* id_purchase AS idPurchase,
                        fk_id_user,
                        datePurchase, */
                    FROM "
                    . $this->tableName;
                    /* " INNER JOIN "
                    . $this->tableNamePurchase .
                    "ON
                        fk_id_user = id_user;"; */
        }

        public function generate($resultSet)
        {
            $userList = array();

            foreach($resultSet as $row)
            {
                $user = new User();
                $user->setIdUser($row['idUser']);
                $user->setEmail($row['email']);
                $user->setPassword($row['password']);
                $user->setNickName($row['nickName']);
                $user->setIsAdmin($row['isAdmin']);

                array_push($userList, $user);
            }

            return $userList;
        }

        public function add(User $user)
        {
            try
            {
                $query = "INSERT INTO " . $this->tableName . " (id_user, email, password, nickName, isAdmin) VALUES (:idUser, :email, :password, :nickName, :isAdmin)";
    
                $parameters['idUser'] = $user->getIdUser();
                $parameters['email'] = $user->getEmail();
                $parameters['password'] = $user->getPassword();
                $parameters['nickName'] = $user->getNickName();
                $parameters['isAdmin'] = $user->getIsAdmin();

                //Llega un 0 (cliente) como parametro, pero en la bd lo ingresa como 1 y figura administrador
    
                $this->connection = Connection::GetInstance();
  
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll()
        {
            $query = $this->generalQuery();

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $userList = $this->generate($resultSet);

            return $userList;

        }

        public function getUserByEmail($email)
        {
            $query = $this->generalQuery() . " WHERE email = :email;";

            $parameters['email'] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $user = new User();

            foreach($resultSet as $row)
            {
                $user->setIdUser($row['idUser']);
                $user->setEmail($row['email']);
                $user->setPassword($row['password']);
                $user->setNickName($row['nickName']);
                $user->setIsAdmin($row['isAdmin']);
            }

            return $user;
           
        }

        public function getUserById($id)
        {
            $query = $this->generalQuery() . " WHERE id = :id;";

            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $user = new User();

            foreach($resultSet as $row)
            {
                $user->setIdUser($row['id_user']);
                $user->setEmail($row['email']);
                $user->setPassword($row['password']);
                $user->setNickName($row['nickName']);
                $user->setIsAdmin($row['isAdmin']);
            }

            return $user;

        }

        //getPurchasesFromUser($idUser) 
    }
?>