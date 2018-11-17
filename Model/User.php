<?php
    namespace Model;

    class User
    {
        private $email;
        private $password;

        public function setEmail($email)
        {
            $this->email = $email;
        }
        public function getEmail()
        {
            return $this->email;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }
        public function getPassword()
        {
            return $this->password;
        }
    }
?>