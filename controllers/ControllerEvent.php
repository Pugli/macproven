<?php
    namespace controllers;

    use Model\Event as Event;
    use dao\DaoEventPdo as DaoEventPdo;
    use dao\DaoCategoryPdo as DaoCategoryPdo;
    use dao\DaoArtistPdo as DaoArtistPdo;

    class ControllerEvent{
        private $daoEvent;
        private $daoCategory;
        private $daoArtist;

        public function __construct(){
            $this->daoEvent = new DaoEventPdo;
            $this->daoCategory = new DaoCategoryPdo;
            $this->daoArtist = new DaoArtistPdo;
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

        public function showCheckEventForDate()
        {
            include_once VIEWS_PATH."CheckEventForDate.php";
        }

        public function checkEventForDate($date)
        {
           if(($arrayEvent=$this->daoEvent->checkEventForDateDao($date)) != null){
            include_once VIEWS_PATH."listCheckEventForDate.php";
            }
           else{
            echo "<script> if(alert('No existe el evento'));</script>";
            include_once VIEWS_PATH .'Home.php';
            } 

        }

        public function showCheckEventForCategory()
        {
            $arrayCategory = $this->daoCategory->getAll();
            include_once VIEWS_PATH."CheckEventForCategory.php";
        }

        public function checkEventForCategory($id)
        {
            
           if(($arrayEvent=$this->daoEvent->checkEventForCategoryDao($id)) != null){
            include_once VIEWS_PATH."listCheckEventForCategory.php";
            }
           else{
            echo "<script> if(alert('No existe el evento'));</script>";
            include_once VIEWS_PATH .'Home.php';
        } 

        }
        public function showCheckEventForArtist()
        {
            $arrayArtist = $this->daoArtist->getAll();
            
            include_once VIEWS_PATH."CheckEventForArtist.php";
        }
        public function checkEventForArtist($id)
        {
            
           if(($arrayEvent=$this->daoEvent->checkEventForArtistDao($id)) != null){
            include_once VIEWS_PATH."listCheckEventForCategory.php";
            }
           else{
            echo "<script> if(alert('No existe el evento'));</script>";
            include_once VIEWS_PATH .'Home.php';
        } 
    }
    }



?>