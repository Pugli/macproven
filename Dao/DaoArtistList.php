<?php
    namespace Dao;

    use Dao\IDaoArtist as IDaoArtist;
    use Model\Artist as Artist;

    class DaoArtistList implements IDaoArtist{
        private $artistList = array();
        private static $instance;

        public function __construct(){
            $this->listInSession();
        }

        public function listInSession(){
            if (isset($_SESSION['Artists'])){
                $this->artistList = $_SESSION['Artists'];
            }else{
                $_SESSION['Artists'] = array();
                $this->artistList = $_SESSION['Artists'];
            }
        }

        public static function getInstance(){            
            if (!isset(self::$instance))
            {
                self::$instance = new DaoArtistList();
            }
            
            return self::$instance;
        }

        public function add(Artist $artist)
        {
            array_push($this->artistList, $artist);
            $_SESSION['Artists'] = $this->artistList;
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
