<?php
    namespace dao;

    use Model\User as User;

    interface IDaoUserPdo{
        public function add(User $user);
        public function getAll();
        public function delete($IdUser);
    }
?>