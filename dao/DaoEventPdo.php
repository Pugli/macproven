<?php
    namespace dao;

    use Model\Event as Event;
    use dao\IDaoEventPdo as IDaoEventPdo;
    use \Exception as Exception;
    use Dao\Connection as Connection;
    use Model\Category as Category;

    class DaoEventPdo implements IDaoEventPdo{
        private $connection;
        private $tableName = "EVENTS";
        private $tableNameCategory = "CATEGORIES";

        public function generalQuery()
        {
            return "SELECT title, id_event, category, imagePath FROM " . $this->tableName . 
                                " AS e INNER JOIN ".$this->tableNameCategory." ON fk_category = ".$this->tableNameCategory.".id_category";
        }

        public function generate($resultSet)
        {
            $eventList = array();
            foreach ($resultSet as $row)
                {                
                    $event = new Event();
                    $event->setTitle($row["title"]);
                    $event->setId($row['id_event']);
                    $event->setNameImg($row['imagePath']);

                    $category = new Category();
                    $category->setDescription($row["category"]);
                    
                    $event->setCategory($category);

                    array_push($eventList, $event);
                }
            return $eventList;
        }

        public function add(Event $event)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (title,fk_category,imagePath) VALUES (:title, :category, :img);";
                $parameters["title"] = $event->getTitle();
                $parameters["category"] = $event->getCategory()->getId();
                $parameters["img"] = $event->getNameImg();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }  

        public function getAll()
        {
            try
            {
                $eventList = array();

                $query = $this->generalQuery();

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                $eventList = $this->generate($resultSet);

                return $eventList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAllActives()
        {
            try
            {
                $eventList = array();

                $query = $this->generalQuery() . " WHERE e.isActive = 1;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                $eventList = $this->generate($resultSet);

                return $eventList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function checkEvent($eventname)
        {
            try
            {
                $event = null;

                $query = $this->generalQuery() . " WHERE TITLE = :eventname";

                $parameters["eventname"] = $eventname;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                $eventList = $this->generate($resultSet);
                return reset($eventList);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function checkEventById($id)
        {
            try
            {
                $event = null;

                $query = $this->generalQuery() . " WHERE ID_EVENT = :id";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();
                
                $resultSet = $this->connection->Execute($query, $parameters);
                
                $eventList = $this->generate($resultSet);
                return $eventList[0];
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function delete($idEvent)
        {
            try
            {
                $query = "UPDATE ". $this->tableName . " SET isActive = 0 WHERE ID_EVENT = :idEvent";
            
                $parameters["idEvent"] = $idEvent;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);   
            }
            catch(Exception $ex)
            {
                throw $ex;
            }            
        }

        public function checkEventForDateDao($date)
        {
            $arrayEvent = array();
            try{
                $query = "SELECT e.title as titulo ,e.id_event as id,ca.category as categoria, ca.id_category as idC FROM events AS e
                INNER JOIN calendars AS c ON c.fk_id_event=e.id_event 
                INNER JOIN categories AS ca ON ca.id_category=e.FK_CATEGORY
                WHERE c.dateevent=:date;";
                
                $parameters["date"]=$date;

                $this->connection = Connection::GetInstance();
    
                $resultSet=$this->connection->Execute($query, $parameters);

                foreach($resultSet as $row){

                    $category = new Category();
                    $category->setId($row["idC"]);
                    $category->setDescription($row["categoria"]);

                    $event = new Event();
                    $event->setTitle($row["titulo"]);
                    $event->setId($row["id"]);
                    $event->setCategory($category);

                    array_push($arrayEvent,$event);

                }
                return $arrayEvent;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function checkEventForCategoryDao($id)
        {
            $arrayEvent = array();
            try{
                $query = "SELECT e.title AS titulo,e.id_event AS id,c.category AS categoria,  c.id_category as idC FROM events AS e 
                INNER JOIN categories AS c ON e.FK_CATEGORY=c.id_category 
                INNER JOIN calendars AS cal ON e.id_event=cal.fk_id_event
                WHERE c.id_category=:id";

                echo $query;
                 
                
                $parameters["id"]=$id;

                $this->connection = Connection::GetInstance();
    
                $resultSet=$this->connection->Execute($query, $parameters);

                

                foreach($resultSet as $row){
                    $category = new Category();
                    $category->setId($row["idC"]);
                    $category->setDescription($row["categoria"]);
                    $event = new Event();
                    $event->setTitle($row["titulo"]);
                    $event->setId($row["id"]);
                    $event->setCategory($category);
                    
                    array_push($arrayEvent,$event);
                }
                return $arrayEvent;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function checkEventByCategory($idCategory) // Dao Event // TRUE O FALSE.
        {
            $query = "SELECT * FROM " . $this->tableName . " WHERE isActive = 1 AND fk_category = :id";

            $parameters['id'] = $idCategory;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if($resultSet)
            {
                $resultSet = true;
            }
            else
            {
                $resultSet = false;
            }
            return $resultSet;
        }

        public function changeName($id, $name)
        {
            $query = 'UPDATE ' . $this->tableName . ' SET title = :name WHERE id_event = :id';

            $parameters['name'] = $name;
            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }

        public function changeCategory($id, $idCategory)
        {
            $query = 'UPDATE ' . $this->tableName . ' SET fk_id_category = :idCategory WHERE id_event = :id';

            $parameters['idCategory'] = $idCategory;
            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
    }
    




?>