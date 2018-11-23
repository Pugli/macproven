<?php
    namespace dao;

    use Model\PurchaseLine as PurchaseLine;

    class DaoCurrentPurchaseList
    {
        private $currentPurchase;

        public function __construct(){
            if(!isset($_SESSION['currentPurchase'])){
                $_SESSION['currentPurchase'] = $this->currentPurchase = array();
            }
            $this->currentPurchase = &$_SESSION['currentPurchase'];
        }

        public function lastId()
        {
            $currentPurchase = $this->currentPurchase;
            $id = 0;

            if(isset($currentPurchase[0])){
                $max = count($currentPurchase) - 1;
                $id = $currentPurchase[$max]->getId();
            }
            return $id;
        }

        public function add(PurchaseLine $purchaseLine)
        {
            $id = 1 + $this->lastId();
            $purchaseLine->setId($id);
            array_push($this->currentPurchase, $purchaseLine);
        }

        public function getAll()
        { 
            return $this->currentPurchase;
        }

        public function reset(){
            $this->currentPurchase = array();
        }
    }
?>