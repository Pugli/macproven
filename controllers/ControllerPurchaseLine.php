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

            if ($this->checkEventSeatOnCart($idEventSeat) != null){

                $eventSeat = $this->daoEventSeat->getEventSeatById($idEventSeat);

                $purchaseLine = new PurchaseLine;
                $purchaseLine->setEventSeat($eventSeat);
                $purchaseLine->setPrice($eventSeat->getPrice());
                $purchaseLine->setQuantity($quantity);

                $this->daoCurrentPurchase->add($purchaseLine);
                echo "<script> if(alert('Su compra se ha añadido al carrito!'));</script>";
            }
        }

        public function showCurrentPurchaseLines(){
            include_once VIEWS_PATH.'viewCurrentCart.php';
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