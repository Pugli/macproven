<?php
    namespace Dao;

    use Dao\IDaoArtistList as IDaoArtistList;
    use Model\Artist as Artist;

    class DaoArtistList implements IDaoArtist{
        private $artistList = array();

        public function add(Artist $artist)
        {
            array_push($this->artistList, $artist);
        }

        public function getAll()
        { 
            return $this->artistList;
        }

        //Return true if there is a match between the name and the artistList
        public function checkArtist($name)
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