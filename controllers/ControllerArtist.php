<?php
    namespace controllers;

    use Model\Artist as Artist;
    use dao\DaoArtistList as DaoArtistList;
    use dao\DaoArtistPdo as DaoArtistPdo;
    use dao\DaoCalendarPdo as DaoCalendarPdo;

    class ControllerArtist{

        private $DaoArtist;
        private $daoCalendar;
        
        /**
         * To change the database just modify 
         * the Pdo by List or inverse
        */
        function __construct(){
            $this->DaoArtist = new DaoArtistPdo();
            $this->daoCalendar = new DaoCalendarPdo();
        }

        public function index(){
            $this->showArtistList();
        }

        public function showAddArtist(){
            include_once VIEWS_PATH . 'addArtist.php';
        }

        public function showArtistList()
        {
            include_once VIEWS_PATH . 'artistlist.php';
        }

        public function addArtist($artist){


            if ($this->DaoArtist->checkArtist($artist) == null){

                $newArtist = new Artist();
                $newArtist->setName($artist);
                $this->DaoArtist->add($newArtist);

                echo "<script> if(alert('Nuevo Artista ingresado!'));</script>";
            }
            else{

                echo "<script> if(alert('El Artista Ya existe'));</script>";
            }
            $this->showArtistList();
            
        }

        public function getAll(){
            return $this->DaoArtist->getAll();
        }

        public function getAllActives()
        {
            return $this->DaoArtist->getAllActives();
        }

        public function delete($idArtist){

            if($this->daoCalendar->checkCalendarByArtist($idArtist) == false){
                $this->DaoArtist->delete($idArtist);
            }else{
                echo "<script> if(alert('Imposible eliminar, Hay calendarios con este artista.'));</script>";
            }
            
        }
    }

?>