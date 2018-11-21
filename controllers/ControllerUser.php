<?php

    namespace controllers;

    use Model\User as User;
    use dao\DaoUserPdo as DaoUserPdo;
    //use dao\DaoPurchasePdo as DaoPurchasePdo;

    class ControllerUser{

        private $userDao;
      
        public function __construct()
        {
            $this->userDao = new DaoUserPdo;
            //$this->purchaseDao = new DaoPurchasePdo;
        }
        
        public function showLogin()
        {
            require_once VIEWS_PATH."login.php";
        }

        public function showAddUser()
        {
            include_once VIEWS_PATH."addUser.php";
        }

        public function showListUsers()
        {
            include_once VIEWS_PATH."userList.php";
        }

        public function showHomeView()
        {
            header('Location: ../Home');
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
                    $this->showHomeView();
                }else{
                    echo "Credenciales Incorrectas";
                    $this->showLogin();
                }
            }
            else{
                echo "Credenciales Incorrectas";
                $this->showLogin();
            }
        }
        
        public function addUser($email,$password,$nickName,$isAdmin){
            echo $isAdmin;
            $userLogged = $this->isUserLogged();
          
            if($userLogged != null && $userLogged->getIsAdmin() == 1){
                $user = new User;
                $user->setNickName($nickName);
                $user->setIsAdmin($isAdmin);
                $user->setEmail($email);
                $user->setPassword($password);

                $this->userDao->add($user);
                $this->showHomeView();
            }
        }
        
        public function getAll(){
            $userLogged = $this->isUserLogged();

            if($userLogged != null && $userLogged->getIsAdmin() == 1){
                return $this->userDao->getAll();
            }
        }

        public function getPurchasesFromUser($idUser){
            $userLogged = $this->isUserLogged();
          
            if($userLogged != null && $userLogged->getIsAdmin() == 1){
                $purchases = $this->purchaseDao->getPurchasesFromUser($idUser);
                $user = $this->userDao->getUserById($idUser);
                foreach ($purchases as $purchase)
                {
                    $user->setPurchase($purchase);
                }            
            }
            return $user;
        }
        
        private function isUserLogged()
        {
            if(isset($_SESSION['userLogged']))
                return $_SESSION['userLogged'];
            else
                return null;
        }

        public function logout(){
            session_destroy();
            header('Location: ../Home');
        }
    }
?>