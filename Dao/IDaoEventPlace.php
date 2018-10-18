<?php
    namespace Dao;

    use Model\EventPlace as EventPlace;

    interface IDaoEventPlace{
        public function add(EventPlace $eventPlace);
        public function delete($idEventPlace);
        public function getAll();
        public function checkEventPlace($eventPlaceName);
    }
?>