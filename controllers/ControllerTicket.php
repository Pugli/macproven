<?php
    namespace controllers;

    use Model\Ticket as Ticket;
    use dao\DaoTicketPdo as DaoTicketPdo;

    class ControllerTicket{

        private $daoTicket;

        public function __construct(){
            $this->daoTicket = new DaoTicketPdo;
        }

        public function getTicketsFromClient(){
            $client = $_SESSION["userLogged"];
            return $this->daoTicket->getTicketsFromClient($client->getId());
        }
    }


?>