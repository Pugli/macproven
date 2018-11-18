<?php
    namespace Model;

    class User
    {
        private $email;
        private $password;
        private $isAdmin;
        private $purchase = array();
        private $nickName;
        private $idUser;

        public function setIdUser($userId)
        {
            $this->idUser = $userId;
        }
        public function getIdUser()
        {
            return $this->idUser;
        }

        public function setNickName($nickName)
        {
            $this->nickName = $nickName;
        }
        public function getNickName()
        {
            return $this->nickName;
        }

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

        public function setIsAdmin($isAdmin)
        {
            $this->isAdmin = $isAdmin;
        }
        public function getIsAdmin()
        {
            return $this->isAdmin;
        }

        public function setPurchase(Purchase $purchase)
        {
            array_push($this->purchase, $purchase);
        }
        public function getPurchase()
        {
            return $this->purchase;
        }
    }
?>