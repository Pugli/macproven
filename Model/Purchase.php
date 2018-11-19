<?php
    namespace Model;

    use Model\User as User;

    class Purchase{

        private $purchaseLines = array();
        private $client;
        private $date;
        private $id;

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setDate($date)
        {
            $this->date = $date;
        }

        public function getDate()
        {
            return $this->date;
        }

        public function setClient(User $client)
        {
            $this->client = $client;
        }

        public function getClient()
        {
            return $this->client;
        }

        public function addPurchaseLine(PurchaseLine $purchaseLine)
        {
            array_push ($this->purchaseLines,$purchaseLine);
        }

        public function getPurchaseLines()
        {
            return $this->purchaseLines;
        }

        public function getAmount(){
            $amount = 0;
            foreach ($this->purchaseLines as $purchaseLine){
                $amount = $purchaseLine->getPrice() + $amount;
            }
            return $amount;
        }
    }
?>