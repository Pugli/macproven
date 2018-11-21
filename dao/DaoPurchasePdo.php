<?php
    namespace dao;
    
    use dao\IDaoPurchasePdo as IDaoPurchasePdo;
    use dao\Connection as Connection;
    use Model\Purchase as Purchase;
    use Model\User as User;

    class DaoPurchasePdo implements IDaoPurchase
    {
        private $connection;
        private $tableName = 'purchases';
        private $tableNameUser = 'users';

        public function generalQuery()
        {
            return "SELECT p.id_purchase as idPurchase, p.datePurchase FROM " . $this->tableName. " p";
        }

        public function generate($row)
        {
            $purchase = new Purchase();
            $purchase->setDate($row['datePurchase']);
            $purchase->setId($row['idPurchase']);

            return $purchase;
        }

        public function add(Purchase $purchase)
        {
            $query = 'INSERT INTO ' . $this->tableName . " (fk_id_user, datePurchase) VALUES (:fk_id_user, now());";

            $parameters['fk_id_user'] = $purchase->getClient()->getId();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            return $this->connection->getLastId();
        }

        public function getPurchasesByClient($id)
        {
            $query = $this->generalQuery() . " WHERE fk_id_user = :id";

            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $purchaseList = array();

            foreach ($resultSet as $row)
            {
                $purchase = $this->generate($row);

                array_push($purchaseList, $purchase);
            }

            return $purchaseList;
        }

        public function getPurchaseById($id)
        {
            $query = $this->generalQuery() . " WHERE id_purchase = :id";

            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $row = reset($resultSet);

            $purchase = $this->generate($row);

            return $purchase;
        }
    }
?>