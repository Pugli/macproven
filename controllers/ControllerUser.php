<?php

    namespace controllers;

    use Model\User as User;
    use dao\DaoUserPdo as DaoUserPdo;
    //use dao\DaoPurchasePdo as DaoPurchasePdo;

    class ControllerUser{

        private $userDao;

        public function __construct(){

            $this->userDao = new DaoUserPdo;
            //$this->purchaseDao = new DaoPurchasePdo;

        }

        public function showLoginView()
        {
            include_once VIEWS_PATH."login.php";
        }

        public function login($email,$password){

            if(!empty($email) && !empty($password)){

                $user = $this->userDao->getUserByEmail($email);
                if ($user->getPassword() == $password){
                    $_SESSION["userLogged"] = $user;
                    include_once VIEWS_PATH."index.php";
                }else{
                    echo "Credenciales Incorrectas";
                    include_once VIEWS_PATH."login.php";
                }
            }else{
                echo "Credenciales Incorrectas";
                include_once VIEWS_PATH."login.php";
            }
        }

        public function addUser($email,$password,$nickName,$isActive){
            $userLogged = (isset($_SESSION["userLogged"]) ? $_SESSION["userLogged"] : null);

            if($user != null && $user->isAdmin() == 1){
                $user = new User;
                $user->setNickName($nickname);
                $user->isActive($isActive);
                $user->setEmail($email);
                $user->setPassword($password);

                $this->userDao->add($user);
                require_once VIEWS_PATH."index.php";
            }
        }

        public function getAll(){
            $userLogged = (isset($_SESSION["userLogged"]) ? $_SESSION["userLogged"] : null);

            if($userLogged != null && $userLogged->isAdmin() == 1){
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