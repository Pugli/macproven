<?php
    namespace Dao;

    use Dao\IDaoArtist as IDaoArtist;
    use Model\Artist as Artist;

    class DaoArtistList implements IDaoArtist{
        
        private $artistList = array();

        public function __construct(){
            if(!iseet($_SESSION['artistList'])){
                $_SESSION['artistList'] = array();

                $this->artistList = &$_SESSION['artistList'];
            }
        }

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
            $artist = null;
            
            foreach ($this->artistList as $artist) {
                if($name == $artist->getName()){
                    $result = $artist;
                    break;
                }
            }            
            return $artist;
        }

        public function delete($name)
        {
            $i = 0;

            foreach($this->artistList as $artist)
            {
                if($artist->getName() == $name)
                {
                    unset($this->artistList[$i]);
                    break;
                }

                $i++;
            }

            $this->artistList = array_values($this->artistList);
        }

    }
?>
