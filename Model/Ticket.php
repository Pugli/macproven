<?php
    namespace Model;

    use Model\PurchaseLine as PurchaseLine;

    class Ticket{
        private $number;
        private $id;
        private $purchaseLine;
        private $qr;
        private $dateBought;

        public function setPurchaseLine(PurchaseLine $purchaseLine)
        {
            $this->purchaseLine = $purchaseLine;
        }
        public function getPurchaseLine()
        {
            return $this->purchaseLine;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setNumber($number)
        {
            $this->number = $number;
        }

        public function getNumber()
        {
            return $this->number;
        }
        public function setQr($qr)
        {
            $this->qr = $qr;
        }

        public function getQr()
        {
            return $this->qr;
        }

        public function getDateBought(){
            return $this->dateBought;
        }

        public function setDateBought($dateBought){
            $this->dateBought = $dateBought;
        }


    }
?>