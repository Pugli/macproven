<?php
    use dao\IDaoPurchasePdo as IDaoPurchasePdo;
    use dao\Connection as Connection;
    use Model\Purchase as Purchase;

    class DaoPurchasePdo implements IDaoPurchasePdo
    {
        private $connection;

        public function generalQuery(Type $var = nul)
        {
            # code...
        }

        public function add(Purchase $purchase)
        {
            
        }
    }
?>