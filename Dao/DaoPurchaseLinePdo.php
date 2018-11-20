<?php
    namespace dao;

    use Model\PurchaseLine as PurchaseLine;
    use Model\Purchase as Purchase;
    use Model\EventSeat as EventSeat;
    use dao\Connection as Connection;
    use dao\IDaoPurchaseLine as IDaoPurchaseLine;

    class DaoPurchaseLinePdo implements IDaoPurchaseLine
    {
        private $connection;
        private $tableName = 'purchaseLines';

        public function add(PurchaseLine $purchaseLine, $idPurchase)
        {
            $query = "INSERT INTO " . $this->tableName . " (id_purchaseLine, fk_id_eventseat, quantity, price, fk_id_purchase) VALUES (:idPurchaseLine, :idEventSeat, :quantity, :price, :idPurchase)";

            $parameters['idPurchaseLine'] = $purchaseLine->getId();
            $parameters['idEventSeat'] = $purchaseLine->getEventSeat()->getId();
            $parameters['quantity'] = $purchaseLine->getQuantity();
            $parameters['price'] = $purchaseLine->getPrice();
            $parameters['idPurchase'] = $idPurchase;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }

        public function get(Type $var = null)
        {
            
        }
    }
?>