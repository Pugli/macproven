<?php
    namespace Dao;

    use Dao\IDaoArtist as IDaoArtist;
    use Model\Artist as Artist;

    class DaoArtist implements IDaoArtist{
        private $artistList = array();

        public function add(Artist $artist)
        {
            array_push($this->artistList, $artist);
        }

        public function getAll()
        { 
            return $this->artistList;
        }

        public function isArtistName($name)
        {
            $result = false;
            $artist = new Artist();
            
            foreach ($this->artistList as $artist) {
                if($name == $artist->getName()){
                    $result = true;
                    break;
                }
            }            
            return $result;
        }
    }
?>
