<?php

    namespace controllers;

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

            $idLastPurchaseInsert = $this->daoPurchase->add($purchase);
            $purchase = $this->daoPurchase->getPurchaseById($idLastPurchaseInsert);

            $currentPurchaseLines = $this->daoCurrentPurchase->getAll();

            $tickets = array();
            foreach($currentPurchaseLines as $purchaseLine){
                $this->daoPurchaseLine->add($purchase,$purchase->getId());
                $purchaseLineWithId = $this->daoPurchaseLine->getLastPurchaseLine();
                $tickets = generateTickets($tickets,$purchaseLineWithId);
            }
            return $tickets;

        }

        private function generateTickets($tickets,$purchaseLineWithId){

            for($i=0; i<$purchaseLineWithId->getQuantity();$i++){
                $ticket = new Ticket();
                $ticket->setPurchaseLine($purchaseLineWithId);
                $this->daoTicket->add($ticket);
                array_push($tickets,$ticket);
            }
            return $tickets;
        }

        private function getPurchasesFromClient(){
            $client = $_SESSION["userLogged"];
            return $this->daoPurchase->getPurchasesByClient($client->getId());
        }

        


    }



?>