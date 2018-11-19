<?php
    use dao\IDaoPurchasePdo as IDaoPurchasePdo;
    use dao\Connection as Connection;
    use Model\Purchase as Purchase;

    class DaoPurchasePdo implements IDaoPurchasePdo
    {
        private $connection;
        private $tableName = 'purchases';

        public function generalQuery()
        {
            
        }

        public function add(Purchase $purchase)
        {
            $purchaseLines = $purchase->getPurchaseLines();
            foreach ($purchaseLines as $purchaseLine)
            {

            }
            $query = "INSERT INTO " . $this->tableName . " (";
            //cleinte/ con un array linea de compra
        }
    }
?>