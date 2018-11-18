<?php
    namespace dao;
    
    interface IDaoPurchase
    {
        public function add(Purchase $purchase);
        public function getAll();
    }
?>