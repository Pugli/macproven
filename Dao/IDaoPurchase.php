<?php
    namespace dao;

    use Model\Purchase as Purchase;
    
    interface IDaoPurchase
    {
        public function add(Purchase $purchase);
    }
?>