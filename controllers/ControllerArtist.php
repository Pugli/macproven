<?php
    namespace controllers;

    use Model\Artist as Artist;
    use dao\DaoArtistList as DaoArtistList;
    use dao\DaoArtistPdo as DaoArtistPdo;

    class ControllerArtist{

        private $artists = array();
        private $DaoArtist;
        

        function __construct(){
            
            //$this->DaoArtist = DaoArtistList::getInstance();
            
            //$this->refreshList();
            /*var_dump($this->DaoArtist);
            var_dump($this->artists);*/
           

            $this->DaoArtist = new DaoArtistPdo;
        }

        public function index(){
            include_once VIEWS_PATH.'artistlist.php';
        }

        public function addArtist($artist){
            
            $newArtist = new Artist();
            $newArtist->setName($artist);
            /*if ($this->DaoArtist->checkArtist($artist) == false){
                $newArtist = new Artist();
                $newArtist->setName($artist);*/
                $this->DaoArtist->add($newArtist);
               /* echo "<script> if(alert('Nuevo Artista ingresado!'));</script>";
            }else{
                echo "<script> if(alert('El Artista Ya existe'));</script>";
            }*/
            include_once VIEWS_PATH . 'artistlist.php';
            
        }

        public function refreshList(){
            $this->artists = $this->DaoArtist->getAll();
        }

        public function getAll(){
            return $this->DaoArtist->getAll();
        }
    }

?>