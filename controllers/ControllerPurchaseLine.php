<?php
    namespace controllers;

    use Model\PurchaseLine as PurchaseLine;
    use dao\DaoCurrentPurchaseList as DaoCurrentPurchaseList;
    use dao\DaoEventSeatPdo as DaoEventSeatPdo;

    class ControllerPurchaseLine{

        private $daoCurrentPurchase;
        private $daoEventSeat;

        public function __construct(){
            $this->daoCurrentPurchase = new DaoCurrentPurchaseList;
            $this->daoEventSeat = new DaoEventSeatPdo;
        }

        public function addPurchaseLineOnCart($idEventSeat,$quantity){

            $eventSeat = $this->daoEventSeat->getEventSeatById($idEventSeat);

            $purchaseLine = new PurchaseLine;
            $purchaseLine->setEventSeat($eventSeat);
            $purchaseLine->setPrice($eventSeat->getPrice());
            $purchaseLine->setQuantity($quantity);

            $this->daoCurrentPurchase->add($purchaseLine);
        }

        public function getCurrentPurchaseLines(){
            return $this->daoCurrentPurchase->getAll();
        }

        public function showBuyPurchaseLine($eventSeatId){
            $eventSeat = $this->daoEventSeat->getEventSeatById($eventSeatId);
            require_once VIEWS_PATH."buyEventSeat.php";
        }


    }



?>