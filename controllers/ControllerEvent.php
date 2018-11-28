<?php
    namespace controllers;

    use Model\Event as Event;
    use dao\DaoEventPdo as DaoEventPdo;
    use dao\DaoCategoryPdo as DaoCategoryPdo;
    use dao\DaoCalendarPdo as DaoCalendarPdo;

    class ControllerEvent{
        private $daoEvent;
        private $daoCategory;
        private $daoCalendar;

        public function __construct(){
            $this->daoEvent = new DaoEventPdo;
            $this->daoCategory = new DaoCategoryPdo;
            $this->daoCalendar = new DaoCalendarPdo;
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

        public function addEvent($event,$categoryId,$file){
            
           if (($this->daoEvent->checkEvent($event) == null) && ($this->daoCategory->checkCategoryById($categoryId) != null)){
               
               $newEvent = new Event;

               if(!empty($file)){
                $newEventWithImg = $this->setImage($newEvent,$file);
               }

               if($newEventWithImg != null){
                   $newEvent = $newEventWithImg;
               }

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

        public function delete($idEvent){

            if($this->daoCalendar->checkCalendarsFutureByEvent($idEvent) == false){
                $this->daoEvent->delete($idEvent);
            }else{
                echo "<script> if(alert('No es posible borrar el evento. Hay fechas futuras'));</script>";
            }
            $this->showEventList();
        }

        public function getAll(){
            return $this->daoEvent->getAll();
        }

        public function getAllActives(){
            return $this->daoEvent->getAllActives();
        }

        public function showCheckEventForDate()
        {
            include_once VIEWS_PATH."CheckEventForDate.php";
        }
        public function showCheck()
        {
            $arrayCategory = $this->daoCategory->getAllActives();
            include_once VIEWS_PATH."queries.php";
        }

        public function checkEventForDate($date)
        {
           if(($arrayEvent=$this->daoEvent->checkEventForDateDao($date)) != null){
            include_once VIEWS_PATH."listCheckEventForDate.php";
            }
           else{
            echo "<script> if(alert('No existen eventos para esa fecha'));</script>";
            include_once VIEWS_PATH .'Searchs.php';
            } 

        }

        public function showCheckEventForCategory()
        {
            $arrayCategory = $this->daoCategory->getAllActives();
            include_once VIEWS_PATH."CheckEventForCategory.php";
        }

        public function checkEventForCategory($id)
        {
            
           if(($arrayEvent=$this->daoEvent->checkEventForCategoryDao($id)) != null){
            include_once VIEWS_PATH."listCheckEventForDate.php";
            }
           else{
            echo "<script> if(alert('No existen eventos de esa categoria'));</script>";
            include_once VIEWS_PATH .'Searchs.php';
            } 

        }

        private function setImage(Event $event,$file){
            $fileName = $file["name"];
            $tempFileName = $file["tmp_name"];
            $type = $file["type"];
            
            $filePath = UPLOADS_PATH.basename($fileName);            

            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            $imageSize = getimagesize($tempFileName);

            if($imageSize !== false)
            {
                if (move_uploaded_file($tempFileName, $filePath))
                {
                    $event->setNameImg($fileName);
                    return $event;
                }
                else
                    echo "Error en la carga de la imagen";
            }
            else   
                echo "El archivo no es una imagen";
        }

        public function getEventById($eventId){
            $event = $this->daoEvent->checkEventById($eventId);
            $calendarsForEvent = $this->daoCalendar->getCalendarForEvent($eventId);
            include_once VIEWS_PATH."showCalendarsForEvent.php";
        }

        public function changeTittle($id,$tittle)
        {
            try{

                $this->daoEvent->changeName($id,$tittle);
            
        }
            catch(Exception $ex){
                echo "<script> if(alert('No es posible realizar la modificacion'));</script>";
            }
        }

        public function changeCategory($id,$idC)
        {
        
                try{
                  
                if($this->daoEvent->checkEventById($id) != null){
                    $this->daoEvent->changeCategory($id,$idC);
                }
                else{
                    echo "<script> if(alert('no existe ese evento'));</script>";
                }
    
            }
                catch(Exception $ex){
                    echo "<script> if(alert('algo fallo'));</script>";
                }
            
        }
        public function checkEventForArtist($id)
        {
            
           if(($arrayEvent=$this->daoEvent->checkEventForArtistDao($id)) != null){
            include_once VIEWS_PATH."listCheckEventForDate.php";
            }
           else{
            echo "<script> if(alert('No existen eventos con ese artista'));</script>";
            include_once VIEWS_PATH .'Searchs.php';
        } 
    }

    }

    



?>