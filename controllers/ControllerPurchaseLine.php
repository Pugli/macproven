<?php
namespace controllers;

use dao\DaoCurrentPurchaseList as DaoCurrentPurchaseList;
use dao\DaoEventSeatPdo as DaoEventSeatPdo;
use Model\PurchaseLine as PurchaseLine;
use \Exception as Exception;

class ControllerPurchaseLine
{

    private $daoCurrentPurchase;
    private $daoEventSeat;

    public function __construct()
    {
        $this->daoCurrentPurchase = new DaoCurrentPurchaseList;
        $this->daoEventSeat = new DaoEventSeatPdo;
    }

    public function index()
    {
        $this->showCurrentPurchaseLines();
    }

    public function addPurchaseLineOnCart($idEventSeat, $quantity)
    {
        try {
            if ($this->daoCurrentPurchase->upsertPurchaseLine($idEventSeat, $quantity) == 0) {

                $eventSeat = $this->daoEventSeat->getEventSeatById($idEventSeat);

                $purchaseLine = new PurchaseLine;
                $purchaseLine->setEventSeat($eventSeat);
                $purchaseLine->setPrice($eventSeat->getPrice());
                $purchaseLine->setQuantity($quantity);

                $this->daoCurrentPurchase->add($purchaseLine);
                echo "<script> if(alert('Su compra se ha añadido al carrito!'));</script>";
            }
            require_once VIEWS_PATH . 'viewCurrentCart.php';
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function showCurrentPurchaseLines()
    {
        include_once VIEWS_PATH . 'viewCurrentCart.php';
    }

    public function getCurrentPurchaseLines()
    {
        try {
            return $this->daoCurrentPurchase->getAll();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function showBuyPurchaseLine($eventSeatId)
    {
        try {
            $eventSeat = $this->daoEventSeat->getEventSeatById($eventSeatId);
            require_once VIEWS_PATH . "buyEventSeat.php";
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

    public function delete($id)
    {
        try {
            $this->daoCurrentPurchase->delete($id);
            $this->showCurrentPurchaseLines();
        } catch (Exception $ex) {
            echo "<script> if(alert('Upps! algo fallo'));</script>";
            $this->index();
        }
    }

}
