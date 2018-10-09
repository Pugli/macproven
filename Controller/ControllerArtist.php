<?php
    namespace Controller;

    use Model\Artist as Artist;
    use Dao\DaoAristList as DaoArtistList;

    class ControllerArtist{

        private $artists = array();
        private $DaoArtist;

        function __construct(){
            $this->DaoArtist = DaoArtistList::getInstance();
            $this->refreshList();
        }

        public function index(){
            include_once URL_THEME.'artistlist.php';
        }

        public function addArtist($artist){
            if ($DaoArtist->checkArtist($artist) == false){
                $newArtist = new Artist();
                $newArtist->setName($artist);
                echo "<script> if(alert('Nuevo Artista ingresado!'));</script>";
            }else{
                echo "<script> if(alert('El Artista Ya existe'));</script>";
            }
            include_once URL_THEME . 'artistlist.php';
            
        }

        public function refreshList(){
            $this->artists = $this->DaoArtist->getAll();
        }
    }

?>