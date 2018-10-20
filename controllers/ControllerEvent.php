<?php
    namespace controllers;

    use Model\Event as Event;
    use dao\DaoEventPdo as DaoEventPdo;
    use dao\DaoCategoryPdo as DaoCategoryPdo;

    class ControllerEvent{
        private $daoEvent;
        private $daoCategory;

        public function __construct(){
            $this->daoEvent = new DaoEventPdo;
            $this->daoCategory = new DaoCategoryPdo;
        }

        public function index(){
            $this->showEventList();
        }

        public function showAddEvent(){
            include_once VIEWS_PATH.'addEvent.php';
        }

        public function showEventList(){
            include_once VIEWS_PATH.'eventlist.php';
        }

        public function addEvent($event,$categoryId){
           if (($this->daoEvent->checkEvent($event) == null) && ($this->daoCategory->checkCategoryById($categoryId) != null)){
               $newEvent = new Event;
               $newEvent->setTitle($event);
               $newEvent->setCategory($this->daoCategory->checkCategoryById($categoryId));
               $this->daoEvent->add($newEvent);
               echo "<script> if(alert('Nuevo Evento Ingresado'));</script>";
            }
            else{

                echo "<script> if(alert('Evento no ingresado, Vuelva a intentar.'));</script>";
           } 
           $this->showEventList();
        }

        public function delete($id){
            $this->daoEvent->delete($id);
            $this->showEventList();
        }

        public function getAll(){
            return $this->daoEvent->getAll();
        }
    }



?>