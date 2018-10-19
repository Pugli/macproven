<?php
    namespace Model;

    use Model\EventPlace as EventPlace;
    use Model\Artist as Artist;
    use Model\Event as Event;

    class Calendar{
        private $date;
        private $id;
        private $eventPlace;
        private $artist;
        private $event;

        public function setEvent(Event $event)
        {
            $this->event = $event;
        }

        public function getEvent()
        {
            return $this->event;
        }

        public function setArtist(Artist $artist)
        {
            $this->artist = $artist;
        }

        public function getArtist()
        {
            return $this->artist;
        }

        public function setEventPlace(EventPlace $eventPlace)
        {
            $this->eventPlace = $eventPlace;
        }

        public function getEventPlace()
        {
            return $this->eventPlace;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setDate($date)
        {
            $this->date = $date;
        }

        public function getDate()
        {
            return $this->date;
        }
    }
?>