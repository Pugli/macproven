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

        public function addCalendar($date,$arrayArtistId,$placeId,$eventId){
            $flag = 0;
            foreach($arrayArtistId as $i){
                if($this->daoArtist->checkArtistById($i) == null){
                    $flag = 1;
                }
            }
            if( $flag == 0 && $this->daoPlace->checkEventPlaceById($placeId) != null && $this->daoEvent->checkEventById($eventId) != null){
                $newCalendar = new Calendar();
                $newCalendar->setDate($date);
                $newCalendar->setEventPlace($this->daoPlace->checkEventPlaceById($placeId));
                foreach($arrayArtistId as $i){
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
            $this->daoCalendar->delete($calendarId);
            $this->showCalendarList();
        }

        public function getAll(){
            return $this->daoCalendar->getAll();
        }
    }


?>