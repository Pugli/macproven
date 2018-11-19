<?php

    namespace controller;

    use Model\Purhcase as Purchase;
    use Model\PurchaseLine as PurchaseLine;
    use Model\Ticket as Ticket;
    use dao\DaoPurchasePdo as DaoPurchasePdo;
    use dao\DaoPurchaseLinePdo as DaoPurchaseLinePdo;
    use dao\DaoTicketPdo as DaoTicketPdo;
    use dao\DaoCurrentPurchaseList as DaoCurrentPurchaseList;

    class ControllerPurchase{

        private $daoPurchase;
        private $daoPurchaseLine;
        private $daoTicket;
        private $daoCurrentPurchase;

        public function __construct(){
            $this->$daoPurchase = new DaoPurchasePdo;
            $this->$daoPurchaseLine = new DaoPurchaseLinePdo;
            $this->$daoTicket = new DaoTicketPdo;
            $this->$daoCurrentPurchase = new DaoCurrentPurchaseList;
        }

        public function addPurchase(){

            $purchase = new Purchase;
            $purchase->setClient($_SESSION["userLogged"]);
            $this->daoPurchase->add($purchase);
            $purchase = $this->daoPurchase->getLastPurchase();
            $currentPurchaseLines = $this->daoCurrentPurchase->getAll();
            $tickets = array();
            foreach($currentPurchaseLines as $purchaseLine){
                $purchaseLine->setPurchase($purchase);
                $this->daoPurchaseLine->add($purchase);
                $tickets = generateTickets($tickets,$purchaseLine);
            }
            return $tickets;

        }

        private function generateTickets($tickets,$purchaseLine){

            for($i=0; i<$purchaseLine->getQuantity();i++){
                $ticket = new Ticket();
                $ticket->setPurchaseLine($purchaseLine);
                $this->daoTicket->add($ticket);
                array_push($tickets,$ticket);
            }
            return $tickets;
        }

        


    }



?>