<?php
namespace controllers;

use dao\DaoTicketPdo as DaoTicketPdo;
use \Exception as Exception;

class ControllerTicket
{

    private $daoTicket;

    public function __construct()
    {
        $this->daoTicket = new DaoTicketPdo;
    }

    public function showGetTicketsFromClient()
    {
        try {
            $client = $_SESSION["userLogged"];
            $tickets = $this->daoTicket->getTicketsFromClient($client->getId());
            require_once VIEWS_PATH . "myTickets.php";
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            include_once VIEWS_PATH . 'home.php';
        }
    }
}
