<?php
    namespace controllers;

    use Model\Event as Event;
    use dao\DaoEventPdo as DaoEventPdo;

    class ControllerEvent{
        private $daoEvent;

        public function index(){
            include_once VIEWS_PATH.'eventlist.php';
        }

        public function showAddEvent(){
            include_once VIEWS_PATH.'addEvent.php';
        }

        public function showEventList(){
            $this->index();
        }

        public function addEvent($event,$category){
           if ($this->checkEvent($event) == null && ){
               $newEvent = new Event;
               $newEvent->setTitle($event);
               $this->daoEvent->add($newEvent);
               echo "<script> if(alert('Nueva Categoria ingresada!'));</script>";
            }
            else{

                echo "<script> if(alert('La Categoria Ya existe'));</script>";
           } 
        }

        public function delete($id){
            $this->DaoEvent->delete($idEvent);
            $this->showEventList();
        }

        public function getAll(){
            return $this->daoEvent->getAll();
        }
    }



?>