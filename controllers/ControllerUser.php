<?php

    namespace controllers;

    use Model\User as User;
    use dao\DaoUserPdo as DaoUserPdo;
    use dao\DaoPurchasePdo as DaoPurchasePdo;

    class ControllerUser{

        private $userDao;

        public function __construct(){

            $this->userDao = new DaoUserPdo;
            //$this->purchaseDao = new DaoPurchasePdo;

        }

        public function login($email,$password){

            if(!empty($email) && !empty($password)){

                $user = $this->userDao->getUserByEmail($email);
                if ($user->getPassword() == $password){
                    $_SESSION["userLogged"] = $user;
                    include_once VIEWS_PATH."home.php";
                }else{
                    echo "Credenciales Incorrectas";
                    include_once VIEWS_PATH."login.php";
                }
            }else{
                echo "Credenciales Incorrectas";
                include_once VIEWS_PATH."login.php";
            }
        }

        public function showLogin(){
            require_once VIEWS_PATH."login.php";
        }

        public function showAddUser(){
            include_once VIEWS_PATH."addUser.php";
        }

        public function showListUsers(){
            include_once VIEWS_PATH."userList.php";
        }

        public function addUser($email,$password,$nickName,$isAdmin){
            echo $isAdmin;
            $userLogged = (isset($_SESSION["userLogged"]) ? $_SESSION["userLogged"] : null);

            if($userLogged != null && $userLogged->getIsAdmin() == 1){
                $user = new User;
                $user->setNickName($nickName);
                $user->setIsAdmin($isAdmin);
                $user->setEmail($email);
                $user->setPassword($password);

                $this->userDao->add($user);
                require_once VIEWS_PATH."home.php";
            }
        }

        public function getAll(){
            $userLogged = (isset($_SESSION["userLogged"]) ? $_SESSION["userLogged"] : null);

            if($userLogged != null && $userLogged->getIsAdmin() == 1){
                return $this->userDao->getAll();
            }
        }

        public function getPurchasesFromUser($idUser){
            $userLogged = (isset($_SESSION["userLogged"]) ? $_SESSION["userLogged"] : null);

            if($userLogged != null && $userLogged->isAdmin() == 1){
            
                $purchases = $this->purchaseDao->getPurchasesFromUser($idUser);
                $user = $this->userDao->getUserById($idUser);
                foreach ($purchases as $purchase){
                    $user->setPurchase($purchase);
                }
            
            }

            return $user;

        }

    }




?>