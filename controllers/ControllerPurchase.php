<?php

    namespace controllers;

    use Model\Purchase as Purchase;
    use Model\PurchaseLine as PurchaseLine;
    use Model\Ticket as Ticket;
    use dao\DaoPurchasePdo as DaoPurchasePdo;
    use dao\DaoPurchaseLinePdo as DaoPurchaseLinePdo;
    use dao\DaoTicketPdo as DaoTicketPdo;
    use dao\DaoCurrentPurchaseList as DaoCurrentPurchaseList;
    use \Exception as Exception;

    class ControllerPurchase{

        private $daoPurchase;
        private $daoPurchaseLine;
        private $daoTicket;
        private $daoCurrentPurchase;

        public function __construct(){
            $this->daoPurchase = new DaoPurchasePdo;
            $this->daoPurchaseLine = new DaoPurchaseLinePdo;
            $this->daoTicket = new DaoTicketPdo;
            $this->daoCurrentPurchase = new DaoCurrentPurchaseList;
        }

        public function index()
        {
            $this->showTicketList();
        }

        public function showTicketList()
        {
            try{
            $client = $_SESSION["userLogged"];
            $tickets = $this->daoTicket->getTicketsFromClient($client->getId());
            require_once VIEWS_PATH."myTickets.php";
            }
            catch(Exception $ex)
        {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        } 
        }

        public function addPurchase(){
            try{
            $currentPurchaseLines = $this->daoCurrentPurchase->getAll();
            
            if(!empty($currentPurchaseLines)){
                $purchase = new Purchase;
                $purchase->setClient($_SESSION["userLogged"]);

                $idLastPurchaseInsert = $this->daoPurchase->add($purchase);
                $purchase = $this->daoPurchase->getPurchaseById($idLastPurchaseInsert);

                $tickets = array();
                foreach($currentPurchaseLines as $purchaseLine){
                    if($purchaseLine->getQuantity() <= $purchaseLine->getEventSeat()->getQuantityAvailable() - $this->daoTicket->ticketsSold($purchaseLine->getEventSeat()->getId())){
                    $this->daoPurchaseLine->add($purchaseLine,$purchase->getId());
                    $purchaseLineWithId = $this->daoPurchaseLine->getLastPurchaseLine();
                    $tickets = $this->generateTickets($tickets,$purchaseLineWithId);
                    }else{
                        echo '<script> if(alert("Las entradas del evento: '.$purchaseLine->getEventSeat()->getCalendar()->getEvent()->getTitle().' Con Fecha '.$purchaseLine->getEventSeat()->getCalendar()->getDate().' Se exedieron del remanente"));</script>';
                    }
                }
                $this->daoCurrentPurchase->reset();
                $this->showTicketList();
                return $tickets;
            }
            else
            {
                echo "<script> if(alert('No hay compras en el carrito'));</script>";
            }
                include_once VIEWS_PATH."home.php";
        }
        catch(Exception $ex)
        {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        } 
        }

        private function generateTickets($tickets,$purchaseLineWithId){
try{
            for($i=0; $i<$purchaseLineWithId->getQuantity();$i++){
                $ticket = new Ticket();
                $ticket->setPurchaseLine($purchaseLineWithId);
                $ticket->setQr(uniqid ("",false));
                $this->daoTicket->add($ticket);
                array_push($tickets,$ticket);
            }
            return $tickets;
        }
        catch(Exception $ex)
        {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        } 
        }

        private function getPurchasesFromClient(){
try{
            $client = $_SESSION["userLogged"];

            $purchases =  $this->daoPurchase->getPurchasesByClient($client->getId());

            foreach($purchases as $purchase){
                $purchaseLines = $this->daoPurchaseLine->getPurchaseLinesByPurchase($purchase->getId());
                foreach($purchaseLines as $purchaseLine){
                    $purchase->addPurchaseLine($purchaseLine);
                }
            }

            return $purchases;
        }
        catch(Exception $ex)
        {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        } 
        }    
    }



?>