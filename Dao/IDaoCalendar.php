<?php
    namespace Dao;

    use Model\Calendar as Calendar;

    interface IDaoCalendar{
        public function add(Calendar $calendar);
        public function delete($idCalendar);
        public function getAll();
        //public function checkCalendar($calendarName);
    }
?>