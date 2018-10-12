<?php
    namespace Dao;

    use Dao\IDaoArtist as IDaoArtist;
    use Model\Artist as Artist;

    class DaoArtistList implements IDaoArtist{
        private $artistList;

        public function __construct(){
            if(!isset($_SESSION['artistList'])){
                $_SESSION['artistList'] = $this->artistList = array();
            }
            $this->artistList = &$_SESSION['artistList'];
        }

        /**
         * Take the last id and return it
         * 
         * @return 0 if there is no artist in the array
         * or @return > 0 if there is elemnts in the array 
         * 
         * the var $max use count and down it by one to get the
         * last element and not the size of the array
         */
        public function lastId()
        {
            $artistList = $this->artistList;
            $id = 0;

            if(isset($artistList[0])){
                $max = count($artistList) - 1;
                $id = $artistList[$max]->getId();
            }
            return $id;
        }

        /**
         * Add an Artist in the Array
         * 
         * This method use @see lastId() to add the artist
         * the var $id add one to the last id because is a new artist
         */
        public function add(Artist $artist)
        {
            $id = 1 + $this->lastId();
            $artist->setId($id);
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

        public function delete($idArtist)
        {
            $i = 0;
            foreach ($this->artistList as $artist) {
                if($artist->getId() == $idArtist){
                    unset($this->artistList[$i]);
                    break;
                }
                $i++;
            }
            $this->artistList = array_values($this->artistList);
        }
    }
?>

