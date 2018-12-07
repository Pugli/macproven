<?php
namespace controllers;

use dao\DaoArtistPdo as DaoArtistPdo;
use dao\DaoCalendarPdo as DaoCalendarPdo;
use Model\Artist as Artist;
use \Exception as Exception;

class ControllerArtist
{

    private $DaoArtist;
    private $daoCalendar;

    /**
     * To change the database just modify
     * the Pdo by List or inverse
     */
    public function __construct()
    {
        $this->DaoArtist = new DaoArtistPdo();
        $this->daoCalendar = new DaoCalendarPdo();
    }

    public function index()
    {
        $this->showArtistList();
    }

    public function showAddArtist()
    {
        include_once VIEWS_PATH . 'addArtist.php';
    }

    public function showArtistList()
    {
        include_once VIEWS_PATH . 'artistlist.php';
    }

    public function addArtist($artist)
    {
        try {
            if($artist != null)
            {
                if ($this->DaoArtist->checkArtist($artist) == null) {
                    $newArtist = new Artist();
                    $newArtist->setName($artist);
                    $this->DaoArtist->add($newArtist);
    
                    echo "<script> if(alert('Nuevo Artista ingresado!'));</script>";
                } else {
                    echo "<script> if(alert('El Artista Ya existe'));</script>";
                }
            }
            else {
                echo "<script> if(alert('Complete el nombre'));</script>";
            }
            $this->showArtistList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAll()
    {
        try
        {
            return $this->DaoArtist->getAll();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function getAllActives()
    {
        try {
            return $this->DaoArtist->getAllActives();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function delete($idArtist)
    {
        try {
            if ($this->daoCalendar->checkCalendarByArtist($idArtist) == false) {
                $this->DaoArtist->delete($idArtist);
            } else {
                echo "<script> if(alert('Imposible eliminar, Hay calendarios con este artista.'));</script>";
            }
            $this->showArtistList();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function changeName($id, $name)
    {
        try
        {
            if ($this->daoCalendar->checkCalendarByArtist($id) == false) {
                $this->DaoArtist->changeName($id, $name);
            } else {
                echo "<script> if(alert('Imposible modificar, Hay calendarios con este artista.'));</script>";
            }

            $this->showArtistList();
        } catch (Exception $ex) {
            echo "<script> if(alert('algo fallo'));</script>";
            $this->index();
        }
    }
}
