<?php
    namespace dao;

    use Model\User as User;

    interface IDaoUser{
        public function add(User $user);
        public function getAll();
    }
?>