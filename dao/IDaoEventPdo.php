<?php
    namespace dao;
    use Model\Event as Event;

    interface IDaoEventPdo{
        public function add(Event $event);
        public function delete($idEvent);
        public function checkEvent($eventname);
        public function getAll();
        public function checkEventForArtistDao($id);
    }

?>