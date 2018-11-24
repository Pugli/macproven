<?php
    namespace dao;

    use Model\Ticket as Ticket;
    use dao\Connection as Connection;

    class DaoTicketPdo
    {
        private $connection;
        private $tableNameUser = 'users';
        private $tableNamePurchase = 'purchases';
        private $tableNamePurchaseLine = 'purchaseLines';
        private $tableNameTicket = 'tickets';
        private $tableNameEventSeats = "EVENTSEATS";

        public function add(Ticket $ticket)
        {
            $query = "INSERT INTO " . $this->tableNameTicket . " (fk_id_purchaseLine) VALUES (:idPurchaseLine)";

            $parameters['idPurchaseLine'] = $ticket->getPurchaseLine()->getId();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }

        public function getTicketsFromClient($idUser)
        {
            $query = "SELECT id_ticket as idTicket, fk_id_purchaseLine as idPurchaseLine 
            FROM " . $this->tableNameUser . " 
            INNER JOIN " . $this->tableNamePurchase . " 
            ON id_user = fk_id_user 
            INNER JOIN " . $this->tableNamePurchaseLine . " 
            ON id_purchase = fk_id_purchase 
            INNER JOIN " . $this->tableNameTicket . " 
            ON id_purchaseLine = fk_id_purchaseLine 
            WHERE id_user = :id";

            $parameters['id'] = $idUser;

            $this->connection = Connection::GetInstance();
            
            $resultSet = $this->connection->Execute($query, $parameters);

            $ticketList = array();

            foreach ($resultSet as $row)
            {
                $ticket = new Ticket();
                $ticket->setId($row['idTicket']);
                $ticket->setPurchaseLine($row['idPurchaseLine']);

                array_push($ticketList, $ticket);
            }

            return $ticketList;

        }

        public function ticketsSold($idEventSeat)
        {
            $query = "SELECT count(id_ticket) as quantityTickets FROM " . $this->tableNameEventSeats . 
                        " INNER JOIN " . $this->tableNamePurchaseLine . 
                        " ON id_eventseat = fk_id_eventseat
                          INNER JOIN " . $this->tableNameTicket .
                        " ON fk_id_purchaseLine = id_purchaseLine
                          WHERE id_eventseat = :id";

            $parameters['id'] = $idEventSeat;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $row = reset($resultSet);

            $quantity = $row['quantityTickets'];

            return $quantity;
        }
    }
?>