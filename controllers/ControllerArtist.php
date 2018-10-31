<?php
    namespace controllers;

    use Model\Artist as Artist;
    use dao\DaoArtistList as DaoArtistList;
    use dao\DaoArtistPdo as DaoArtistPdo;

    class ControllerArtist{

        private $DaoArtist;
        
        /**
         * To change the database just modify 
         * the Pdo by List or inverse
        */
        function __construct(){
            $this->DaoArtist = new DaoArtistPdo();
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

        public function delete($idArtist){
            $this->DaoArtist->delete($idArtist);
            $this->showArtistList();
        }
    }

?>