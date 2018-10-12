<?php
    namespace Dao;

    use Dao\IDaoArtist as IDaoArtist;
    use Model\Artist as Artist;

    class DaoArtistList implements IDaoArtist{
        private $artistList;

        public function __construct(){
            if(!isset($_SESSION['Artists']))
                $this->artistList = array();
            $this->artistList = &$_SESSION['Artists'];
        }

        public function add(Artist $artist)
        {
            array_push($this->artistList, $artist);
        }

        public function getAll()
        { 
            return $this->artistList;
        }

        public function checkArtist($name)
        {
            $result = null;
            foreach ($this->artistList as $artist) {
                if($name == $artist->getName()){
                    $result = $artist;
                    break;
                }
            }            
            return $result;
        }
    }
?>

