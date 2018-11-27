<?php
    namespace controllers;

    use Model\Ticket as Ticket;
    use dao\DaoTicketPdo as DaoTicketPdo;

    class ControllerTicket{

        private $daoTicket;

        public function __construct(){
            $this->daoTicket = new DaoTicketPdo;
        }

        public function showGetTicketsFromClient(){
            $client = $_SESSION["userLogged"];
            $tickets = $this->daoTicket->getTicketsFromClient($client->getId());
            require_once VIEWS_PATH."myTickets.php";
        }
    }


?>