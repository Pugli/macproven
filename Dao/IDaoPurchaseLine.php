<?php
    namespace dao;

    use Model\PurchaseLine as PurchaseLine;

    interface IDaoPurchaseLine {
        public function add(PurchaseLine $purchaseLine, $idPurchase);
    }
?>