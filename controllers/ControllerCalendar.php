<?php
    namespace controllers;

    use Model\Calendar as Calendar;
    use dao\DaoCalendarPdo as DaoCalendarPdo;
    use dao\DaoCategoryPdo as DaoCategoryPdo;

    class ControllerCalendar{

        $daoCalendar;
        $daoCategory;

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

        public function addCalendar($date,$eventId,$placeId,$artistId){
            if($this->daoArtist->checkArtistById() != null && $this->daoPlace->checkEventPlaceById() != null && $this->daoEvent->checkEventById() != null){
                $newCalendar = new Calendar();
                $newCalendar->setEventPlace($this->daoPlace->checkEventPlaceById());
                $newCalendar->setArtist($this->daoArtist->checkArtistById());
                $newCalendar->setEvent($this->daoEvent->checkEventById());
                $this->daoCalendar->add($newCalendar);
                echo "<script> if(alert('Nuevo Evento Ingresado'));</script>";
            }
            else{

                echo "<script> if(alert('Evento no ingresado, Vuelva a intentar.'));</script>";
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