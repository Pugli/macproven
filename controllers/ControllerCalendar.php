<?php
    namespace controllers;

    use Model\Calendar as Calendar;
    use dao\DaoCalendarPdo as DaoCalendarPdo;
    use dao\DaoCategoryPdo as DaoCategoryPdo;
    use Dao\DaoArtistPdo as DaoArtistPdo;
    use Dao\DaoEventPlacePdo as DaoEventPlacePdo;
    use Dao\DaoEventPdo as DaoEventPdo;

class ControllerCalendar{

        private $daoCalendar;
        private $daoCategory;
        private $daoPlace;
        private $daoEvent;

        public function __construct(){
            $this->daoCalendar = new DaoCalendarPdo;
            $this->daoArtist = new DaoArtistPdo;
            $this->daoPlace = new DaoEventPlacePdo;
            $this->daoEvent = new DaoEventPdo;
        }

        public function index(){
            $this->showCalendarList();
        }

        public function showCalendarList(){
            include_once VIEWS_PATH.'CalendarList.php';
        }

        public function showAddCalendar(){
            include_once VIEWS_PATH.'addCalendar.php';
        }

        public function addCalendar($date,$artists,$placeId,$eventId,$file){
            $flag = 0;
            foreach($artists as $i){
                if($this->daoArtist->checkArtistById($i) == null){
                    $flag = 1;
                }
            }

            if( $flag == 0 && $this->daoPlace->checkEventPlaceById($placeId) != null && $this->daoEvent->checkEventById($eventId) != null){
                $newCalendar = new Calendar();

                if(!empty($file)){
                    $newCalendarWithImg = $this->setImage($newCalendar,$file);
                   }
    
                   if($newCalendarWithImg != null){
                       $newCalendar = $newCalendarWithImg;
                   }

                $newCalendar->setDate($date);
                $newCalendar->setEventPlace($this->daoPlace->checkEventPlaceById($placeId));
                foreach($artists as $i){
                    $newCalendar->addArtist($this->daoArtist->checkArtistById($i));
                }
                $newCalendar->setEvent($this->daoEvent->checkEventById($eventId));
                $this->daoCalendar->add($newCalendar);
                echo "<script> if(alert('Nuevo Calendario Ingresado'));</script>";
            }
            else{

                echo "<script> if(alert('Calendario no ingresado, Vuelva a intentar.'));</script>";
           } 
           $this->showCalendarList();
        }

        public function delete($calendarId){
            if($this->daoEventSeat->checkEventSeatByCalendar($calendarId) == false){
                $this->daoCalendar->delete($calendarId);
            }else{
                echo "<script> if(alert('No es posible eliminar esta fecha. Hay entradas a la ventas'));</script>";
            }
            
            $this->showCalendarList();
        }

        public function getAll(){
            return $this->daoCalendar->getAll();
        }

        public function getAllActives(){
            return $this->daoCalendar->getAllActives();
        }

        public function changeDate($id,$date)
        {
        
                try{
                  
                if($this->daoCalendar->checkCalendarById($id) != null){
                    $this->daoCalendar->changeDate($id,$date);
                }
                else{
                    echo "<script> if(alert('no existe ese calendario'));</script>";
                }
    
            }
                catch(Exception $ex){
                    echo "<script> if(alert('algo fallo'));</script>";
                }
            
        }

        private function setImage(Calendar $calendar,$file){
            var_dump($file);
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
                    $calendar->setNameImg($fileName);
                    return $calendar;
                }
                else
                    echo "Error en la carga de la imagen";
            }
            else   
                echo "El archivo no es una imagen";
        }

    }


?>